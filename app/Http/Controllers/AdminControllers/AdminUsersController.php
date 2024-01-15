<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use App\Models\Role;
use App\Models\User;

class AdminUsersController extends Controller
{
    private $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:20',
        'image' => 'nullable|file|mimes:jpg,png,webp,svg,jpeg|dimensions:max_width=300,max_height=300',
        'role_id' => 'required|numeric'
    ];
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.users.create', [
          'roles' => Role::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['password'] = Hash::make($request->input('password'));

        $user = User::create($validated);

        if($request->has('image'))
        {
            $image = $request->file('image');

            $filename = $image->getClientOriginalName();
            $file_extension = $image->getClientOriginalExtension();
            $path = $image->store('images', 'public');

            $user->image()->create([
              'name' => $filename,
              'extension' => $file_extension,
              'path' => $path
            ]);
        }

        return redirect()->route('admin.users.create')->with('success', 'User has been created.');
    }

    public function edit(User $user)
    {
        return view('admin_dashboard.users.edit', [
          'user' => $user,
          'roles' => Role::pluck('name', 'id')
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->rules['password'] = 'nullable|min:3|max:20';
        $this->rules['email'] = ['required', 'email', Role::unique('users')->ignore($user)];

        $validated = $request->validate($this->rules);

        if ($validated['password'] === '')
            unset($validated['password']);
        else
            $validated['password'] = Hash::make($request->input('password'));

        $user = User::create($validated);

        if($request->has('image'))
        {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $file_extension = $image->getClientOriginalExtension();
            $path = $image->store('images', 'public');

            $user->image()->create([
              'name' => $filename,
              'extension' => $file_extension,
              'path' => $path
            ]);
        }

        return redirect()->route('admin.users.edit', $user)->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}