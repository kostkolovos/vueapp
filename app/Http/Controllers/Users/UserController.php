<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show All Profiles.
     *
     * @return Renderable
     */
    public function list(): Renderable
    {
        return view('users.users', ['users' => $this->usersfetch()]);
    }

    /**
     * Delete User Profile.
     *
     * @param $id
     * @return bool
     */
    public function deleteProfile($id): bool
    {
        return User::find($id)->delete();
    }

    /**
     * Delete User Profile.
     * @param Request $request
     * @return mixed
     */
    public function createProfile(Request $request)
    {
        return User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
    }

    /**
     * Edit User Profile.
     *
     * @param Request $request
     * @return mixed
     */
    public function editProfile(Request $request)
    {
        $userArray = [
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ];

        if ($request->get('password')) {
            $userArray['password'] = Hash::make($request->get('password'));
        }

        return User::find($request->get('id'))->update($userArray);
    }

    /**
     * Edit User Profile.
     *
     * @return mixed
     */
    public function usersfetch()
    {
        return User::all()->sortBy([
            ['id', 'desc']
        ]);
    }

}
