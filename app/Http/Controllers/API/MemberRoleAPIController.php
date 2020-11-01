<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMemberRoleAPIRequest;
use App\Http\Requests\API\UpdateMemberRoleAPIRequest;
use App\Models\MemberRole;
use App\Repositories\MemberRoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MemberRoleController
 * @package App\Http\Controllers\API
 */

class MemberRoleAPIController extends AppBaseController
{
    /** @var  MemberRoleRepository */
    private $memberRoleRepository;

    public function __construct(MemberRoleRepository $memberRoleRepo)
    {
        $this->memberRoleRepository = $memberRoleRepo;
    }

    /**
     * Display a listing of the MemberRole.
     * GET|HEAD /memberRoles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $memberRoles = $this->memberRoleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($memberRoles->toArray(), 'Member Roles retrieved successfully');
    }

    /**
     * Store a newly created MemberRole in storage.
     * POST /memberRoles
     *
     * @param CreateMemberRoleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberRoleAPIRequest $request)
    {
        $input = $request->all();

        $memberRole = $this->memberRoleRepository->create($input);

        return $this->sendResponse($memberRole->toArray(), 'Member Role saved successfully');
    }

    /**
     * Display the specified MemberRole.
     * GET|HEAD /memberRoles/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MemberRole $memberRole */
        $memberRole = $this->memberRoleRepository->find($id);

        if (empty($memberRole)) {
            return $this->sendError('Member Role not found');
        }

        return $this->sendResponse($memberRole->toArray(), 'Member Role retrieved successfully');
    }

    /**
     * Update the specified MemberRole in storage.
     * PUT/PATCH /memberRoles/{id}
     *
     * @param int $id
     * @param UpdateMemberRoleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberRoleAPIRequest $request)
    {
        $input = $request->all();

        /** @var MemberRole $memberRole */
        $memberRole = $this->memberRoleRepository->find($id);

        if (empty($memberRole)) {
            return $this->sendError('Member Role not found');
        }

        $memberRole = $this->memberRoleRepository->update($input, $id);

        return $this->sendResponse($memberRole->toArray(), 'MemberRole updated successfully');
    }

    /**
     * Remove the specified MemberRole from storage.
     * DELETE /memberRoles/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MemberRole $memberRole */
        $memberRole = $this->memberRoleRepository->find($id);

        if (empty($memberRole)) {
            return $this->sendError('Member Role not found');
        }

        $memberRole->delete();

        return $this->sendSuccess('Member Role deleted successfully');
    }
}
