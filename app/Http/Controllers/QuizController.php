<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ADDITIONAL
use Auth;

// MODELS
use App\Models\Member;
use App\Models\MemberPoint;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('members');
    }

    public function index()
    {
        $idStudent = Auth::guard('members')->user()->id;

        // $color = $this->getJson('color.json');

        $user = Member::whereId($idStudent)->first()->toArray();
        $point = MemberPoint::where('member_id', $idStudent)->sum('point');
        $rank = MemberPoint::groupBy('member_id')->selectRaw("SUM(point) as point, member_id")->orderBy('point', 'desc')->get()->toArray();
        $rank = array_search($idStudent, array_column($rank, 'member_id')) + 1;

        $user = [
            'name' => $user['name'],
            'email' => $user['email'],
            'photo' => $user['photo'],
            'point' => $point,
            'rank' => $rank,
        ];
        // dd($user);

        return view('quiz.home',[
            // "color" => $color,
            "user" => $user,
        ]);
    }

    // private function getJson($data){
    //     $json = file_get_contents('data/'.$data);
    //     $json = json_decode($json, true); // decode the JSON into an associative array
    //     return $json;
    // }
}
