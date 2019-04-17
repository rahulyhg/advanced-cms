<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-roles', ['only' => ['index', 'show']]);
        $this->middleware('permission:update-roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-roles', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(30);        
        return view('manage.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.roles.create');
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
            'name' => 'required|alpha_dash|max:255|unique:roles,name',
            'display_name' => 'required|string|max:255',
            'description' => 'required|string',            
        ));

        $role = new Role;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        return redirect()->route('manage.roles.index')->with('success', 'role has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('manage.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {        
        return view('manage.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, array(
            'name' => 'alpha_dash|max:255|unique:roles,name,'.$role->id,
            'display_name' => 'string|max:255',
            'description' => 'string',            
        ));        
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();        
        return redirect()->route('manage.roles.index')->with('success', 'role has been updated');
    }

    public function assignPermissionsForm(Role $role){
        $permissions = Permission::all();
        $assignedPermissions = $role->permissions->pluck('id')->toArray();
        return view('manage.roles.assign_permissions', compact('role', 'permissions', 'assignedPermissions'));
    }

    public function assignPermissions(Request $request, Role $role){
        $rolePermissions = $request->input('rolePermissions');
        $role->permissions()->sync($rolePermissions);
        return redirect()->route('manage.roles.index')->with('success', 'permissions has been signed to '.$role->display_name.' role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('manage.roles.index')->with('success', 'role has been deleted');
    }
}
