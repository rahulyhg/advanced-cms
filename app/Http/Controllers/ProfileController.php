<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('profiles.show', $user);
    }

    public function showLoginForm(){        
        return view('profiles.login_form');
    }

    public function login(Request $request){
        $this->validate($request, array(            
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ));        
        if ($request->email==Auth::user()->email) {
            if ((Hash::check($request->password, Auth::user()->password))) {
                return redirect()->route('profiles.edit', Auth::user());
            }else{
                return back()->with('fail', 'wrong password');    
            }
        }else{
            return back()->with('fail', 'no credential');
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, array(      
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'password' => ['string'],
        ));
        $user->name = $request->name;
        if ($request->has('email')) {
            $user->email = $request->email;    
        }
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }        
        $user->save();
        return redirect()->route('home')->with('success', 'user succesfully updated');
    }    
}
