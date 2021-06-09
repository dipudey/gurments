<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Index', [
            'users' => User::query()->with('roleHasPermission.role')->paginate(20),
        ]);
    }

    public function paginate(Request $request)
    {
        return User::query()
            ->with('roleHasPermission.role')
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('roleHasPermission.role', function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%");
                })
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('name', 'like', "%{$request->search}%");
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
        return Inertia::render("User/Create", [
            'roles' => Role::query()->paginate(20)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            RoleHasPermission::query()->create([
                'user_id' => $user->id,
                'role_id' => $request->role_id,
            ]);
            DB::commit();
            return redirect()->route('user.index')->with('success', "User Created Successfully");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', "Somethig is wrong");
        }
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
        return Inertia::render('User/Edit', [
            'user' => User::query()->with('roleHasPermission')->where('id', $id)->first(),
            'roles' => Role::all(),
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
        try {
            DB::beginTransaction();
            $user = User::query()->where('id', $id)->first();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            RoleHasPermission::query()->where('user_id', $id)->first()->update([
                'role_id' => $request->role_id,
            ]);
            DB::commit();
            return redirect()->route('user.index')->with('success', "User Updated Successfully");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', "Somethig is wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoleHasPermission::query()->where('user_id', $id)->first()->delete();
        User::find($id)->delete();
        return back()->with('error', "User Deleted Successfully");
    }
}
