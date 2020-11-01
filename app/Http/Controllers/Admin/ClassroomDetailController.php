<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateClassroomDetailRequest;
use App\Http\Requests\UpdateClassroomDetailRequest;
use App\Repositories\ClassroomDetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ClassroomDetailController extends AppBaseController
{
    /** @var  ClassroomDetailRepository */
    private $classroomDetailRepository;

    public function __construct(ClassroomDetailRepository $classroomDetailRepo)
    {
        $this->classroomDetailRepository = $classroomDetailRepo;
    }

    /**
     * Display a listing of the ClassroomDetail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $classroomDetails = $this->classroomDetailRepository->all();

        return view('admin.classroom_details.index')
            ->with('classroomDetails', $classroomDetails);
    }

    /**
     * Show the form for creating a new ClassroomDetail.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.classroom_details.create');
    }

    /**
     * Store a newly created ClassroomDetail in storage.
     *
     * @param CreateClassroomDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomDetailRequest $request)
    {
        $input = $request->all();

        $classroomDetail = $this->classroomDetailRepository->create($input);

        Flash::success('Classroom Detail saved successfully.');

        return redirect(route('classroomDetails.index'));
    }

    /**
     * Display the specified ClassroomDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            Flash::error('Classroom Detail not found');

            return redirect(route('classroomDetails.index'));
        }

        return view('admin.classroom_details.show')->with('classroomDetail', $classroomDetail);
    }

    /**
     * Show the form for editing the specified ClassroomDetail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            Flash::error('Classroom Detail not found');

            return redirect(route('classroomDetails.index'));
        }

        return view('admin.classroom_details.edit')->with('classroomDetail', $classroomDetail);
    }

    /**
     * Update the specified ClassroomDetail in storage.
     *
     * @param int $id
     * @param UpdateClassroomDetailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomDetailRequest $request)
    {
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            Flash::error('Classroom Detail not found');

            return redirect(route('classroomDetails.index'));
        }

        $classroomDetail = $this->classroomDetailRepository->update($request->all(), $id);

        Flash::success('Classroom Detail updated successfully.');

        return redirect(route('classroomDetails.index'));
    }

    /**
     * Remove the specified ClassroomDetail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classroomDetail = $this->classroomDetailRepository->find($id);

        if (empty($classroomDetail)) {
            Flash::error('Classroom Detail not found');

            return redirect(route('classroomDetails.index'));
        }

        $this->classroomDetailRepository->delete($id);

        Flash::success('Classroom Detail deleted successfully.');

        return redirect(route('classroomDetails.index'));
    }
}
