<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class userCategory extends Controller
{
    function viewCategory(){
        $categoryArr = array();
        $ii = 0;
        foreach(category::all() as $data){
            $categoryArr[$ii]['category_name'] = $data->category_name;
            $categoryArr[$ii]['user_id'] = $data->user_id;
            $categoryArr[$ii]['id'] = $data->id;
            $ii++;
        }
        return view("category")->with("categoryData", $categoryArr);
    }

    function addCategory($categoryId = null){
        if(!$categoryId){
            return view("addCategory");
        }else{
            $userData = category::where("id", $categoryId)->first();
            return view("addCategory")->with("categoryData", $userData);
        }
    }

    function insertCategory(Request $req){
        $req->validate([
            "category" => "required",
        ]);
        $parentId  = $req->session()->get("user_id", null);
        $dupCheck = category::where("category_name", $req->category)->first();
        
        if($dupCheck){
            return Redirect::to("viewCategory")->with("error", "this Category is already present");
        }else{
            if(!$req->categoryId){
                $insertUser = new category();
                $insertUser->category_name = $req->category;
                $insertUser->user_id = $parentId;
                $insertUser->save();
                return Redirect::to("viewCategory")->with("success", "Category inserted successfully");
            }else{
                $user = category::find($req->categoryId);
                $user->category_name = $req->category;
                $user->user_id = $parentId;
                $user->save();
                return Redirect::to("viewCategory")->with("success", "Category updated successfully");
            }
        }
        
    }

    function deleteCategory($categoryId){
        $posts = post::where("category_id", $categoryId)->first();
        if($posts){
            return Redirect::to("viewCategory")->with("error", "Category is associated with posts so can't be deleted");
        }else{
            $category = category::find($categoryId);
            $category->delete();
            return Redirect::to("viewCategory")->with("success", "Category deleted successfully");
        }
        
    }
}
