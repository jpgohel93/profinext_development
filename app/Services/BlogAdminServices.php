<?php

namespace App\Services;
use App\Models\Blog;
use App\Models\User;
use App\Models\blogTabs;
use App\Models\blogTarget;
use App\Services\LogServices;
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
        $data = Blog::where("id",$id)->first();
        $dt = ["is_approve"=>1];
        $status = Blog::where("id",$id)->update($dt);
        if($status){
            LogServices::logEvent(["desc"=>"Blog $id updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to Update Blog $id by $user_name","data"=>$dt]);
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
            LogServices::logEvent(["desc"=>"Unable to create Blog Tab by $user_name","data"=>$tab]);
        }
        if($request->blogger!=""){
            $request->validate([
                "blogger"=>"exists:users,id"
            ]);
            $tg=[
                "user_id" => $request->blogger,
                "tab_id"=>$tab_id->id,
                "target"=>0
            ];
            $target = blogTarget::create($tg);
            if($target){
                LogServices::logEvent(["desc"=>"Blogger $request->blogger target updated by $user_name"]);
            }else{
                LogServices::logEvent(["desc"=>"Unable to update Blogger $request->blogger target by $user_name","data"=>$target]);
            }
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
            LogServices::logEvent(["desc"=>"Blogger $request->user_id target updated by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update target for Tab $request->tab_id and User ID $request->user_id by $user_name","data"=>$user]);
        }
        return $id;
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
            LogServices::logEvent(["desc"=>"Blog $id->id Created by $user_name"]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to create Blog by $user_name","data"=>$blog]);
        }
        return $id;
    }
    public static function addNoteFrm($request){
        $user_name = auth()->user()->name;
        $request->validate([
            "notes"=>"required",
            "blog_id"=>"required|exists:blogs,id"
        ]);
        $data = Blog::where("id", $request->blog_id)->first();
        $dt = ["notes"=>$request->notes,"is_approve"=>0];
        $status = Blog::where("id", $request->blog_id)->update($dt);
        if($status){
            LogServices::logEvent(["desc"=>"Note added for blog $request->blog_id by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to Add Notes for blog $request->blog_id by $user_name","data"=>$dt]);
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
        $data = Blog::where("id", $blog_id)->first();
        $dt = [
            "tab_id"=>$request->tab_id,
            "title"=>$request->title,
            "date"=>$request->date,
            "link"=>$request->link,
            "notes"=>null
        ];
        $id = Blog::where("id", $blog_id)->update($dt);
        if($id){
            LogServices::logEvent(["desc"=>"Blog $blog_id Updated by $user_name","data"=>$data]);
        }else{
            LogServices::logEvent(["desc"=>"Unable to update Blog $blog_id by $user_name","data"=>$dt]);
        }
        return $id;
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
