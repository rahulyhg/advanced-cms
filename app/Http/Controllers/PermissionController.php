<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:read-permissions', ['only' => ['index', 'show']]);
        $this->middleware('permission:update-permissions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-permissions', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(30);
        return view('manage.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {               
        if ($request->permissionType === "basic") {
            $this->validate($request, array(
                'name' => 'required|alpha_dash|max:255|unique:roles,name',
                'display_name' => 'required|string|max:255',
                'description' => 'required|string',
            ));
            $permission = new Permission;
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();
        }else if ($request->permissionType === "crud") {
            $this->validate($request, array(                
                'resource' => 'required|string|min:5|max:255',
            ));

            $resource = $request->resource;                 
            $reourcePermissions = $request->input('reourcePermissions');        
            foreach ($reourcePermissions as $resourcePermission) {
                $permission = new Permission;
                $display_name = ucwords($resourcePermission.' '.$resource);
                $description = ucwords('user can '.$resourcePermission.' '.$resource);
                $name = strtolower($resourcePermission.'-'.$resource);
                $permission->name=$name;
                $permission->display_name=$display_name;
                $permission->description=$description;
                $permission->save();
            }        
        }
        return redirect()->route('manage.permissions.index')->with('success', 'permission has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('manage.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('manage.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, array(
            'name' => 'alpha_dash|max:255|unique:permissions,name,'.$permission->id,
            'display_name' => 'string|max:255',
            'description' => 'string',            
        ));
        
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();
        return redirect()->route('manage.permissions.index')->with('success', 'permission has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('manage.permissions.index')->with('success', 'permission has been deleted');
    }
}
