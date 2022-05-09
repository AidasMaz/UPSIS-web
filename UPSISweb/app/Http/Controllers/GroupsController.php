<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\Group;
use App\Models\Student;
use App\Models\Solution;
use Carbon\Carbon;
use DB;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get data for seeder
        // $students = DB::table('students')->get();
        // $string = "";
        // foreach($students as $std)
        // {
        //     $string .= $std->id . ", ";
        // }
        // dd($string);
        // Get data for seeder
        
        $groups = Group::orderBy('type', 'asc')->orderBy('title', 'asc')->get();
        foreach($groups as $group)
        {
            $group['count'] = count(DB::table('students')->where('group_id', $group->id)->get());
        }
        $mytime = date('m');
        // dd($mytime);

        $childrenCount= Student::count();
        $numberOfsolutionsMonth=count(Solution::whereMonth('play_date', 4)->get()); //date('m')
       
        $numberOfsolutionsWeek=count(Solution:: whereBetween('play_date', ['2022-04-04', '2022-04-10'])->get()); //[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
        
        $studentsAndSolutionsCount=DB::table('solutions')
        ->select('student_id', DB::raw('COUNT(student_id) as countas'))
        ->groupBy('student_id')       
        ->get()->toArray();
        
        $studentsAndGroups=DB::table('students')
        ->select('group_id', DB::raw('COUNT(group_id) as gcountas'))
        ->groupBy('group_id')       
        ->get()->toArray();
        

        
        // $belekas=DB::table('students')        
        // ->join($belekasTable,'id','=',$belekasTable->student_id)
        // ->select('*');
        // DB::table('students')
        //             ->select(DB::raw('count(group_id) as GRCount'))
        //             ->groupBy('group_id')
        //             ->get();

        // DB::table('students')
        // ->select('id', 'group_id', DB::raw('COUNT(group_id) as gcount')
        // ->join(DB::raw(DB::table('solutions')
        //     ->select('student_id', DB::raw('COUNT(student_id) as scount')->groupBy('student_id'))), function($join) {
        //     $join->on('id','=','c.student_id');
        // }
        // ->groupBy('group_id')
        // ->get();

        //dd($studentsAndGroups);

        return view('pages.dashboard')->with(['groups'=> $groups, 
        'childrenCount'=>$childrenCount,
        'numberOfsolutionsMonth'=>$numberOfsolutionsMonth,
        'numberOfsolutionsWeek'=>$numberOfsolutionsWeek]);
    }

    public function openGroups()
    {        
        $groups = Group::orderBy('type', 'asc')->orderBy('title', 'asc')->get();
        foreach($groups as $group)
        {
            $group['count'] = count(DB::table('students')->where('group_id', $group->id)->get());
        }
        
        return view('groups.index')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|alpha_num',
            'type' => 'required',
            'count' => 'required|numeric'
        ]);

        $same_title_group_num = DB::table('groups')->where('title', $request->input('title'))->count();
        if ($same_title_group_num > 0)
        {
            return redirect('/groups')->with('error', 'Tokia grupė jau egzistuoja');
        }

        $group = new Group;
        $group->title = $request->input('title');
        $group->type = $request->input('type');
        $group->save();

        $name = "A";
        $count = (int)$request->input('count');
        for ($i = 0; $i < $count; $i++)
        {
            $student = new Student;
            $student->name = $name;
            $student->group_id = $group->id;
            $student->save();

            $name = ++$name;
            if($name == "Q")
            {
                $name = ++$name;
            }
        }

        return redirect('/groups')->with('success', 'Grupė sukurta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        $students = DB::table('students')->where('group_id', $id)->orderBy('name', 'asc')->get();
        $games = DB::table('games')->get();

        $name = "A";
        $names = array();
        for ($i = 0; $i < 20; $i++)
        {
            if (!Student::where('group_id', $id)->where('name', $name)->exists())
            {
                array_push($names, $name);
            }

            $name = ++$name;
            if ($name == "Q")
            {
                $name = ++$name;
            }
        }

        $game_ids = DB::table('games')->pluck('id')->toArray();

        foreach ($students as $student)
        {
            $solutions = DB::table('solutions')->where('student_id', $student->id)->orderBy('play_date', 'desc')->get();

            $student->solution_count = count($solutions);
            if ($student->solution_count == 0)
            {
                $student->last_solution_date = "Nėra";
            }
            else
            {
                $last_solution = $solutions->first();
                $student->last_solution_date = data_get($last_solution, 'play_date');
                $progresion = array();

                foreach ($game_ids as $game_id)
                {
                    $game_category_ids = DB::table('game_categories')->where('game_id', '=', $game_id)->select('id', 'title')->get()->toArray();
                    $progress_array = array();

                    foreach ($game_category_ids as $game_category_id)
                    {
                        $category_solutions = $solutions->where('game_category_id', '=', $game_category_id->id)->pluck('correct_answer_count')->toArray();
                        if (count($category_solutions) >= 2)
                        {
                            array_push($progress_array, $game_category_id->title.": ".$this->linear_regression($category_solutions));
                        }
                        else
                        {
                            array_push($progress_array, $game_category_id->title.": Nepakanka duomenų");
                        }
                    }
                    //dd($progress_array);
                    array_push($progresion, $progress_array);
                }

                $student->progresions = $progresion;
                //dd($student);

                //dd($solutions->where('game_category_id', '=', 1)->orWhere('game_category_id', '=', 2));
                // dd($solutions->where('game_category_id', '=', 1)->where('game_category_id', '=', 2)
                // ->where('game_category_id', '=', 3));->pluck('correct_answer_count')->toArray()

                // if (linear_regression())
                //     $student->suskaiciuok = "Yra (pagal ". ." spr.)";
                // else
                //     $student->suskaiciuok = "Nėra (pagal ". ." spr.)";               
            }
            //dd($student);
        }
        //dd($students); 

        return view('groups.show')->with(array ('group' => $group, 'students' => $students, 'games' => $games, 'names' => $names));
    }

    /**
     * linear regression function
     * @param $x array x-coords
     * @param $y array y-coords
     * @returns array() m=>slope, b=>intercept
     */
    public function linear_regression($y) {

        $x = range(0, count($y) - 1);

        $x_sum = array_sum($x);
        $y_sum = array_sum($y);

        $n = count($y);
        $xx_sum = 0;
        $xy_sum = 0;

        for($i = 0; $i < $n; $i++) {
            $xy_sum += ($x[$i] * $y[$i]);
            $xx_sum += ($x[$i] * $x[$i]);
        }

        $slope = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));

        if ($slope > 0)
            return "Yra (pagal ".$n." spr.)";
        else
            return "Nėra (pagal ".$n." spr.)";
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        return view('groups.edit')->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|alpha_num',
            'type' => 'required'
        ]);

        $same_title_num = DB::table('groups')->where('title', $request->title)->count();
        $same_title_id = DB::table('groups')->where('title', $request->title)->get();
       
        if (($same_title_num==1 && $same_title_id[0]->id!=$id) || $same_title_num > 1)
        {
            return redirect()->route('group', $id)->with('error', 'Toks pavadinimas jau egzistuoja');
        }
        $group = Group::find($id);
        $group->title = $request->input('title');
        $group->type = $request->input('type');
        $group->save();

        return redirect()->route('group', $id)->with('success', 'Grupė atnaujinta');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students_request = DB::table('students')->where('group_id', $id);
        foreach($students_request->get() as $student)
        {
            DB::table('solutions')->where('student_id', $student->id)->delete();
        }
        $students_request->delete();

        $group = Group::find($id);
        $group->delete();

        return redirect('/groups')->with('success', 'Grupė ištrinta');
    }

    public function destroyAllGroups()
    {        
        $solutions = DB::table('solutions')->delete();

        $students = DB::table('students')->delete();

        $groups = DB::table('groups')->delete();
        
        return redirect('/groups')->with(array('groups' => $groups, 'success' => 'Visos grupės ištrintos'));
    }

    public function destroyAllSolutions()
    {        
        $solutions = DB::table('solutions')->delete();
        
        $groups = Group::orderBy('type', 'asc')->orderBy('title', 'asc')->get();

        return redirect('/groups')->with(array('groups' => $groups, 'success' => 'Visų grupių informacija ištrinta'));
    }
}
