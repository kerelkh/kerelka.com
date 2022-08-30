<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DesignCategoryRequest;
use App\Http\Requests\EditDesignRequest;
use App\Http\Requests\DesignRequest;
use App\Models\Design;
use App\Services\DesignService;

class DesignController extends Controller
{

    private $DesignService;

    public function __construct()
    {
        $this->DesignService = new DesignService();
    }

    public function index(Request $request) {

        $title = 'Design';
        ($request->query('keyword') != null) ? $keyword = $request->query('keyword') : $keyword = "";
        ($request->query('category') != null) ? $category = $request->query('category') : $category = '';
        $designs = DesignService::getDesigns($keyword, $category);
        $designCategories = DesignService::getCategories();
        return view('design', compact(['title', 'designs', 'designCategories', 'keyword', 'category']));
    }

    public function showDesign(Request $request, String $slug) {

        $design = DesignService::getDesign($slug);
        if(!$design){
            return redirect('/designs');
        }
        return view('showdesign', compact(['design']));
    }

    public function storeDesign(DesignRequest $request) {

        $result = $this->DesignService->setDesign($request);
        if($result) {
            return redirect()->route('admin.design')->with('message', 'Succesfull upload design');
        }
        return back()->with('error', 'Failed to upload design');
    }

    public function showEdit(Design $design) {
        $categories = DesignService::getCategories();
        return view('admin.editdesign', [
            'page' => 'Design',
            'design' => $design,
            'categories' => $categories
        ]);
    }

    public function update(EditDesignRequest $request, Design $design) {
        if($this->DesignService->checkSameUpdateDesign($design, $request)) {
            return back()->with('error', 'Failed to update (Nothing Change)');
        }
        $result = $this->DesignService->updateDesign($design, $request);
        if($result) {
            return redirect('/admin/design')->with('message', 'Data has been updated');
        }
        return back()->with('error', 'Failed to update');
    }

    public function delete(Design $design) {
        $result = $this->DesignService->deleteDesign($design);
        if($result) {
            return redirect('admin/design')->with('message', 'Design has been deleted');
        }
        return redirect('admin/design')->with('error', 'Failed deleting design');
    }

    public function storeCategory(DesignCategoryRequest $request) {
        $result = $this->DesignService->setCategory($request->category_name);
        if($result) {
            return redirect()->route('admin.design')->with('message', 'Successful adding new category '. $request->category_name);
        }
        return back()->with('error', 'Failed to adding new category');
    }

    public function deleteCategory($category) {
        $result = $this->DesignService->deleteCategory($category);
        if($result) {
            return redirect()->route('admin.design')->with('message', 'Successful deleting category');
        }
        return back()->with('error', 'Failed to delete category');
    }
}
