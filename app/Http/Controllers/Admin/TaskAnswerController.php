<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTaskAnswerRequest;
use App\Http\Requests\UpdateTaskAnswerRequest;
use App\Repositories\TaskAnswerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TaskAnswerController extends AppBaseController
{
    /** @var  TaskAnswerRepository */
    private $taskAnswerRepository;

    public function __construct(TaskAnswerRepository $taskAnswerRepo)
    {
        $this->taskAnswerRepository = $taskAnswerRepo;
    }

    /**
     * Display a listing of the TaskAnswer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $taskAnswers = $this->taskAnswerRepository->all();

        return view('admin.task_answers.index')
            ->with('taskAnswers', $taskAnswers);
    }

    /**
     * Show the form for creating a new TaskAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.task_answers.create');
    }

    /**
     * Store a newly created TaskAnswer in storage.
     *
     * @param CreateTaskAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskAnswerRequest $request)
    {
        $input = $request->all();

        $taskAnswer = $this->taskAnswerRepository->create($input);

        Flash::success('Task Answer saved successfully.');

        return redirect(route('taskAnswers.index'));
    }

    /**
     * Display the specified TaskAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            Flash::error('Task Answer not found');

            return redirect(route('taskAnswers.index'));
        }

        return view('admin.task_answers.show')->with('taskAnswer', $taskAnswer);
    }

    /**
     * Show the form for editing the specified TaskAnswer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            Flash::error('Task Answer not found');

            return redirect(route('taskAnswers.index'));
        }

        return view('admin.task_answers.edit')->with('taskAnswer', $taskAnswer);
    }

    /**
     * Update the specified TaskAnswer in storage.
     *
     * @param int $id
     * @param UpdateTaskAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskAnswerRequest $request)
    {
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            Flash::error('Task Answer not found');

            return redirect(route('taskAnswers.index'));
        }

        $taskAnswer = $this->taskAnswerRepository->update($request->all(), $id);

        Flash::success('Task Answer updated successfully.');

        return redirect(route('taskAnswers.index'));
    }

    /**
     * Remove the specified TaskAnswer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            Flash::error('Task Answer not found');

            return redirect(route('taskAnswers.index'));
        }

        $this->taskAnswerRepository->delete($id);

        Flash::success('Task Answer deleted successfully.');

        return redirect(route('taskAnswers.index'));
    }
}
