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
        $user = Auth::user()->toArray();
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
        // $user['blogs'] = Blog::where("blogger",$user['id'])->with(["withBlogger"])->get()->toArray();
        return $user;
        // return Blog::where("blogger",$user['id'])->with(["withBlogger"])->get();
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
        // $user['blogs'] = Blog::where("blogger",$user['id'])->with(["withBlogger"])->get()->toArray();
        return $user;
    }
    public static function approveBlog($id){
        return Blog::where("id",$id)->update(["is_approve"=>1]);
    }
    public static function addTab($request){
        $tab = $request->validate([
            "name"=>"required"
        ],[
            "name.required"=>"Tab name is required"
        ]);
        $tab['created_by']=auth()->user()->id;
        $tab_id = blogTabs::create($tab);
        if($request->blogger!=""){
            $request->validate([
                "blogger"=>"exists:users,id"
            ]);
            
        }
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
    public static function addNoteFrm($request){
        $request->validate([
            "notes"=>"required",
            "blog_id"=>"required|exists:blogs,id"
        ]);
        return Blog::where("id", $request->blog_id)->update(["notes"=>$request->notes,"is_approve"=>0]);
    }
    public static function getNoteFrm($id){
        return Blog::where("id", $id)->first("notes");
    }
    public static function editBlog($id){
        return Blog::where("id", $id)->first();
    }
    public static function updateBlog($request){
        $blog = $request->validate([
            "blog_id"=> "required|exists:blogs,id",
            "tab_id"=>"required|exists:blog_tabs,id",
            "link"=>"required",
            "title"=>"required",
            "date"=>"required"
        ]);
        return Blog::where("id", $blog['blog_id'])->update([
            "tab_id"=>$request->tab_id,
            "title"=>$request->title,
            "date"=>$request->date,
            "link"=>$request->link,
            "notes"=>null
        ]);
    }
    public static function getAllBloggers(){
        $users = User::get();
        $userIdArray = [];
        foreach ($users as $userData) {
            $permission = json_decode($userData->permission, true);
            if (!empty($permission)) {
                if (
                    in_array("blog-read", $permission) ||
                    in_array("blog-write", $permission) ||
                    in_array("blog-create", $permission) ||
                    in_array("blog-delete", $permission)
                ) {
                    $userIdArray[] = $userData->id;
                }
            }
        }
        return User::wherein('id', $userIdArray)->get()->toArray();
    }
}
