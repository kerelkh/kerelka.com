<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\PostRequest;
use App\Http\Requests\EditPostRequest;

use App\Models\Post;
use App\Models\StatusPost;
use App\Models\Category;
use App\Services\BlogService;

class PostController extends Controller
{
    private BlogService $BlogService;

    public function __construct() {
        $this->BlogService = new BlogService();
    }

    public function showPost(String $slug) {
        $post = Post::where('slug', $slug)->first();

        if(!$post) {
            return redirect('/blogs');
        }

        if($post->status_id == 1 || $post->status_id == 3) {
            if(!Auth::user()){
                return redirect('/');
            }
        }
        $this->BlogService->updateViewPost($post);
        $posts = $this->BlogService->getPost(6);
        return view('showpost', compact(['post', 'posts']));
    }

    public function storePost(PostRequest $request) {
        $result = $this->BlogService->storePost($request);
        if($result) {
            return redirect()->route('admin.blog')->with('message', 'Upload Success');
        }
        return back()->with('error', 'Failed to upload post');
    }

    public function editPost(Post $post) {
        $status = StatusPost::all();
        $categories = Category::all();
        $page = 'Blog';
        return view('admin.editpost', compact(['page', 'post', 'status', 'categories']));
    }

    public function storeEdit(EditPostRequest $request, Post $post) {
        if($this->BlogService->checkSamePostUpdate($post, $request)){
            return back()->with("error", 'No update, same data');
        }
        $result = $this->BlogService->updatePost($post, $request);
        if(!$result) {
            return back()->with('error', 'Data failed to save');
        }
        return redirect('/admin/blog')->with('message', 'Data has been updated');
    }

    public function delete(Post $post) {
        $result = $this->BlogService->deletePost($post);
        if($result) {
            return redirect('admin/blog')->with('message', 'Data has been delete');
        }
        return back()->with('error', 'Data failed to delete');
    }

}
