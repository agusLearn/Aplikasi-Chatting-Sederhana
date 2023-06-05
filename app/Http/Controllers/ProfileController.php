<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(){
        $id = Auth::user()->id;

        $profileUser = User::leftJoin('personal_information', 'users.id', '=', 'personal_information.user_id')->where('users.id', $id)->first();

        return response()->json($profileUser);
    }


    public function saveEditProfile(Request $data)
    {

        $id = Auth::user()->id;
        $user = User::find($id);
        $personalInfo = PersonalInformation::find($user->id);
        $name = '';
        $status = false;

        if(!$user->name == $data->name){
            $name = $data->name;
        }else{
            $name = $user->name;
        }


        if(!$data->hasFile('new_file_photo')){
            $user->name = $name;
            $user->save();
            $personalInfo->description = $data->description;
            $status = $personalInfo->save();
        }else{
            $file = $data->file('new_file_photo');

            $originalName = $file->getClientOriginalName();
            $extension =  $file->getClientOriginalExtension();
            $modifiedName = preg_replace('/[^a-zA-Z0-9.-]/', '-', $originalName);
            $path_storage_file = 'photo-profile';
            
            // this variable will save in database

            $user->name = $name;
            $user->save();

            $personalInfo->description = $data->description;
            $newName = pathinfo($modifiedName, PATHINFO_FILENAME) . '-' . time() . '.' . $extension;
            $path = $path_storage_file.'/'.$newName;

            $file->move(public_path($path_storage_file), $newName);

            $personalInfo->description = $data->description;
            $personalInfo->photo_profile = $newName;
            $personalInfo->path_photo_profile = $path;
            $status = $personalInfo->save();
        }

        if($status == false){
            return response()->json(['status' => 'failed', 'message' => 'Opps.. something wrong with system']);
        }
        return response()->json(['status' => 'success', 'message' => 'Success change your profile']);
    }
}
