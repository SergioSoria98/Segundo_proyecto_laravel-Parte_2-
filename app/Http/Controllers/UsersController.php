<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Http\Requests\CreateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->middleware('roles:admin', ['except' => ['edit', 'update', 'show']]);
    }


    public function index()
    {
        $users = User::with(['roles', 'note', 'tags'])->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create( $request->all() );

        $user->roles()->attach($request->roles);

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('edit', $user);

        $roles = Role::pluck('display_name', 'id');

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize($user);

        $user->update($request->only('name', 'email'));
        $user->roles()->sync($request->roles);

        return back()->with('info', 'Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('destroy', $user);
        
        $user->delete();
    
        return back();
    }
}
