<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        try {
            return view('app');
        } catch (\Exception $e) {
            return response()->json(['error' => trans("Oops, Something Went Wrong")]);
        }
    }

    public function Users()
    {
        $users = User::latest()->paginate(12);
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'gender' => 'required',
            'skills' => 'required',
            'photo' => 'required',
        ]);

        $position = strpos($request->photo, ';');
        $sub = substr($request->photo, 0, $position);
        $ext = explode('/', $sub)[1];
        $name = time() . '.' . $ext;
        $img = Image::make($request->photo)->resize(250, 250);

        $upload_path = 'image/users/';
        $image_url = $upload_path . $name;
        $img->save($image_url);

        $users = new User;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->skills = implode(',', $request->skills);
        $users->photo = '/' . $image_url;
        $users->save();

        return response()->json(['success' => 'Successfully User created']);
    }
    public function edit($id)
    {
        $User = User::find($id);
        return response()->json(['user' => $User]);
    }

    public function update(Request $request)
    {
        $users = User::find($request->id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->skills = implode(',', $request->skills);
        $dbImg = $users->photo;

        if ($request->photo != $dbImg) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(250, 250);

            $upload_path = 'image/users/';
            $image_url = $upload_path . $name;
            $success = $img->save($image_url);

            if ($success) {
                $imgpath = public_path($dbImg);
                if ($dbImg && file_exists($imgpath)) {
                    unlink($users->photo);
                }
                $users->photo = $image_url;

                $users->update();
            }
        } else {
            $users->photo = $request->photo;
            $users->update();
        }
        // $User->save();
        return response()->json(['success' => "Category Updated Successfully !"]);
    }


    public function destroy($id)
    {
        $User = User::Find($id);

        if ($User) {

            $Userimg = $User->photo;
            $imgpath = public_path($Userimg);
            if ($Userimg && file_exists($imgpath)) {
                unlink(substr($User->photo, 1));
            }

            $User->delete();
            return response()->json(['success' => 'User Deleted Successfully !']);
        } else {
            return response()->json('failed', 404);
        }
    }
}