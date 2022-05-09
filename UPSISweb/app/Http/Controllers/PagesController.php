<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function index(){
        //$title = 'Welcome To Laravel!';
        return view('pages.index');//->with('title', $title);
    }

    public function  about(){
        //$title = 'About us';
        return view('pages.about');//->with('title', $title);
    }

    // public function login(){
    //     // $data = array(
    //     //     'title' => 'Services',
    //     //     'services' => ['Web Design', 'Programming', 'SEO']
    //     // );
    //     return view('pages.login');//->with($data);
    // }
    public function logout(){

        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

    // public function back(){
    //     return back();
    // }

    // public function  groups(){
    //     $title = 'Grupių sąrašo peržiūros langas';
    //     return view('pages.groups')->with('title', $title);
    // }
    // public function  groupChildren(){
    //     $title = 'Grupės vaikų sąrašo langas';
    //     return view('pages.groupChildren')->with('title', $title);
    // }
    // public function  groupGameStats(){
    //     $title = 'Grupės vaikų pasiekimų peržiūra pagal pasirinktą žaidimą';
    //     return view('pages.groupGameStats')->with('title', $title);
    // }
    // public function  childGameStats(){
    //     $title = 'Grupės vaiko visų pasiekimų peržiūra';
    //     return view('pages.childGameStats')->with('title', $title);
    // }
}
