<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTaskAnswerAPIRequest;
use App\Http\Requests\API\UpdateTaskAnswerAPIRequest;
use App\Models\TaskAnswer;
use App\Repositories\TaskAnswerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TaskAnswerController
 * @package App\Http\Controllers\API
 */

class TaskAnswerAPIController extends AppBaseController
{
    /** @var  TaskAnswerRepository */
    private $taskAnswerRepository;

    public function __construct(TaskAnswerRepository $taskAnswerRepo)
    {
        $this->taskAnswerRepository = $taskAnswerRepo;
    }

    /**
     * Display a listing of the TaskAnswer.
     * GET|HEAD /taskAnswers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $taskAnswers = $this->taskAnswerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($taskAnswers->toArray(), 'Task Answers retrieved successfully');
    }

    /**
     * Store a newly created TaskAnswer in storage.
     * POST /taskAnswers
     *
     * @param CreateTaskAnswerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskAnswerAPIRequest $request)
    {
        $input = $request->all();

        $taskAnswer = $this->taskAnswerRepository->create($input);

        return $this->sendResponse($taskAnswer->toArray(), 'Task Answer saved successfully');
    }

    /**
     * Display the specified TaskAnswer.
     * GET|HEAD /taskAnswers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TaskAnswer $taskAnswer */
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            return $this->sendError('Task Answer not found');
        }

        return $this->sendResponse($taskAnswer->toArray(), 'Task Answer retrieved successfully');
    }

    /**
     * Update the specified TaskAnswer in storage.
     * PUT/PATCH /taskAnswers/{id}
     *
     * @param int $id
     * @param UpdateTaskAnswerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskAnswerAPIRequest $request)
    {
        $input = $request->all();

        /** @var TaskAnswer $taskAnswer */
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            return $this->sendError('Task Answer not found');
        }

        $taskAnswer = $this->taskAnswerRepository->update($input, $id);

        return $this->sendResponse($taskAnswer->toArray(), 'TaskAnswer updated successfully');
    }

    /**
     * Remove the specified TaskAnswer from storage.
     * DELETE /taskAnswers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TaskAnswer $taskAnswer */
        $taskAnswer = $this->taskAnswerRepository->find($id);

        if (empty($taskAnswer)) {
            return $this->sendError('Task Answer not found');
        }

        $taskAnswer->delete();

        return $this->sendSuccess('Task Answer deleted successfully');
    }
}
