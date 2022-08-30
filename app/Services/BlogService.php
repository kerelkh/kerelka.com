<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogService
{
    public static function getPosts($keyword, $category)
    {
        if($category == '') {
            if($keyword == '') {
                $posts = Post::where('status_id', 2)->orderBy('updated_at', 'desc')->paginate(15);
            }else{
                $posts = Post::where('status_id', 2)
                                ->where(function($query) use($keyword) {
                                    return $query->where('title', 'LIKE', '%' . $keyword . '%')
                                                    ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                                })->orderBy('updated_at', 'desc')->paginate(15);
            }
        }else{
            $category_id = Category::where('category_name', $category)->first()->id;
            if($keyword != '') {
                $posts = Post::where('category_id', $category_id)
                                ->Where('status_id', 2)
                                ->where(function($query) use($keyword) {
                                    return $query->where('title', 'LIKE', '%' . $keyword . '%')
                                                ->orWhere('description', 'LIKE', '%' . $keyword . '%');
                                })->orderBy('updated_at', 'desc')->paginate(15);
            }else{
                $posts = Post::where('status_id', 2)
                                ->where('category_id', $category_id)->orderBy('updated_at', 'desc')->paginate(15);
            }
        }

        return $posts;
    }

    public static function getCategoriesPost()
    {
        return Category::all();
    }

    public static function getRandomPosts($limit)
    {
        return Post::where('status_id', 2)->inRandomOrder()->limit($limit)->get();
    }

    public function updateViewPost($post) {
        $post->view += 1;
        $post->timestamps = false;
        $post->save();
    }

    public function getPost($limit) {
        return Post::limit($limit)->orderBy('updated_at', 'desc')->get();
    }

    public function storePost($input) {
        $newPost = new Post();
        $newPost->title = $input->title;
        $newPost->author = $input->author;
        $newPost->description = $input->description;
        $newPost->post = $input->post;
        $newPost->category_id = 1;
        $newPost->status_id = 1;

        //slug
        $newPost->slug = $this->checkIfPostSlugExist($input->title);

        //thumbnail store
        $filepath = $this->storeThumbnail($input->file('thumbnail'));

        ($filepath) ? $newPost->thumbnail = $filepath : $newPost->thumbnail = '';

        return $newPost->save();

    }

    public function checkIfPostSlugExist($slug) {
        $rawSlug = Str::of($slug)->slug('-');

        $result = Post::where('slug', $rawSlug)->first();

        $newSlug = '';
        if($result) {
            for($i = 1; ;$i++) {
                $newSlug = $rawSlug . $i;

                //if not exist then return new slug
                $check = Post::where('slug', $newSlug)->first();
                if(!$check) {
                    return $newSlug;
                }
            }
        }

        return $rawSlug;
    }

    public function storeThumbnail($thumbnail) {
        $filename = now()->format("YMdHis") . "thumbnail." . $thumbnail->extension();
        $path = $thumbnail->storeAs('public/thumbnails', $filename);
        $filepath = '';
        if($path){
            $filepath = "thumbnails/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public function checkSamePostUpdate(Post $post, $input) {
        if($input->title == $post->title &&
            $input->author == $post->author &&
            $input->description == $post->description &&
            $input->status == $post->status_id &&
            $input->category == $post->category_id &&
            $input->thumbnail == '' &&
            $input->post == $post->post) {
                return true;
        }
        return false;
    }

    public function updatePost(Post $post, $input) {
        if(!($input->title == $post->title)) {
            $post->title = $input->title;
            $post->slug = $this->checkIfPostSlugExist($input->title);
        }

        if(!($input->author == $post->author)) {
            $post->author = $input->author;
        }

        if(!($input->description == $post->description)) {
            $post->description = $input->description;
        }

        if(!($input->status == $post->status_id)) {
            $post->status_id = $input->status;
        }

        if(!($input->category == $post->category_id)) {
            $post->category_id = $input->category;
        }

        if($input->hasFile('thumbnail')){

            //if post already have thumbnail then delete thumbnail
            if($post->thumbnail) {
                Storage::delete('public/' . $post->thumbnail);
            }

            //save new thumbnail
            $filepath = $this->storeThumbnail($input->file('thumbnail'));
            $post->thumbnail = $filepath;

        }

        if(!($input->post == $post->post)) {
            $post->post = $input->post;
        }

        return $post->save();
    }

    public function deletePost(Post $post) {
        if($post->thumbnail) {
            Storage::delete('public/'. $post->thumbnail);
        }
        return $post->delete();
    }
}
