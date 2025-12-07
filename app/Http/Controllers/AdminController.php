<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Carousel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function main(){
        return view('admin.main');
    }

    function users(){
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    function toggleRole(User $user){
        $user->role == 'admin' ? $user->role = 'user' : $user->role = 'admin';
        $user->save();
        return redirect()->back();
    }

    function deleteUser(User $user){
        $user->delete();
        return redirect()->back();
    }

    function deletedUsers(){
        $users = User::onlyTrashed()->get();
        return view('admin.deletedUsers', compact('users'));
    }

    function restoreUser($user){
        $deletedUser = User::onlyTrashed()->findOrFail($user);
        $deletedUser->restore();
        return redirect()->back();
    }

    function forceDeleteUser($user){
        $deletedUser = User::onlyTrashed()->findOrFail($user);
        $deletedUser->forceDelete();
        return redirect()->back();
    }

    function allUsers(){
        $users = User::withTrashed()->get();
        return view('admin.allUsers', compact('users'));
    }

    function carouselPage(){
        return view('admin.carousel');
    }

    function carouselUpload(Request $request){
        $fields = $request->validate([
            'title' => ['required', 'max:255', 'min:1'],
            'description' => ['required', 'between:1,255'],
            'pic' => ['required', 'image', 'mimes:jpg,png,gif,jpeg', 'max:1024']
        ]);

        $image_name = Str::uuid() . "." . $fields['pic']->extension();
        $fields['pic']->move(public_path('assets/images'), $image_name);
        $fields['pic'] = $image_name;
        Carousel::create($fields);
        return redirect()->back();
    }

    function tags(){
        $tags = Tag::all();
        return view('admin.tags', compact('tags'));
    }

    function tagCreate(Request $request){
        $fields = $request->validate([
            'name' => ['required', 'between:1,255']
        ]);

        Tag::create($fields);
        return redirect()->back();
    }
}
