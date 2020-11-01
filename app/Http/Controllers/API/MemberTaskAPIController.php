<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMemberTaskAPIRequest;
use App\Http\Requests\API\UpdateMemberTaskAPIRequest;
use App\Models\MemberTask;
use App\Repositories\MemberTaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MemberTaskController
 * @package App\Http\Controllers\API
 */

class MemberTaskAPIController extends AppBaseController
{
    /** @var  MemberTaskRepository */
    private $memberTaskRepository;

    public function __construct(MemberTaskRepository $memberTaskRepo)
    {
        $this->memberTaskRepository = $memberTaskRepo;
    }

    /**
     * Display a listing of the MemberTask.
     * GET|HEAD /memberTasks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $memberTasks = $this->memberTaskRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($memberTasks->toArray(), 'Member Tasks retrieved successfully');
    }

    /**
     * Store a newly created MemberTask in storage.
     * POST /memberTasks
     *
     * @param CreateMemberTaskAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberTaskAPIRequest $request)
    {
        $input = $request->all();

        $memberTask = $this->memberTaskRepository->create($input);

        return $this->sendResponse($memberTask->toArray(), 'Member Task saved successfully');
    }

    /**
     * Display the specified MemberTask.
     * GET|HEAD /memberTasks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MemberTask $memberTask */
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            return $this->sendError('Member Task not found');
        }

        return $this->sendResponse($memberTask->toArray(), 'Member Task retrieved successfully');
    }

    /**
     * Update the specified MemberTask in storage.
     * PUT/PATCH /memberTasks/{id}
     *
     * @param int $id
     * @param UpdateMemberTaskAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberTaskAPIRequest $request)
    {
        $input = $request->all();

        /** @var MemberTask $memberTask */
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            return $this->sendError('Member Task not found');
        }

        $memberTask = $this->memberTaskRepository->update($input, $id);

        return $this->sendResponse($memberTask->toArray(), 'MemberTask updated successfully');
    }

    /**
     * Remove the specified MemberTask from storage.
     * DELETE /memberTasks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MemberTask $memberTask */
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            return $this->sendError('Member Task not found');
        }

        $memberTask->delete();

        return $this->sendSuccess('Member Task deleted successfully');
    }
}
