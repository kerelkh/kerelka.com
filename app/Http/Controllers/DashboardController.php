<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Post;
use App\Models\StatusPost;
use App\Models\DesignCategory;
use App\Models\Design;
use App\Models\Project;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $DashboardService;

    public function __construct() {
        $this->DashboardService = new DashboardService();
    }

    public function index(Request $request) {

        $page = 'Dashboard';

        //count dashboard
        $sumposts = $this->DashboardService->countPost();
        $sumdraft = $this->DashboardService->countStatus(1);
        $sumpublish = $this->DashboardService->countStatus(2);
        $sumdeleted = $this->DashboardService->countStatus(3);

        //get daya one year
        $dataDraftYear = $this->DashboardService->getDataYear(1);
        $dataPublishedYear = $this->DashboardService->getDataYear(2);
        $dataDeletedYear = $this->DashboardService->getDataYear(3);

        //labels one year
        $dataLabelYear = $this->DashboardService->getLabelYear();

        return view('admin.dashboard',compact([
            'page',
            'sumposts',
            'sumdraft',
            'sumpublish',
            'sumdeleted',
            'dataLabelYear',
            'dataDraftYear',
            'dataPublishedYear',
            'dataDeletedYear',
        ]));
    }

    public function blog(Request $request) {

        $posts = $this->DashboardService->getPosts($request->query('status') ?? null, $request->query('keyword') ?? null);
        $statuses = StatusPost::all();
        return view('admin.blog', [
            'page' => "Blog",
            'posts' => $posts,
            'statuses' => $statuses,
            'selectedStatus' => $request->query('status') ?? 'all',
            'keyword' => $request->query('keyword') ?? ''
        ]);
    }

    public function design(Request $request) {
        //list category
        $categories = $this->DashboardService->getDesignCategories();
        $designs = $this->DashboardService->getDesign($request->query('keyword') ?? null, 5);

        return view('admin.design', [
            'page' => 'Design',
            'categories' => $categories,
            'designs' => $designs
        ]);
    }

    public function project(Request $request) {
        $projects = $this->DashboardService->getProjects($request->query('keyword') ?? null, 5);
        return view('admin.project', [
            'page' => 'Project',
            'projects' => $projects
        ]);
    }

    public function setting(Request $request) {

        //data banners
        $banners = Banner::orderBy('created_at', 'DESC')->get();

        return view('admin.setting', [
            'page' => "Web Setting",
            'banners' => $banners,
        ]);
    }
}
