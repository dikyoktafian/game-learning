<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateMemberPointRequest;
use App\Http\Requests\UpdateMemberPointRequest;
use App\Repositories\MemberPointRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MemberPointController extends AppBaseController
{
    /** @var  MemberPointRepository */
    private $memberPointRepository;

    public function __construct(MemberPointRepository $memberPointRepo)
    {
        $this->memberPointRepository = $memberPointRepo;
    }

    /**
     * Display a listing of the MemberPoint.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $memberPoints = $this->memberPointRepository->all();

        return view('admin.member_points.index')
            ->with('memberPoints', $memberPoints);
    }

    /**
     * Show the form for creating a new MemberPoint.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.member_points.create');
    }

    /**
     * Store a newly created MemberPoint in storage.
     *
     * @param CreateMemberPointRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberPointRequest $request)
    {
        $input = $request->all();

        $memberPoint = $this->memberPointRepository->create($input);

        Flash::success('Member Point saved successfully.');

        return redirect(route('memberPoints.index'));
    }

    /**
     * Display the specified MemberPoint.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            Flash::error('Member Point not found');

            return redirect(route('memberPoints.index'));
        }

        return view('admin.member_points.show')->with('memberPoint', $memberPoint);
    }

    /**
     * Show the form for editing the specified MemberPoint.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            Flash::error('Member Point not found');

            return redirect(route('memberPoints.index'));
        }

        return view('admin.member_points.edit')->with('memberPoint', $memberPoint);
    }

    /**
     * Update the specified MemberPoint in storage.
     *
     * @param int $id
     * @param UpdateMemberPointRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberPointRequest $request)
    {
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            Flash::error('Member Point not found');

            return redirect(route('memberPoints.index'));
        }

        $memberPoint = $this->memberPointRepository->update($request->all(), $id);

        Flash::success('Member Point updated successfully.');

        return redirect(route('memberPoints.index'));
    }

    /**
     * Remove the specified MemberPoint from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            Flash::error('Member Point not found');

            return redirect(route('memberPoints.index'));
        }

        $this->memberPointRepository->delete($id);

        Flash::success('Member Point deleted successfully.');

        return redirect(route('memberPoints.index'));
    }
}
