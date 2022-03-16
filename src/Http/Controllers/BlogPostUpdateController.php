<?php

namespace Fraidoon\Blog\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogPostUpdateController extends Controller
{
    public function index(){
        return view('blog::post_update');
    }
}
