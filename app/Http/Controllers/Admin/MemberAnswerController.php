<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateMemberAnswerRequest;
use App\Http\Requests\UpdateMemberAnswerRequest;
use App\Repositories\MemberAnswerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MemberAnswerController extends AppBaseController
{
    /** @var  MemberAnswerRepository */
    private $memberAnswerRepository;

    public function __construct(MemberAnswerRepository $memberAnswerRepo)
    {
        $this->memberAnswerRepository = $memberAnswerRepo;
    }

    /**
     * Display a listing of the MemberAnswer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $memberAnswers = $this->memberAnswerRepository->all();

        return view('admin.member_answers.index')
            ->with('memberAnswers', $memberAnswers);
    }

    /**
     * Show the form for creating a new MemberAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.member_answers.create');
    }

    /**
     * Store a newly created MemberAnswer in storage.
     *
     * @param CreateMemberAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberAnswerRequest $request)
    {
        $input = $request->all();

        $memberAnswer = $this->memberAnswerRepository->create($input);

        Flash::success('Member Answer saved successfully.');

        return redirect(route('memberAnswers.index'));
    }

    /**
     * Display the specified MemberAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            Flash::error('Member Answer not found');

            return redirect(route('memberAnswers.index'));
        }

        return view('admin.member_answers.show')->with('memberAnswer', $memberAnswer);
    }

    /**
     * Show the form for editing the specified MemberAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            Flash::error('Member Answer not found');

            return redirect(route('memberAnswers.index'));
        }

        return view('admin.member_answers.edit')->with('memberAnswer', $memberAnswer);
    }

    /**
     * Update the specified MemberAnswer in storage.
     *
     * @param int $id
     * @param UpdateMemberAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberAnswerRequest $request)
    {
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            Flash::error('Member Answer not found');

            return redirect(route('memberAnswers.index'));
        }

        $memberAnswer = $this->memberAnswerRepository->update($request->all(), $id);

        Flash::success('Member Answer updated successfully.');

        return redirect(route('memberAnswers.index'));
    }

    /**
     * Remove the specified MemberAnswer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            Flash::error('Member Answer not found');

            return redirect(route('memberAnswers.index'));
        }

        $this->memberAnswerRepository->delete($id);

        Flash::success('Member Answer deleted successfully.');

        return redirect(route('memberAnswers.index'));
    }
}
