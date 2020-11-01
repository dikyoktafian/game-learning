<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTaskQuestionAPIRequest;
use App\Http\Requests\API\UpdateTaskQuestionAPIRequest;
use App\Models\TaskQuestion;
use App\Repositories\TaskQuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TaskQuestionController
 * @package App\Http\Controllers\API
 */

class TaskQuestionAPIController extends AppBaseController
{
    /** @var  TaskQuestionRepository */
    private $taskQuestionRepository;

    public function __construct(TaskQuestionRepository $taskQuestionRepo)
    {
        $this->taskQuestionRepository = $taskQuestionRepo;
    }

    /**
     * Display a listing of the TaskQuestion.
     * GET|HEAD /taskQuestions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $taskQuestions = $this->taskQuestionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($taskQuestions->toArray(), 'Task Questions retrieved successfully');
    }

    /**
     * Store a newly created TaskQuestion in storage.
     * POST /taskQuestions
     *
     * @param CreateTaskQuestionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskQuestionAPIRequest $request)
    {
        $input = $request->all();

        $taskQuestion = $this->taskQuestionRepository->create($input);

        return $this->sendResponse($taskQuestion->toArray(), 'Task Question saved successfully');
    }

    /**
     * Display the specified TaskQuestion.
     * GET|HEAD /taskQuestions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TaskQuestion $taskQuestion */
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            return $this->sendError('Task Question not found');
        }

        return $this->sendResponse($taskQuestion->toArray(), 'Task Question retrieved successfully');
    }

    /**
     * Update the specified TaskQuestion in storage.
     * PUT/PATCH /taskQuestions/{id}
     *
     * @param int $id
     * @param UpdateTaskQuestionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskQuestionAPIRequest $request)
    {
        $input = $request->all();

        /** @var TaskQuestion $taskQuestion */
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            return $this->sendError('Task Question not found');
        }

        $taskQuestion = $this->taskQuestionRepository->update($input, $id);

        return $this->sendResponse($taskQuestion->toArray(), 'TaskQuestion updated successfully');
    }

    /**
     * Remove the specified TaskQuestion from storage.
     * DELETE /taskQuestions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TaskQuestion $taskQuestion */
        $taskQuestion = $this->taskQuestionRepository->find($id);

        if (empty($taskQuestion)) {
            return $this->sendError('Task Question not found');
        }

        $taskQuestion->delete();

        return $this->sendSuccess('Task Question deleted successfully');
    }
}
