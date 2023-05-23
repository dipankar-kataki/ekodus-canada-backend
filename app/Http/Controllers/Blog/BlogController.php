<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function viewBlog($id = null){
        if($id != null){

        }else{
            return view('content.blog.index');
        }
    }
}
