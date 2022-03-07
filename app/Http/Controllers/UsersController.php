<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_index'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
        $users = User::when($request->email, function ($query, $email) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        })->paginate();
        $users->load('roles');
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
        return Inertia::render('Users/Create', [
            'allRoles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string'],
            'roles'         => ['required'],
        ])->validate();

        $user = DB::transaction(function () use ($request) {
            return tap(User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'organizer_id' => $request['organizer_id'],
                'password' => Hash::make($request['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });

        DB::table('role_user')->where('user_id', $user->id)->update([
            'user_id' => $user->id,
            'role_id' => $request['roles'],
        ]);

        return Redirect::route('users.index')->with('success', 'The user was successfully created.');
    }

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    protected function createUserRole(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
        $user->load('roles');
        return Inertia::render('Users/Show', [
            'users' => $user,
        ]);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
        $user->load('roles');
        return Inertia::render('Users/Edit', [
            'users' => $user,
            'allRoles' => Role::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->validate([
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users,email,' . request()->route('user')->id],
            'roles'         => ['required'],
        ]));

        $role = Role::where('title', $request->roles[0][0]['title'])->first();
        $user->roles()->sync($role);

        return redirect()->route('users.index')->with('success', 'The user has been successfully updated.');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_destroy'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
        $user->delete();
        return Redirect::route('users.index')->with('success', 'The user was successfully deleted.');
    }
}
