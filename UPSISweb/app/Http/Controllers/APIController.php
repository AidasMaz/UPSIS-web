<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Solution;
use DB;

class APIController extends Controller
{
    public function GetGroups()
    {
        $groups = DB::table('groups')->orderBy('type', 'asc')->orderBy('title', 'asc')->get();

        return response()->json($groups);
    }

    public function GetGroupStudents($group_id)
    {
        try {
            $group = DB::table('groups')->where('id', $group_id)->get();

            if ($group == null)
            {
                throw (new Exception($message = 'Netinkamas grupės id', 404));
            }

            return response()->json(DB::table('students')
            ->where('group_id', $group_id)->orderBy('name', 'asc')->get());

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }  
    }

    public function StoreSolution(Request $request)
    {
        try {

            $payload = json_decode($request->getContent(), true);

            // request()->validate([
            //     'student_id' => 'required|number',
            //     'game_category_id' => 'required|number',
            //     'play_date' => 'required',
            //     'duration' => 'required|number',
            //     'correct_answer_count' => 'required|number',
            //     'incorrect_answer_count' => 'required|number',
            //     'timed_out_answer_count' => 'required|number',
            //     //'was_solution_canceled' => 'required|number'
            // ]);

            $solution = new Solution();
            $solution->student_id = $payload['student_id'];
            $solution->game_category_id = $payload['game_category_id'];
            $solution->play_date = $payload['play_date'];
            $solution->duration = $payload['duration'];
            $solution->correct_answer_count = $payload['correct_answer_count'];
            $solution->incorrect_answer_count = $payload['incorrect_answer_count'];
            $solution->timed_out_answer_count = $payload['timed_out_answer_count'];
            $solution->was_solution_canceled = $payload['was_solution_canceled'];
            $solution->save();
            
            return response()->json(['success' => 'Sprendimas issaugotas', 'data' => $solution]);
            
        } catch (Exception $e) {
            response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
