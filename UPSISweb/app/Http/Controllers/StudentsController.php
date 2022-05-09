<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Group;
use App\Models\Student;
use DB;

class StudentsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group_id)
    {
        $name = "A";
        $names = array();
        for ($i = 0; $i < 20; $i++)
        {
            if (!Student::where('group_id', $group_id)->where('name', $name)->exists())
            {
                array_push($names, $name);
            }

            $name = ++$name;
            if ($name == "Q")
            {
                $name = ++$name;
            }
        }

        return view('students.create')->with(array('group_id' => $group_id, 'names' => $names));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group_id)
    {
        $validation = $request->validate([
            'name' => 'required'
        ]);

        $student = new Student;
        $student->name = $request->input('name');
        $student->group_id = $group_id;
        $student->save();

        return redirect()->route('group', $group_id)->with('success', 'Vaikas pridėtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group_id, $student_id)
    {
        $student = DB::table('students')->where('id', $student_id)->first();
        $group = DB::table('groups')->where('id', $group_id)->first();
        $games_data = DB::table('games')->get();

        $cur_name = Student::find($student_id)->name;

        $name = "A";
        $names = array();
        for ($i = 0; $i < 20; $i++)
        {
            if (!Student::where('group_id', $group_id)->where('name', $name)->exists() or $name == $cur_name)
            {
                array_push($names, $name);
            }

            $name = ++$name;
            if ($name == "Q")
            {
                $name = ++$name;
            }
        }

        foreach($games_data as $game)
        {
            $categories = DB::table('game_categories')->where('game_id', $game->id)->get(['id', 'title']);
            $game->categories = $categories;

            $solutions = array();
            foreach($categories as $category)
            {
                $category_solutions = DB::table('solutions')->where('student_id', $student->id)   
                ->where('game_category_id', $category->id)->get();
                
                foreach($category_solutions as $solution)
                {
                    if ($solution->was_solution_canceled == 1)
                    {
                        $solution->was_canceled = "Taip";
                    }
                    else
                    {
                        $solution->was_canceled = "Ne";
                    }

                    $solution->category = $category->title;

                    array_push($solutions, $solution);
                }
            }
            //dd($solutions);

            $game->solutions = collect($solutions)->sortBy('play_date')->reverse() ->toArray();
            // dd(gmdate('H:i:s', $game->solutions[0]->duration));
            
        }
        //dd($games_data);
        // $dateTime->format('Y-m-d H:i:s');
        return view('students.show')->with(array('group' => $group, 'student' => $student, 'games' => $games_data, 'names' => $names));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group_id, $student_id)
    {
        $cur_name = Student::find($student_id)->name;

        $name = "A";
        $names = array();
        for ($i = 0; $i < 20; $i++)
        {
            if (!Student::where('group_id', $group_id)->where('name', $name)->exists() or $name == $cur_name)
            {
                array_push($names, $name);
            }

            $name = ++$name;
            if ($name == "Q")
            {
                $name = ++$name;
            }
        }

        return view('students.edit')->with(array('group_id' => $group_id, 'student_id' => $student_id, 'names' => $names, 'cur_name' => $cur_name));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group_id, $student_id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $student = Student::find($student_id);
        $student->name = $request->input('name');
        $student->save();

        return redirect()->route('student', array('group_id' => $group_id, 'student_id' => $student_id))->with('success', 'Vaikas atnaujintas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id, $student_id)
    {
        DB::table('solutions')->where('student_id', $student_id)->delete();

        $student = Student::find($student_id);
        $student->delete();

        return redirect()->route('group', $group_id)->with('success', 'Vaikas ištrintas');
    }

    public function destroyGroupStudents($group_id)
    {
        $students_request = DB::table('students')->where('group_id', $group_id);
        foreach($students_request->get() as $student)
        {
            DB::table('solutions')->where('student_id', $student->id)->delete();
        }
        $students_request->delete();

        return redirect()->route('group', $group_id)->with('success', 'Grupės vaikai ištrinti');
    }

    public function destroyGroupSolutions($group_id)
    {
        $students = DB::table('students')->where('group_id', $group_id)->get();
        foreach($students as $student)
        {
            DB::table('solutions')->where('student_id', $student->id)->delete();
        }

        return redirect()->route('group', $group_id)->with('success', 'Grupės vaikų sprendimai ištrinti');
    }

    public function destroyStudentSolutions($group_id, $student_id)
    {
        DB::table('solutions')->where('student_id', $student_id)->delete();

        return redirect()->route('student', array('group_id' => $group_id, 'student_id' => $student_id))->with('success', 'Vaiko sprendimai ištrinti');
    }
}
