<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTaskQuestionRequest;
use App\Http\Requests\UpdateTaskQuestionRequest;
use App\Repositories\TaskQuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TaskQuestionController extends AppBaseController
{
    /** @var  TaskQuestionRepository */
    private $taskQuestionRepository;

    public function __construct(TaskQuestionRepository $taskQuestionRepo)
    {
        $this->taskQuestionRepository = $taskQuestionRepo;
    }

    /**
     * Display a listing of the TaskQuestion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $taskQuestions = $this->taskQuestionRepository->all();

        return view('admin.task_questions.index')
            ->with('taskQuestions', $taskQuestions);
    }

    /**
     * Show the form for creating a new TaskQuestion.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.task_questions.create');
    }

    /**
     * Store a newly created TaskQuestion in storage.
     *
     * @param CreateTaskQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskQuestionRequest $request)
    {
        $input = $request->all();

        $taskQuestion = $this->taskQuestionRepository->create($input);

        Flash::success('Task Question saved successfully.');

        return redirect(route('taskQuestions.index'));
    }

    /**
     * Display the specified TaskQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            Flash::error('Task Question not found');

            return redirect(route('taskQuestions.index'));
        }

        return view('admin.task_questions.show')->with('taskQuestion', $taskQuestion);
    }

    /**
     * Show the form for editing the specified TaskQuestion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            Flash::error('Task Question not found');

            return redirect(route('taskQuestions.index'));
        }

        return view('admin.task_questions.edit')->with('taskQuestion', $taskQuestion);
    }

    /**
     * Update the specified TaskQuestion in storage.
     *
     * @param int $id
     * @param UpdateTaskQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskQuestionRequest $request)
    {
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            Flash::error('Task Question not found');

            return redirect(route('taskQuestions.index'));
        }

        $taskQuestion = $this->taskQuestionRepository->update($request->all(), $id);

        Flash::success('Task Question updated successfully.');

        return redirect(route('taskQuestions.index'));
    }

    /**
     * Remove the specified TaskQuestion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            Flash::error('Task Question not found');

            return redirect(route('taskQuestions.index'));
        }

        $this->taskQuestionRepository->delete($id);

        Flash::success('Task Question deleted successfully.');

        return redirect(route('taskQuestions.index'));
    }
}
