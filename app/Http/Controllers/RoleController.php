<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render("Role/Index", [
            'roles' => Role::query()->paginate(20)
        ]);
    }

    public function paginate(Request $request)
    {
        return Role::query()
            ->when($request->search, function ($query) use ($request) {
                $query->orWhere('name', 'like', "%{$request->search}%");
            })
            ->paginate(20);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Role/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = array_keys(collect($request->permission)->filter(function ($item) {
            return $item;
        })->toArray());
        $role = new Role();
        $role->name = $request->name;
        $role->permission = json_encode($permission);
        $role->save();
        return redirect()->route('role.index')->with('success', "New Role Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render("Role/Edit", [
            'role' => Role::query()->where('id', $id)->first()
        ]);
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
        $permission = array_keys(collect($request->permission)->filter(function ($item) {
            return $item;
        })->toArray());
        $role = Role::find($id);
        $role->name = $request->name;
        $role->permission = json_encode($permission);
        $role->save();
        return redirect()->route('role.index')->with('success', "Role Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::query()->where('id', $id)->first()->delete();
        return back()->with('success', "Role Delete Successfully");
    }
}
