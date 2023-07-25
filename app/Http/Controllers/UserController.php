<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules\Password;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where([
            ['role_type', '<>', 'super admin'],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
        ->orderBy('id', 'desc')
        ->paginate(10);

        
        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
         $validated = $request->validated();
         
         if ($request->role == 'admin'){
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(20),
                'role_type' => 'admin',
            ])->assignRole('admin');
         }elseif ($request->role == 'user'){
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(20),
                'role_type' => 'user',
            ])->assignRole('user');
         }

         return redirect()->route('users.index')->with('success', 'User Added Successfully');
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
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function resetPassword($user_id)
    {
        $user = User::find($user_id);
        return view('users.reset-password', compact('user'));
    }

    public function saveResetPassword(Request $request, $user_id)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        $user = User::find($user_id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'Successfully Reset'); 
    }

    public function disable2fa($user_id)
    {
        $user = User::find($user_id);
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Successfully Disabled'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $prevUser = User::find($user->id);
        $user->removeRole($prevUser->role_type);

        $user->fill($request->post())->save();
        
        $user->assignRole($request->role_type);
        

        return redirect()->route('users.index')->with('success', 'User Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Suceessfully');
    }

    public function export() 
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

   
}
