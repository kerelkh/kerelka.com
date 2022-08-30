<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlogService;

class BlogController extends Controller
{
    public function index(Request $request) {
        $page = 'Blogs';

        $keyword = $request->query('keyword') ?? '';
        $category_keyword = $request->query('category') ?? '';

        $posts = BlogService::getPosts($keyword, $category_keyword);

        $categories = BlogService::getCategoriesPost();

        $randomPosts = BlogService::getRandomPosts(5);

        return view('blog', compact(['page', 'posts', 'categories', 'keyword', 'category_keyword', 'randomPosts']));
    }
}
