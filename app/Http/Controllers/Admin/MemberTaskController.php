<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateMemberTaskRequest;
use App\Http\Requests\UpdateMemberTaskRequest;
use App\Repositories\MemberTaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MemberTaskController extends AppBaseController
{
    /** @var  MemberTaskRepository */
    private $memberTaskRepository;

    public function __construct(MemberTaskRepository $memberTaskRepo)
    {
        $this->memberTaskRepository = $memberTaskRepo;
    }

    /**
     * Display a listing of the MemberTask.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $memberTasks = $this->memberTaskRepository->all();

        return view('admin.member_tasks.index')
            ->with('memberTasks', $memberTasks);
    }

    /**
     * Show the form for creating a new MemberTask.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.member_tasks.create');
    }

    /**
     * Store a newly created MemberTask in storage.
     *
     * @param CreateMemberTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberTaskRequest $request)
    {
        $input = $request->all();

        $memberTask = $this->memberTaskRepository->create($input);

        Flash::success('Member Task saved successfully.');

        return redirect(route('memberTasks.index'));
    }

    /**
     * Display the specified MemberTask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            Flash::error('Member Task not found');

            return redirect(route('memberTasks.index'));
        }

        return view('admin.member_tasks.show')->with('memberTask', $memberTask);
    }

    /**
     * Show the form for editing the specified MemberTask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            Flash::error('Member Task not found');

            return redirect(route('memberTasks.index'));
        }

        return view('admin.member_tasks.edit')->with('memberTask', $memberTask);
    }

    /**
     * Update the specified MemberTask in storage.
     *
     * @param int $id
     * @param UpdateMemberTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberTaskRequest $request)
    {
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            Flash::error('Member Task not found');

            return redirect(route('memberTasks.index'));
        }

        $memberTask = $this->memberTaskRepository->update($request->all(), $id);

        Flash::success('Member Task updated successfully.');

        return redirect(route('memberTasks.index'));
    }

    /**
     * Remove the specified MemberTask from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $memberTask = $this->memberTaskRepository->find($id);

        if (empty($memberTask)) {
            Flash::error('Member Task not found');

            return redirect(route('memberTasks.index'));
        }

        $this->memberTaskRepository->delete($id);

        Flash::success('Member Task deleted successfully.');

        return redirect(route('memberTasks.index'));
    }
}
