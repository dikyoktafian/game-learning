<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateClassroomAPIRequest;
use App\Http\Requests\API\UpdateClassroomAPIRequest;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassroomController
 * @package App\Http\Controllers\API
 */

class ClassroomAPIController extends AppBaseController
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
    }

    /**
     * Display a listing of the Classroom.
     * GET|HEAD /classrooms
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $classrooms = $this->classroomRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($classrooms->toArray(), 'Classrooms retrieved successfully');
    }

    /**
     * Store a newly created Classroom in storage.
     * POST /classrooms
     *
     * @param CreateClassroomAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomAPIRequest $request)
    {
        $input = $request->all();

        $classroom = $this->classroomRepository->create($input);

        return $this->sendResponse($classroom->toArray(), 'Classroom saved successfully');
    }

    /**
     * Display the specified Classroom.
     * GET|HEAD /classrooms/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Classroom $classroom */
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            return $this->sendError('Classroom not found');
        }

        return $this->sendResponse($classroom->toArray(), 'Classroom retrieved successfully');
    }

    /**
     * Update the specified Classroom in storage.
     * PUT/PATCH /classrooms/{id}
     *
     * @param int $id
     * @param UpdateClassroomAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomAPIRequest $request)
    {
        $input = $request->all();

        /** @var Classroom $classroom */
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            return $this->sendError('Classroom not found');
        }

        $classroom = $this->classroomRepository->update($input, $id);

        return $this->sendResponse($classroom->toArray(), 'Classroom updated successfully');
    }

    /**
     * Remove the specified Classroom from storage.
     * DELETE /classrooms/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Classroom $classroom */
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            return $this->sendError('Classroom not found');
        }

        $classroom->delete();

        return $this->sendSuccess('Classroom deleted successfully');
    }
}
