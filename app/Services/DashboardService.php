<?php

namespace App\Services;

use App\Models\Design;
use App\Models\DesignCategory;
use App\Models\Post;
use App\Models\Project;

class DashboardService
{
    public function countPost() {
        return Post::count();
    }

    public function countStatus($status_id) {
        return Post::where('status_id', $status_id)->count();
    }

    public function getDataYear($status_id){
        $dataYear = [];
        for($i = 11; $i >= 0; $i--) {
            array_push($dataYear, Post::whereMonth('updated_at', date('m') - $i)->where('status_id',$status_id)->count());
        }

        return $dataYear;
    }

    public function getLabelYear() {
        //label
        $monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];

        $labels = [];
        $thisMonth = date('m') + 1 - 1 ;

        for($i = $thisMonth + 1;;) {
            if($i == $thisMonth) {
                array_push($labels, $monthNames[$i - 1]);
                break;
            }else if($i == 13) {
                $i = 1;
                array_push($labels, $monthNames[$i - 1]);
                $i++;
            }else if($i < 13) {
                array_push($labels, $monthNames[$i - 1]);
                $i++;
            }else{
                break;
            }
        }

        return $labels;
    }

    public function getPosts($status, $keyword) {
        if($status == null) {
            return $this->getPostsWithOrderDesc(2);
        }else{
            if($status == 'all'){
                if($keyword == null) {
                    return $this->getPostsWithOrderDesc(2);
                }else{
                    return $this->getPostsWithKeyword($keyword, 2);
                }
            }else{
                if($keyword == null){
                    return $this->getPostsWithStatus($status, 2);
                }else{
                    return $this->getPostsWithStatusAndKeyword($status, $keyword, 2);
                }
            }
        }
    }

    public function getPostsWithOrderDesc($limit) {
        return Post::orderBy('created_at', 'desc')->paginate($limit);
    }

    public function getPostsWithKeyword($keyword, $limit) {
        return Post::where('title', 'LIKE' , '%' . $keyword . '%')
                                ->orWhere('author', 'LIKE' , '%' . $keyword . '%')
                                ->orWhere('created_at', 'LIKE' , '%' . $keyword  . '%')
                                ->orWhere('updated_at', 'LIKE' , '%' . $keyword . '%')
                                ->orWhere('description', 'LIKE' , '%' . $keyword . '%')
                                ->orWhere('post', 'LIKE' , '%' . $keyword . '%')->orderBy('created_at', 'DESC')->paginate($limit);
    }

    public function getPostsWithStatusAndKeyword($status, $keyword, $limit) {
        return Post::where('status_id', $status)
        ->where('title', 'LIKE' , '%' . $keyword . '%')
        ->orWhere('author', 'LIKE' , '%' . $keyword . '%')
        ->orWhere('created_at', 'LIKE' , '%' . $keyword  . '%')
        ->orWhere('updated_at', 'LIKE' , '%' . $keyword . '%')
        ->orWhere('description', 'LIKE' , '%' . $keyword . '%')
        ->orWhere('post', 'LIKE' , '%' . $keyword . '%')->orderBy('created_at', 'DESC')->paginate($limit);
    }

    public function getPostsWithStatus($status, $limit) {
        return Post::where('status_id', $status)->orderBy('created_at', 'DESC')->paginate($limit);
    }

    public function getDesignCategories() {
        return DesignCategory::orderBy('category_name', 'desc')->get();
    }

    public function getDesign($keyword, $offset) {
        if($keyword == null) {
            return Design::orderBy('created_at', 'desc')->paginate($offset);
        }

        return Design::where('title', 'LIKE', '%' . $keyword . '%')->paginate($offset);
    }

    public function getProjects($keyword, $offset) {
        if($keyword == null) {
            return Project::orderBy('created_at', 'desc')->paginate($offset);
        }

        return Project::where('title', 'LIKE', '%' . $keyword . '%')->paginate($offset);
    }
}
