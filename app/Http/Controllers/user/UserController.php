<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserRequest;
use App\Models\user\Address;
use App\Models\user\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            if ($users->isEmpty()) {
                session()->flash('warning', 'Nothing to show with "' . $search_param . '".');
            }
            return view('pages.users.users', compact('users', 'search_param'));

        } else {
            $users = User::withTrashed()->paginate(8);
            return view('pages.users.users', compact('users'));
        }


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

            if ($user->addresses()->count() == 0) {
                $address = new Address($dataToUpdate['address']);
                $address->save();
                $user->addresses()->attach($address->id);
            } else {
                $userAddress = $user->addresses()
                    ->where('country', $dataToUpdate['address']['country'])
                    ->where('state', $dataToUpdate['address']['state'])
                    ->where('city', $dataToUpdate['address']['city'])
                    ->where('lot', $dataToUpdate['address']['lot'])
                    ->where('zipcode', $dataToUpdate['address']['zipcode'])
                    ->first();

                if (!$userAddress) {
                    $existingAddress = Address::where('country', $dataToUpdate['address']['country'])
                        ->where('state', $dataToUpdate['address']['state'])
                        ->where('city', $dataToUpdate['address']['city'])
                        ->where('lot', $dataToUpdate['address']['lot'])
                        ->where('zipcode', $dataToUpdate['address']['zipcode'])
                        ->first();

                    if ($existingAddress) {
                        $user->addresses()->attach($existingAddress->id);
                    } else {
                        $newAddress = new Address($dataToUpdate['address']);
                        $newAddress->save();
                        $user->addresses()->attach($newAddress->id);
                    }
                }
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
