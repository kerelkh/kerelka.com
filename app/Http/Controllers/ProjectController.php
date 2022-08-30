<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

use App\Http\Requests\EditProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectService $ProjectService;

    public function __construct(){
        $this->ProjectService = new ProjectService();
    }

    public function index(Request $request) {
        $title = 'Projects';
        $projects = $this->ProjectService->getProjects($request->query('keyword') ?? '', 12);
        return view('project', [
            'page' => $title,
            'keyword' => $request->keyword ?? '',
            'projects' => $projects ?? null
        ]);
    }

    public function storeProject(ProjectRequest $request) {
        $result = $this->ProjectService->storeProject($request->input);
        if($result) {
            return redirect()->route('admin.project')->with('message', 'Success adding new project');
        }
        return back()->with('error', 'Failed to upload new project');
    }

    public function showProject(Request $request, String $slug) {
        $project = $this->ProjectService->getProject($slug);
        if(!$project){
            return redirect('/projects');
        }
        return view('showproject', compact(['project']));
    }

    public function showEdit(Project $project) {
        return view('admin.editproject', [
            'page' => 'Project',
            'project' => $project,
        ]);
    }

    public function update(EditProjectRequest $request, Project $project) {

        //check if everything is same
        if($this->ProjectService->checkSameProjectUpdate($project, $request->input)) {
            return back()->with('error', 'Failed to update (Nothing Change)');
        }
        $result = $this->ProjectService->updateProject($project, $request->input);
        if($result) {
            return redirect('/admin/project')->with('message', 'Data has been updated');
        }
        return back()->with('error', 'Failed to update');
    }

    public function delete(Project $project) {
        $result = $this->ProjectService->deleteProject($project);
        if($result) {
            return redirect('admin/project')->with('message', 'project has been deleted');
        }
        return redirect('admin/project')->with('error', 'Failed deleting project');
    }
}
