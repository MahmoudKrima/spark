<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $users = User::where('role', 'user')
            ->with('details')
            ->paginate();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['role'] = 'user';
        User::create($data);
        return back()
            ->with('Success', 'Created Successfully');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)
            ->where('role', 'user')
            ->first();
        if (!$user) {
            return redirect()
                ->route('users.index')
                ->with("Error", "Not Found");
        }
        return view('pages.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::where('id', $id)
            ->where('role', 'user')
            ->first();
        if (!$user) {
            return redirect()
                ->route('users.index')
                ->with("Error", "Not Found");
        }
        $data = $request->validated();
        if (!isset($data['password'])) {
            unset($data['password']);
        }
        $user->update($data);
        return back()
            ->with('Success', 'Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)
            ->where('role', 'user')
            ->first();
        if (!$user) {
            return redirect()
                ->route('users.index')
                ->with("Error", "Not Found");
        }
        $user->delete();
        return back()
            ->with('Success', 'Deleted Successfully');
    }
}
