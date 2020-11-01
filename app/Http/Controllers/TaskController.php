<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ADDITIONAL
use Auth;

// MODELS
use App\Models\Task;
use App\Models\TaskQuestion;
use App\Models\TaskAnswer;
use App\Models\Member;
use App\Models\MemberTask;
use App\Models\MemberPoint;
use App\Models\MemberAnswer;
use App\Models\Subject;

class TaskController extends Controller
{
    public function __construct()
    {
      $this->middleware('members');
    }

    public function index()
    {
        $idStudent = Auth::guard('members')->user()->id;
        // dd($idStudent);
        $class = Member::with('class.classParent')->where('id', $idStudent)->first()->toArray();
        $class = $class['class']['class_parent']['id'];

        $task = Subject::with(['teacher.task' => function ($query) use ($class, $idStudent){
                    $query->where('classroom_id', $class);
                    $query->with(['membertask' => function ($q) use ($idStudent){
                        $q->where('member_id', $idStudent);
                    }]);
                }])->whereHas('teacher.task', function ($query) use ($class){
                    // return $query->where('classroom_id', '=', $class);
                })->get()->toArray();
        // dd($task);

        return view('task.index',[
            'task' => $task
        ]);
    }

    public function taskdetail($id)
    {
        $idStudent = Auth::guard('members')->user()->id;
        // $idStudent = 1;

        $color = $this->getJson('color.json');
        
        // $task = TaskQuestion::with('answer')->where('task_id', $id)->get()->toArray();
        $task = Task::with(['question' => function ($query){
            $query->with('answer');
            // $query->with('memberanswer');
        }])->with(['membertask' => function ($query) use ($idStudent){
            $query->where('member_id', $idStudent);
            $query->with('answer');
        }])->where('id', $id)->first()->toArray();
        // dd($task);

        return view('task.detail', [
            "task" => $task,
            "task_id" => $id,
            "color" => $color,
        ]);
    }

    public function storeAnswer(Request $request)
    {
        if ($request->ajax()) {
            $user_id = Auth::guard('members')->user()->id;
            $input = $request->all();
            $answer = $input['answer'];
            $task = $input['task'];
            // dd($input);

            $createMemberTask = MemberTask::create([
                'member_id' => $user_id,
                'task_id' => $task['task_id'],
                'status' => 'done',
            ]);

            $pointTask = Task::where('id', $task['task_id'])->select('point','id')->first()->toArray();

            MemberPoint::create([
                'member_id' => $user_id,
                'model_type' => 'App\Models\Task',
                'model_id' => $task['task_id'],
                'point' => $pointTask['point']
            ]);


            foreach ($answer as $key => $value) {
                MemberAnswer::create([
                    'member_task_id' => $createMemberTask->id,
                    'question_id' => $value['question_id'],
                    'answer_id' => $value['answer_id'],
                ]);

                $cek = TaskQuestion::with('answer')->where('id', $value['question_id'])->first()->toArray();
                // dd($cek,$answer);
                foreach ($cek['answer'] as $keyIn => $valueIn) {
                    if (
                        $valueIn['id'] == $value['answer_id'] 
                        && $valueIn['correct'] === 1
                    ) {
                        MemberPoint::create([
                            'member_id' => $user_id,
                            'model_type' => 'App\Models\TaskQuestion',
                            'model_id' => $task['task_id'],
                            'point' => $cek['point']
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'success',
                // 'data' => $input
            ]);
        }
    }

    private function getJson($data){
        $json = file_get_contents('data/'.$data);
        $json = json_decode($json, true); // decode the JSON into an associative array
        return $json;
    }
}
