<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectService
{
    public function getProject($slug) {
        return Project::where('slug', $slug)->first();
    }

    public function getProjects($keyword, $limit) {

        $projects = '';
        if($keyword == '') {
            $projects = Project::orderBy('updated_at', 'desc')->paginate($limit);
        }else{
            $projects = Project::where('title', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('description','LIKE', '%' . $keyword . '%')
                                ->paginate($limit);
        }

        return $projects;

    }

    public function storeProject($input) {
        $newProject = new Project();
        $newProject->title = $input->title;
        $newProject->author = $input->author;
        $newProject->description = $input->description;

        $newProject->slug = $this->checkIfProjectSlugExist($input->title);

        $filepath = $this->storeImage($input->file('image'));

        ($filepath) ? $newProject->image = $filepath : $newProject->image = '';

        return $newProject->save();
    }

    public function checkIfProjectSlugExist($slug) {
        $rawSlug = Str::of($slug)->slug('-');

        $result = Project::where('slug', $rawSlug)->first();

        $newSlug = '';
        if($result) {
            for($i = 1; ;$i++) {
                $newSlug = $rawSlug . $i;

                //if not exist then return new slug
                $check = Project::where('slug', $newSlug)->first();
                if(!$check) {
                    return $newSlug;
                }
            }
        }

        return $rawSlug;
    }

    public function storeImage($image) {
        $filename = now()->format("YMdHis") . "design." . $image->extension();
        $path = $image->storeAs('public/projects', $filename);
        $filepath = '';
        if($path){
            $filepath = "projects/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public function updateProject($project, $input) {
        if($input->title != $project->title) {
            $newSlug = $this->checkIfProjectSlugExist($input->title);
            $project->title = $input->title;
            $project->slug = $newSlug;
        }

        ($input->author != $project->author) ? $project->author = $input->author : '';
        ($input->description != $project->description ) ? $project->description = $input->description : '';

        if($input->hasFile('image')){
            $filepath = $this->storeImage($input->file('image'));
            if($filepath) {
                Storage::delete('public/'. $project->image);
                $project->image = $filepath;
            }
        }

        return $project->save();

    }

    public function checkSameProjectUpdate($project, $input) {
        if($input->title == $project->title &&
            $input->author == $project->author &&
            $input->description == $project->description &&
            $input->hasFile('image') == false
        ) {
            return true;
        }

        return false;
    }

    public function deleteProject(Project $project) {
        Storage::delete('public/'. $project->image);

        return $project->delete();
    }
}
