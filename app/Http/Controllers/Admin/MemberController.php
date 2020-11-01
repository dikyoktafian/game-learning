<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Repositories\MemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

// Additional
use Illuminate\Support\Facades\Storage; // added by dandisy
use File;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
    }

    /**
     * Display a listing of the Member.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $members = $this->memberRepository->all();

        return view('admin.members.index')
            ->with('members', $members);
    }

    /**
     * Show the form for creating a new Member.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created Member in storage.
     *
     * @param CreateMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberRequest $request)
    {
        $input = $request->all();
        // dd($input);

        // CREATE FOLDER
        $pathImage = 'public/member';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        // UPLOAD IMAGE
        if (@$input['photo']) {
            $cover = $input['photo'];
            if (!empty($cover)) {                    
                $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                $input['photo'] = $fileCover;
            }
        }

        $member = $this->memberRepository->create($input);

        Flash::success('Member saved successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Display the specified Member.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('admin.members.show')->with('member', $member);
    }

    /**
     * Show the form for editing the specified Member.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        return view('admin.members.edit')->with('member', $member);
    }

    /**
     * Update the specified Member in storage.
     *
     * @param int $id
     * @param UpdateMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberRequest $request)
    {
        $member = $this->memberRepository->find($id);
        $input = $request->all();

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        // CREATE FOLDER
        $pathImage = 'public/member';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        // UPLOAD IMAGE
        if (@$input['photo']) {
            $cover = $input['photo'];
            if (!empty($cover)) {                    
                $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                $input['photo'] = $fileCover;
                if($input['photo'] !== '' && $input['photo'] !== $fileCover){
                    @Storage::delete($pathImage . $input['photo']);
                }
            }
        }


        $member = $this->memberRepository->update($input, $id);

        Flash::success('Member updated successfully.');

        return redirect(route('members.index'));
    }

    /**
     * Remove the specified Member from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $member = $this->memberRepository->find($id);

        if (empty($member)) {
            Flash::error('Member not found');

            return redirect(route('members.index'));
        }

        $this->memberRepository->delete($id);

        Flash::success('Member deleted successfully.');

        return redirect(route('members.index'));
    }
}
