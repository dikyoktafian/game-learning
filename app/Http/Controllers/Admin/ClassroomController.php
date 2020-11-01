<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Repositories\ClassroomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

// Models
use App\Models\Classroom;
use App\Models\ClassroomDetail;
use App\Models\Member;


class ClassroomController extends AppBaseController
{
    /** @var  ClassroomRepository */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepo)
    {
        $this->classroomRepository = $classroomRepo;
    }

    /**
     * Display a listing of the Classroom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $classrooms = $this->classroomRepository->all();

        return view('admin.classrooms.index')
            ->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new Classroom.
     *
     * @return Response
     */
    public function create()
    {
        $students = Member::pluck('name', 'id');

        return view('admin.classrooms.create')
            ->with('students', $students);

    }

    /**
     * Store a newly created Classroom in storage.
     *
     * @param CreateClassroomRequest $request
     *
     * @return Response
     */
    public function store(CreateClassroomRequest $request)
    {
        $input = $request->all();

        $classroom = $this->classroomRepository->create($input);

        foreach ($input['students'] as $key => $value) {
            ClassroomDetail::create([
                'classroom_id' => $classroom->id,
                'member_id' => $value
            ]);
        }

        Flash::success('Classroom saved successfully.');

        return redirect(route('classrooms.index'));
    }

    /**
     * Display the specified Classroom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        return view('admin.classrooms.show')->with('classroom', $classroom);
    }

    /**
     * Show the form for editing the specified Classroom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classroom = Classroom::with('students')->whereId($id)->first();
        $students = Member::pluck('name', 'id');

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        return view('admin.classrooms.edit')
            ->with('classroom', $classroom)
            ->with('students', $students);
    }

    /**
     * Update the specified Classroom in storage.
     *
     * @param int $id
     * @param UpdateClassroomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassroomRequest $request)
    {
        $input = $request->all();
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        $classroom = $this->classroomRepository->update($request->all(), $id);
        ClassroomDetail::where('classroom_id', $id)->delete();

        foreach ($input['students'] as $key => $value) {
            ClassroomDetail::create([
                'classroom_id' => $classroom->id,
                'member_id' => $value
            ]);
        }

        Flash::success('Classroom updated successfully.');

        return redirect(route('classrooms.index'));
    }

    /**
     * Remove the specified Classroom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classroom = $this->classroomRepository->find($id);

        if (empty($classroom)) {
            Flash::error('Classroom not found');

            return redirect(route('classrooms.index'));
        }

        $this->classroomRepository->delete($id);

        Flash::success('Classroom deleted successfully.');

        return redirect(route('classrooms.index'));
    }
}
