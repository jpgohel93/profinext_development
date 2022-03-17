<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogAdminServices;
use Illuminate\Support\Facades\Redirect;
use App\Models\blogTabs;
use App\Models\Blog;
class BlogController extends Controller
{
    public function blogAdmin(Request $request){
        $blogs = BlogAdminServices::index();
        $tabs = blogTabs::get();
        return view("blogAdmin.index",compact("blogs","tabs"));
    }
    public function getBlogByUser(){
        $blogs = BlogAdminServices::getBlogByUser();
        $tabs = blogTabs::get();
        return view("blogUser.index",compact("blogs","tabs"));
    }
    public function addBlogFrm(Request $request){
        $blog = BlogAdminServices::addBlog($request);
        if($blog) return Redirect::route("blogUser")->with("info","New Blog Added!");
        return Redirect::route("blogUser")->with("info","Unable to Add Blog!");
    }
    public function addTab(Request $request){
        BlogAdminServices::addTab($request);
        return Redirect::route("blogAdmin")->with("info","New Tab Added!");
    }
    public function setTargetFrm(Request $request){
        BlogAdminServices::setTarget($request);
        return Redirect::route("blogAdmin")->with("info","New Target Assign!");
    }
}
