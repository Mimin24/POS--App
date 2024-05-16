<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        // show data user
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')->orWhere('email', 'like', '%' . $name . '%');
            })
            ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    //create
    public function create()
    {
        return view('pages.users.create');
    }

    //add
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:5',
            'role'=> 'required|in:admin,staff,user',
        ]);
        // add data
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect() ->route('users.index')->with('success', 'New User has been Created ');
    }

    public function show($id)
    {
        return view('pages.users.show');
    }

    // edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    //update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required|in:admin,staff,user',
        ]);
        // update data by id
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('users.index')->with('success', 'Data has been Updated ');
    }

    //delete data
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect() ->route('users.index')->with('success', 'Data has been Deleted ');
    }
}
