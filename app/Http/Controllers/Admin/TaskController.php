<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Repositories\TaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MemberAnswerExport;

// Additional
use Illuminate\Support\Facades\Storage; // added by dandisy
use Auth;
use File;

// Models
use App\User;
use App\Models\Task;
use App\Models\TaskQuestion;
use App\Models\TaskAnswer;
use App\Models\Classroom;
use App\Models\MemberTask;

class TaskController extends AppBaseController
{
    /** @var  TaskRepository */
    private $taskRepository;


    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepository = $taskRepo;
    }

    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auth = Auth::user()->id;
        $user = User::where('id', $auth)->with('role')->first()->toArray();
        if ($user['role']['name'] === 'teacher') {
            $tasks = Task::where('created_by', $auth)->get();
        }else{
            $tasks = $this->taskRepository->all();
        }

        return view('admin.tasks.index')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create()
    {
        $label = ['A', 'B', 'C', 'D'];
        $classroom = Classroom::pluck('name', 'id');

        return view('admin.tasks.create')
            ->with('label', $label)
            ->with('classroom', $classroom);
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskRequest $request)
    {
        $input = $request->all();
        // dd($input);

        // CREATE FOLDER
        $pathImage = 'public/question';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        $task = $this->taskRepository->create($input);

        foreach ($input['question'] as $key => $value) {

            // UPLOAD IMAGE
            if (@$value['image_new']) {
                $cover = $value['image_new'];
                if (!empty($cover)) {                    
                    $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                    Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                    $value['image'] = $fileCover;

                    if($value['image'] !== '' && $value['image'] !== $fileCover){
                        @Storage::delete($pathImage . $value['image']);
                    }

                }
            }
            $taskQustion = TaskQuestion::create([
                'task_id' => intval($task->id),
                'image' =>  $value['image'],
                'attach' => $value['attach'],
                'question' => $value['question'],
                'point' => intval($value['point'])
            ]);

            foreach ($value['answer'] as $keyIn => $valueIn) {
                TaskAnswer::create([
                    'question_id' => $taskQustion->id,
                    'answer' => $valueIn['answer'],
                    'label' => $valueIn['label'],
                    'correct' => @$valueIn['correct'],
                ]);
            }
        }
        


        Flash::success('Task saved successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $task = Task::with('classroom.students')->whereId($id)->first();
        $students = $task->classroom->students->pluck('member_id');
        $students = [1,2,3];
        $answer = MemberTask::with('member')->with('answer.correct')->with('task.question.answer')->whereIn('member_id', $students)->where('task_id', $id)->get();
        // dd($task->toArray(), $students, $answer->toArray());
        // dd($answer->toArray());
        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('admin.tasks.show')
            ->with('task', $task)
            ->with('answer', $answer);
    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // $task = $this->taskRepository->find($id);

        $task = Task::with('question.answer')->whereId($id)->first();
        $classroom = Classroom::pluck('name', 'id');
        $label = ['A', 'B', 'C', 'D'];
        // dd($task->toArray());

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        return view('admin.tasks.edit')
            ->with('classroom', $classroom)
            ->with('label', $label)
            ->with('task', $task);
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        $task = $this->taskRepository->find($id);
        $input = $request->all();
        // dd($input);

        // CREATE FOLDER
        $pathImage = 'public/question';
        $dir = Storage::directories();
        if (!in_array($pathImage , $dir)) {
            Storage::makeDirectory($pathImage);
        }

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $task = $this->taskRepository->update($request->all(), $id);


        // del
        if(!empty($input['del'])) {
            $del = explode(",", $input['del']);
            foreach ($del as $key => $value) {
                TaskQuestion::whereId($value)->delete();
            }
        }

        foreach ($input['question'] as $key => $value) {

            // UPLOAD IMAGE
            if (@$value['image_new']) {
                $cover = $value['image_new'];
                if (!empty($cover)) {
                    $fileCover = uniqid() .'.'. $cover->getClientOriginalExtension();
                    Storage::put($pathImage . '/' . $fileCover, File::get($cover));
                    $value['image'] = $fileCover;
                }
            }

            if ($value['id'] != null) {
                // edit
                $taskQustion = TaskQuestion::whereId($value['id'])->update([
                    'task_id' => intval($task->id),
                    'image' =>  $value['image'],
                    'attach' => $value['attach'],
                    'question' => $value['question'],
                    'point' => intval($value['point'])
                ]);
                
                foreach ($value['answer'] as $keyIn => $valueIn) {
                    TaskAnswer::whereId($valueIn['id'])->update([
                        'question_id' => $valueIn['question_id'],
                        'answer' => $valueIn['answer'],
                        'label' => $valueIn['label'],
                        'correct' => !empty($valueIn['correct']) ? $valueIn['correct'] : 0 ,
                    ]);
                }
            } else {
                // add new
                $taskQustion = TaskQuestion::create([
                    'task_id' => intval($task->id),
                    'image' =>  $value['image'],
                    'attach' => $value['attach'],
                    'question' => $value['question'],
                    'point' => intval($value['point'])
                ]);

                foreach ($value['answer'] as $keyIn => $valueIn) {
                    TaskAnswer::create([
                        'question_id' => $taskQustion->id,
                        'answer' => $valueIn['answer'],
                        'label' => $valueIn['label'],
                        'correct' => !empty($valueIn['correct']) ? $valueIn['correct'] : 0 ,
                    ]);
                }
            }
        }
            

        Flash::success('Task updated successfully.');

        return redirect(route('tasks.index'));
    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->find($id);

        if (empty($task)) {
            Flash::error('Task not found');

            return redirect(route('tasks.index'));
        }

        $this->taskRepository->delete($id);

        Flash::success('Task deleted successfully.');

        return redirect(route('tasks.index'));
    }

    public function export($id) 
    {
        $task = Task::with('classroom.students')->whereId($id)->first();
        $students = $task->classroom->students->pluck('member_id');
        $students = [1,2,3];
        $answer = MemberTask::with('member')->with('answer.correct')->with('task.question.answer')->whereIn('member_id', $students)->where('task_id', $id)->get();

        dd($answer->toArray());
        return Excel::download(new MemberAnswerExport, 'tes.xlsx');
    }
}
