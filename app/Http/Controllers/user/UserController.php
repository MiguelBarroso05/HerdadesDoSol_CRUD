<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRequest;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch paginated users, including soft-deleted ones
        $search_param = $request->query('search_users');

        if ($search_param) {
            $users = User::withTrashed()
                ->where('username', 'like', '%' . $search_param . '%')
                ->orWhere('firstname', 'like', '%' . $search_param . '%')
                ->orWhere('lastname', 'like', '%' . $search_param . '%')
                ->paginate(8);

        } else {
            $users = User::withTrashed()->paginate(8);
        }
        return view('pages.users.users', compact('users', 'search_param'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('pages.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('pages.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            $validated = $request->validated();
            $dataToUpdate = $validated;

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                $filename = $user->id . '_' . $user->username . '.' . $img->getClientOriginalExtension();
                $url = $img->storeAs('users', $filename, 'public');
                $dataToUpdate['img'] = $url;
            }

            $user->roles()->sync([$request->role]);

            $user->update($dataToUpdate);

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    public function recover(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('users.index')->with('success', 'User recovered successfully');
    }

}
