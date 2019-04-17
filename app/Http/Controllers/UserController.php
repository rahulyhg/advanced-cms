<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-users', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-users', ['only' => ['index', 'show']]);
        $this->middleware('permission:update-users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(30);
        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ));
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('manage.users.index')->with('success', 'user has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('manage.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('manage.users.edit', compact('user'));
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
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['string', 'min:8', 'confirmed'],
            'currentPassword' => ['required', 'string'],
        ));        
        if ((Hash::check($request->currentPassword, $user->password))) {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }        
            $user->save();    
            return redirect()->route('manage.users.index')->with('success', 'user has been updated');
        }else{
            return back()->with('fail', 'wrong password');    
        }                
    }

    public function assignRolesForm(User $user){
        $roles = Role::all();
        $assignedRoles = $user->roles->pluck('id')->toArray();
        return view('manage.users.assign_roles', compact('user', 'roles', 'assignedRoles'));
    }

    public function assignRoles(Request $request, User $user){
        $userRoles = $request->input('userRoles');
        $user->roles()->sync($userRoles);
        return redirect()->route('manage.users.index')->with('success', 'roles has been signed to '.$user->display_name.' user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage.users.index')->with('success', 'user has been deleted');
    }
}