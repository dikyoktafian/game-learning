<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMemberPointAPIRequest;
use App\Http\Requests\API\UpdateMemberPointAPIRequest;
use App\Models\MemberPoint;
use App\Repositories\MemberPointRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MemberPointController
 * @package App\Http\Controllers\API
 */

class MemberPointAPIController extends AppBaseController
{
    /** @var  MemberPointRepository */
    private $memberPointRepository;

    public function __construct(MemberPointRepository $memberPointRepo)
    {
        $this->memberPointRepository = $memberPointRepo;
    }

    /**
     * Display a listing of the MemberPoint.
     * GET|HEAD /memberPoints
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $memberPoints = $this->memberPointRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($memberPoints->toArray(), 'Member Points retrieved successfully');
    }

    /**
     * Store a newly created MemberPoint in storage.
     * POST /memberPoints
     *
     * @param CreateMemberPointAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberPointAPIRequest $request)
    {
        $input = $request->all();

        $memberPoint = $this->memberPointRepository->create($input);

        return $this->sendResponse($memberPoint->toArray(), 'Member Point saved successfully');
    }

    /**
     * Display the specified MemberPoint.
     * GET|HEAD /memberPoints/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MemberPoint $memberPoint */
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            return $this->sendError('Member Point not found');
        }

        return $this->sendResponse($memberPoint->toArray(), 'Member Point retrieved successfully');
    }

    /**
     * Update the specified MemberPoint in storage.
     * PUT/PATCH /memberPoints/{id}
     *
     * @param int $id
     * @param UpdateMemberPointAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberPointAPIRequest $request)
    {
        $input = $request->all();

        /** @var MemberPoint $memberPoint */
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            return $this->sendError('Member Point not found');
        }

        $memberPoint = $this->memberPointRepository->update($input, $id);

        return $this->sendResponse($memberPoint->toArray(), 'MemberPoint updated successfully');
    }

    /**
     * Remove the specified MemberPoint from storage.
     * DELETE /memberPoints/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MemberPoint $memberPoint */
        $memberPoint = $this->memberPointRepository->find($id);

        if (empty($memberPoint)) {
            return $this->sendError('Member Point not found');
        }

        $memberPoint->delete();

        return $this->sendSuccess('Member Point deleted successfully');
    }
}
