<?php

namespace App\Services;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\blogTabs;
use App\Models\blogTarget;
use App\Models\blogHasTabs;
class BlogAdminServices{
    function __construct(){

    }
    public static function index(){
        //$users = User::role('blogUser')->get()->toArray();
        // $blogs = Blog::with(["withBlogger"])->get()->toArray();

        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData){
            $permission = json_decode($userData->permission,true);
            if(!empty($permission)) {
                if (in_array("blog-read", $permission) ||
                    in_array("blog-write", $permission) ||
                    in_array("blog-create", $permission) ||
                    in_array("blog-delete", $permission)) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        $users = User::wherein('id',$userIdArray)->get();

        foreach($users as $user_index => $user){
            $tg = blogTarget::where(["user_id"=>$user['id']])->get(["tab_id","target"])->toArray();
            $users[$user_index]['target'] = $tg;
            foreach($tg as $tab_index => $tab_id){
                // total post in this tab
                $achivement = Blog::where(["blogger"=>$user['id'],"tab_id"=>$tab_id['tab_id']])->count();
                $users[$user_index]['target'][$tab_index]['total_blogs'] = $achivement;
            }
        }
        return $users;
    }
    public static function getBlogByUser(){
        $id = Auth::user()->id;
        return Blog::where("blogger",$id)->with(["withBlogger"])->get();
    }
    public static function addTab($request){
        $tab = $request->validate([
            "name"=>"required"
        ]);
        $tab['created_by']=auth()->user()->id;
        return blogTabs::create($tab);
    }
    public static function setTarget($request){
        $user = $request->validate([
            "target"=>"required|numeric",
            "user_id"=>"exists:users,id|required",
            "tab_id"=>"exists:blog_tabs,id|required"
        ]);
        // if tab exists update target
        return blogTarget::create($user);
    }
    public static function addBlog($request){
        $blog = $request->validate([
            "tab_id"=>"required|exists:blog_tabs,id",
            "date"=>"required|date",
            "title"=>"required",
            "link"=>"required"
        ]);
        // srno
        $last = blog::latest()->first("srno")->toArray();
        if(isset($last['srno'])){
            $last_sr = sprintf("%04d", (Int)$last['srno']+1);
        }else{
            $last_sr = sprintf("%04d", 1);
        }
        $blog['srno']=$last_sr;
        $blog['blogger']=auth()->user()->id;
        return Blog::create($blog);
    }
}
