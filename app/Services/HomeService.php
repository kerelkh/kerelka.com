<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;

class HomeService
{
    public static function getNewestPost()
    {
        return Post::with(['getCategory'])->where('status_id', 2)->orderBy('updated_at', 'desc')->first();
    }

    public static function getRecentPosts()
    {
        return Post::orderBy('created_at', 'desc')->limit(4)->get();
    }

    public static function getPopularPosts()
    {
        return Post::where('status_id', 2)->orderBy('view', 'DESC')->limit(4)->get();
    }

    public static function getRandomPosts()
    {
        return Post::where('status_id', 2)->inRandomOrder()->limit(5)->get();
    }

    public static function getPostsWithKeyword($keyword)
    {
        if($keyword == '') {
            $posts = Post::where('status_id', 2)->orderBy('updated_at', 'desc')->paginate(6);
        }else{
            $posts = Post::where('status_id', 2)
                            ->where(function($query) use ($keyword) {
                                return $query->where('title', 'LIKE' , '%' . $keyword . '%')
                                                ->orWhere('author', 'LIKE', '%' . $keyword . '%')
                                                ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                                                ->orWhere('updated_at', 'LIKE', '%' . $keyword . '%');
                            })->orderBy('updated_at', 'desc')->paginate(6);
        }

        return $posts;
    }

    public static function getPostsWithoutKeyword()
    {
        return Post::where('status_id', 2)->orderBy('updated_at', 'desc')->paginate(6);
    }
}
