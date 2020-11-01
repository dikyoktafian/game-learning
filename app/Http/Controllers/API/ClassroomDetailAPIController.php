<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassroomDetailAPIRequest;
use App\Http\Requests\API\UpdateClassroomDetailAPIRequest;
use App\Models\ClassroomDetail;
use App\Repositories\ClassroomDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassroomDetailController
 * @package App\Http\Controllers\API
 */

class ClassroomDetailAPIController extends AppBaseController
{
    /** @var  ClassroomDetailRepository */
    private $classroomDetailRepository;

    public function __construct(ClassroomDetailRepository $classroomDetailRepo)
    {
        $this->classroomDetailRepository = $classroomDetailRepo;
    }

    /**
     * Display a listing of the ClassroomDetail.
     * GET|HEAD /classroomDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $classroomDetails = $this->classroomDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classroomDetails->toArray(), 'Classroom Details retrieved successfully');
    }

    /**
     * Store a newly created ClassroomDetail in storage.
     * POST /classroomDetails
     *
     * @param CreateClassroomDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomDetailAPIRequest $request)
    {
        $input = $request->all();

        $classroomDetail = $this->classroomDetailRepository->create($input);

        return $this->sendResponse($classroomDetail->toArray(), 'Classroom Detail saved successfully');
    }

    /**
     * Display the specified ClassroomDetail.
     * GET|HEAD /classroomDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ClassroomDetail $classroomDetail */
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            return $this->sendError('Classroom Detail not found');
        }

        return $this->sendResponse($classroomDetail->toArray(), 'Classroom Detail retrieved successfully');
    }

    /**
     * Update the specified ClassroomDetail in storage.
     * PUT/PATCH /classroomDetails/{id}
     *
     * @param int $id
     * @param UpdateClassroomDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var ClassroomDetail $classroomDetail */
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            return $this->sendError('Classroom Detail not found');
        }

        $classroomDetail = $this->classroomDetailRepository->update($input, $id);

        return $this->sendResponse($classroomDetail->toArray(), 'ClassroomDetail updated successfully');
    }

    /**
     * Remove the specified ClassroomDetail from storage.
     * DELETE /classroomDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ClassroomDetail $classroomDetail */
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            return $this->sendError('Classroom Detail not found');
        }

        $classroomDetail->delete();

        return $this->sendSuccess('Classroom Detail deleted successfully');
    }
}
