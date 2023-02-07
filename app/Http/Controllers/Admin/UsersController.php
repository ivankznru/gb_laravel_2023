<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        //Show all exept the current user
        $users = User::query()->where('id', '!=', Auth::id())->paginate(20);

        return view('admin.users.index')->with('users', $users);
    }



    public function create()
    {
        $user = new User();
        return view('admin.users.create', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();
        return $this->saveData($request, $user);
    }

    public function edit(User $user)
    {
        return view('admin.users.create', [
            'user' => $user
        ]);
    }


    public function update(Request $request, User $user)
    {

        return $this->saveData($request, $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'The user was successfully deleted!');
    }

    /**
     * Saves data for create and update
     *
     * @return void
     */
    private function saveData(Request $request, User $user)
    {
        $this->validate($request, $this->validateRules($user->id), [], $this->attributeNames($user->id));
        $successMessage = 'The user profile was successfully updated!';
        if ($user->id == null) {
            $successMessage = 'A new user was added successfully!';
        }
        $user->fill([
            'name' => $request->post('name'),
            'email' => $request->post('email'),

        ]);
        $user->is_admin = strlen($request->post('is_admin')) > 0;
        if (strlen($request->post('newPassword')) > 0) {
            $user->password = Hash::make($request->post('newPassword'));
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success', $successMessage);
    }


    protected function validateRules($userId)
    {

        return [
            'name' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email' . ($userId == null ? "" : "," . $userId),
            'newPassword' => ($userId == null ? 'required' : ''),
        ];
    }

    protected function attributeNames($userId)
    {
        return [
            'newPassword' => ($userId == null ? 'password' : 'new password')
        ];
    }
}
