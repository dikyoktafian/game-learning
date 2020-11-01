<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $RoleRepository;

    public function __construct(RoleRepository $memberRoleRepo)
    {
        $this->RoleRepository = $memberRoleRepo;
    }

    /**
     * Display a listing of the MemberRole.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $role = $this->RoleRepository->all();
        // dd($role);
        return view('admin.roles.index')
            ->with('role', $role);
    }

    /**
     * Show the form for creating a new MemberRole.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created MemberRole in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->RoleRepository->create($input);

        Flash::success('Member Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified MemberRole.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->RoleRepository->find($id);

        if (empty($role)) {
            Flash::error('Member Role not found');

            return redirect(route('roles.index'));
        }

        return view('admin.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified MemberRole.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->RoleRepository->find($id);

        if (empty($role)) {
            Flash::error('Member Role not found');

            return redirect(route('roles.index'));
        }

        return view('admin.roles.edit')->with('role', $role);
    }

    /**
     * Update the specified MemberRole in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->RoleRepository->find($id);

        if (empty($role)) {
            Flash::error('Member Role not found');

            return redirect(route('roles.index'));
        }

        $role = $this->RoleRepository->update($request->all(), $id);

        Flash::success('Member Role updated successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified MemberRole from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->RoleRepository->find($id);

        if (empty($role)) {
            Flash::error('Member Role not found');

            return redirect(route('roles.index'));
        }

        $this->RoleRepository->delete($id);

        Flash::success('Member Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
