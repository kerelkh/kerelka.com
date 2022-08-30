<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Notice;
use App\Services\BlogService;
use App\Services\HomeService;

class HomeController extends Controller
{
    public function index(Request $request) {

        $newestPost = HomeService::getNewestPost();
        $categories = BlogService::getCategoriesPost();
        $recentPosts = HomeService::getRecentPosts();
        $mostViewPosts = HomeService::getPopularPosts();
        $randomPosts = BlogService::getRandomPosts(5);

        $keyword = '';

        if($request->query('keyword')){
            $keyword = $request->query('keyword');
            $posts = HomeService::getPostsWithKeyword($keyword);
        }else{
            $posts = HomeService::getPostsWithoutKeyword();
        }

        return view('home', compact(['newestPost', 'categories', 'posts', 'keyword', 'mostViewPosts', 'randomPosts', 'recentPosts']));

    }
}
