<?php

namespace App\Services;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\blogTabs;
use App\Models\blogTarget;
class BlogAdminServices{
    public static function index(){
        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData){
            $permission = json_decode($userData->permission,true);
            if(!empty($permission)) {
                if (in_array("blog-user-read", $permission) ||
                    in_array("blog-user-write", $permission) ||
                    in_array("blog-user-create", $permission) ||
                    in_array("blog-user-delete", $permission)) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        $users = User::wherein('id',$userIdArray)->get()->toArray();

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
        $user = User::where("id",auth()->user()->id)->first()->toArray();
        $tg = blogTarget::where(["user_id"=>$user['id']])->get(["tab_id","target"])->toArray();
        $user['target'] = $tg;
        foreach($tg as $tab_index => $tab_id){
            // total post in this tab
            $achivement = Blog::where(["blogger"=>$user['id'],"tab_id"=>$tab_id['tab_id']])->count();
            // tab name
            $user['target'][$tab_index]['tab_name'] = blogTabs::where("id",$tab_id['tab_id'])->pluck("name")->first();
            $user['target'][$tab_index]['total_blogs'] = $achivement;
            $user['target'][$tab_index]['tab_blogs'][$tab_id['tab_id']] = Blog::where(["blogger"=>$user['id'],"tab_id"=>$tab_id['tab_id']])->with(["withBlogger"])->get()->toArray();
        }
        return $user;
    }
    public static function editBlogForm($id){
        $user = User::where("id",$id)->first()->toArray();
        $tg = blogTarget::where(["user_id"=>$user['id']])->get(["tab_id","target"])->toArray();
        $user['target'] = $tg;
        foreach($tg as $tab_index => $tab_id){
            // total post in this tab
            $achivement = Blog::where(["blogger"=>$user['id'],"tab_id"=>$tab_id['tab_id']])->count();
            $user['target'][$tab_index]['total_blogs'] = $achivement;
            $user['target'][$tab_index]['tab_name'] = blogTabs::where("id", $tab_id['tab_id'])->pluck("name")->first();
            $user['target'][$tab_index]['tab_blogs'][$tab_id['tab_id']] = Blog::where(["blogger"=>$user['id'],"tab_id"=>$tab_id['tab_id']])->with(["withBlogger"])->get()->toArray();
        }
        return $user;
    }
    public static function approveBlog($id){
        $user_name = auth()->user()->name;
        $id = Blog::where("id",$id)->update(["is_approve"=>1]);
        if($id){
            LogServices::logEvent(["desc"=>"Blog $id Approved by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to Approved Blog $id by $user_name"]);
        }
    }
    public static function addTab($request){
        $tab = $request->validate([
            "name"=>"required"
        ],[
            "name.required"=>"Tab name is required"
        ]);
        $tab['created_by']=auth()->user()->id;
        $user_name = auth()->user()->name;
        $tab_id = blogTabs::create($tab);
        if($tab_id){
            LogServices::logEvent(["desc"=>"Blog Tab $tab_id->id Created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Blog Tab by $user_name"]);
        }
        if($request->blogger!=""){
            $request->validate([
                "blogger"=>"exists:users,id"
            ]);
            $target=[
                "user_id" => $request->blogger,
                "tab_id"=>$tab_id->id,
                "target"=>0
            ];
            blogTarget::create($target);
        }
        return $tab_id;
    }
    public static function setTarget($request){
        $user_name = auth()->user()->name;
        $user = $request->validate([
            "target"=>"required|numeric",
            "user_id"=>"exists:users,id|required",
            "tab_id"=>"exists:blog_tabs,id|required"
        ]);
        $id = blogTarget::create($user);
        if($id){
            return LogServices::logEvent(["desc"=>"Tab $request->tab_id for User ID $request->user_id traget $request->target Assign by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to assign target for Tab $request->tab_id and User ID $request->user_id by $user_name"]);
        }
    }
    public static function addBlog($request){
        $user_name = auth()->user()->name;
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
        $id = Blog::create($blog);
        if($id){
            return LogServices::logEvent(["desc"=>"new Blog $id->id Created by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to create new Blog by $user_name"]);
        }
    }
    public static function addNoteFrm($request){
        $user_name = auth()->user()->name;
        $request->validate([
            "notes"=>"required",
            "blog_id"=>"required|exists:blogs,id"
        ]);
        $status = Blog::where("id", $request->blog_id)->update(["notes"=>$request->notes,"is_approve"=>0]);
        if($status){
            return LogServices::logEvent(["desc"=>"Note added for blog $request->blog_id by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to Add Notes for blog $request->blog_id by $user_name"]);
        }
    }
    public static function getNoteFrm($id){
        return Blog::where("id", $id)->first("notes");
    }
    public static function editBlog($id){
        return Blog::where("id", $id)->first();
    }
    public static function updateBlog($request){
        $user_name = auth()->user()->name;
        $request->validate([
            "blog_id"=> "required|exists:blogs,id",
            "tab_id"=>"required|exists:blog_tabs,id",
            "link"=>"required",
            "title"=>"required",
            "date"=>"required"
        ]);
        $blog_id = $request['blog_id'];
        $id = Blog::where("id", $blog_id)->update([
            "tab_id"=>$request->tab_id,
            "title"=>$request->title,
            "date"=>$request->date,
            "link"=>$request->link,
            "notes"=>null
        ]);
        if($id){
            return LogServices::logEvent(["desc"=>"Blog $blog_id Updated by $user_name"]);
        }else{
            return LogServices::logEvent(["desc"=>"Unable to update Blog $blog_id by $user_name"]);
        }
    }
    public static function getAllBloggers(){
        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData) {
            $permission = json_decode($userData->permission, true);
            if (!empty($permission)) {
                if (
                    in_array("blog-user-read", $permission) ||
                    in_array("blog-user-write", $permission) ||
                    in_array("blog-user-create", $permission) ||
                    in_array("blog-user-delete", $permission)
                ) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        return User::wherein('id', $userIdArray)->get()->toArray();
    }
    public static function getBlogByTabId($tab_id,$user_id){
        return blogTarget::where("tab_id", $tab_id)->where("user_id", $user_id)->first()->toArray();
    }
}
