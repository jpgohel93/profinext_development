<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogAdminServices;
use Illuminate\Support\Facades\Redirect;
use App\Models\blogTabs;

class BlogController extends Controller
{
    public function __construct(){
        $this->middleware('permission:blog-admin-read', ['only' => ["blogAdmin"]]);
    }
    public function blogAdmin(Request $request){
        $blogs = BlogAdminServices::index();
        $tabs = blogTabs::get();
        $bloggers = BlogAdminServices::getAllBloggers();

        return view("blogAdmin.index",compact("blogs","tabs","bloggers"));
    }
    public function getBlogByUser(){
        $user = BlogAdminServices::getBlogByUser();
        $all_tabs = blogTabs::get()->toArray();
        return view("blogUser.index",compact("user","all_tabs"));
    }
    public function addBlogFrm(Request $request){
        $blog = BlogAdminServices::addBlog($request);
        if($blog) return Redirect::route("blogUser")->with("info","New Blog Added!");
        return Redirect::route("blogUser")->with("info","Unable to Add Blog!");
    }
    public function addTab(Request $request){
        BlogAdminServices::addTab($request);
        if($request->blogger) return Redirect::route("blogAdmin")->with("info", "New Tab Added and assing to blogger!");
        return Redirect::route("blogAdmin")->with("info","New Tab Added!");
    }
    public function setTargetFrm(Request $request){
        $blogData = BlogAdminServices::getBlogByTabId($request->tab_id,$request->user_id);
        if(empty( $blogData)){
            // set target
            BlogAdminServices::setTarget($request);
            return Redirect::route("blogAdmin")->with("info","New Target Assign!");
        }else{
            BlogAdminServices::setTarget($request,"update");
            return Redirect::route("blogAdmin")->with("info","Tab target updated");
        }

    }
    public function editBlogForm(Request $request,$id){
        $user = BlogAdminServices::editBlogForm($id);
        $all_tabs = blogTabs::get()->toArray();
        return view("blogAdmin.view-blog",compact("user","all_tabs"));
    }
    public function approveBlog($id){
        BlogAdminServices::approveBlog($id);
        return Redirect::route("blogAdmin")->with("info","Blog Approved");
    }
    public function addNoteFrm(Request $request){
        BlogAdminServices::addNoteFrm($request);
        return Redirect::route("blogAdmin")->with("info","Notes Added to Blog");
    }
    public function getNotes(Request $request){
        $id = $request->id;
        $notes = BlogAdminServices::getNoteFrm($id);
        return response($notes,200,["ContentType"=>"Application/json"]);
    }
    public function editBlog($id){
        $blog = BlogAdminServices::editBlog($id)->toArray();
        $all_tabs = blogTabs::get()->toArray();
        return view("blogUser.edit-blog",compact("blog","all_tabs"));
    }
    public function updateBlogFrm(Request $request){
        BlogAdminServices::updateBlog($request);
        return Redirect::route("blogUser")->with("info","Blog Updated");
    }
}
