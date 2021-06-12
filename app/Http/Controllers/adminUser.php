<?php

namespace App\Http\Controllers;

use App\Models\admin_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class adminUser extends Controller
{
    function insertUser(Request $req){
        if($req->psw != $req->conpsw){
            if($req->userId){
                return Redirect::to("getUsers")->with("error", "re-write same password");
            }else{
                return Redirect::to("signUp")->with("error", "re-write same password");
            }
            exit;
        }
        $req->validate([
            "email" => "required|email",
            "psw" => "required|min:5", 
        ]);
        $parentId  = $req->session()->get("user_id", null);
        
        $dupCheck = admin_user::where("email", $req->email)->first();
        if($dupCheck){
            if($parentId){
                return Redirect::to("getUsers")->with("error", "User already present");
            }else{
                return view("login")->with("error", "User already present");
            }
        }else{
            if(!$req->userId){
                $insertUser = new admin_user();
                $insertUser->email = $req->email;
                $insertUser->password = $req->psw;
                $insertUser->parent_id = $parentId;
                $insertUser->save();
                if($parentId){
                    return Redirect::to("getUsers")->with("success", "User inserted successfully");
                }else{
                    return view("login")->with("success", "User inserted successfully");
                }
            }else{
                $user = admin_user::find($req->userId);
                $user->email = $req->email;
                $user->password = $req->psw;
                $user->parent_id = $parentId;
                $user->save();
                return Redirect::to("getUsers")->with("success", "User updated successfully");
            }
        }
    }

    function verifyUser(Request $req){
        $adminUser = admin_user::where("email", $req->uname)->first();
        if($adminUser && $req->psw == $adminUser->password){
            $req->session()->put("user_id", $adminUser->id);
            return redirect("/getUsers");
        }
    }

    function getUsers(){
        $userArr = array();
        $ii = 0;
        foreach(admin_user::all() as $user){
            $userArr[$ii]['email'] = $user->email;
            $userArr[$ii]['password'] = $user->password;
            $userArr[$ii]['id'] = $user->id;
            $userArr[$ii]['parent_id'] = $user->parent_id;
            $ii++;
        }
        return view("adminUser")->with("userData", $userArr);
    }

    function deleteUsers($user){
        $user = admin_user::find($user);
        $user->delete();
        return Redirect::to("getUsers")->with("success", "User deleted successfully");
    }

    function signUp($userId = null){
        if(!$userId){
            return view("signUp");
        }else{
            $userData = admin_user::where("id", $userId)->first();
            return view("signUp")->with("userData", $userData);
        }
    }
}
