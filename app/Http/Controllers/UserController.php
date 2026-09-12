<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return view('user.index',[
            'users'=>User::all()
        ]);
    }
    public function create(){
        return view('user.create');
    }
    public function store(StoreUserRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('users.index')->with('sucess','Utilisateur ajouté avec succés');;
    }
    public function edit(User $user){
        return view('user.edit',compact('user'));
    }
    public function update(User $user,UpdateUserRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('users.index')->with('sucess','Utilisateur modifié avec succés');;
    }
    public function delete(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('sucess','Utilisateur supprimé avec succés');
    }
}

