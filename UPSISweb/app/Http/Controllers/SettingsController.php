<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class SettingsController extends Controller
{
    public function index()
    {
        $general_user = DB::table('users')->where('id', 1)->first();
        $administration_user = DB::table('users')->where('id', 3)->first();
        
        return view('settings.settings')
        ->with(array('general_user' => $general_user, 'administration_user' => $administration_user));
    }
    
    public function edit(Request $request)
    {
        //$userId = Auth::user()->id;
        
        $validation = $request->validate([
            'id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);     
        $same_username_num = DB::table('users')->where('username', $request->name)->count();
        $same_username_id = DB::table('users')->where('username', $request->name)->get();
        // dd($same_username_id[0]->id);
        if ($same_username_num > 1 || ($same_username_num==1 && $same_username_id[0]->id!=$request->id))
        {
            return redirect('/settings')->with('error', 'Toks prisijungimo vardas jau egzistuoja');
        }
        
        $user = User::find($request->id);
        $user->username = $request->name;
        $user->password = Hash::make($request->password);       
        
        $user->save();
        $general_user = DB::table('users')->where('name', 'Bendras')->first();
        $administration_user = DB::table('users')->where('name', 'Administracija')->first();
        
        return redirect('/settings')->with('status', 'Duomenys atnaujinti!');
    }
}
