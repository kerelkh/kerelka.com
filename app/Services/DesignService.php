<?php

namespace App\Services;

use App\Models\Design;
use Illuminate\Support\Str;
use App\Models\DesignCategory;
use Illuminate\Support\Facades\Storage;

class DesignService
{
    public static function getDesigns($keyword, $category)
    {
        $designs = [];
        if($category == null || $category == '') {
            if($keyword != null || $keyword != ''){
                $designs = Design::where('title', 'LIKE' ,'%' . $keyword . '%')->orderBy('updated_at', 'desc')->paginate(12);
            }else{
                $designs = Design::orderBy('updated_at', 'desc')->paginate(12);
            }
        }else{

            //get id category
            $category_id = DesignCategory::where('category_name', $category)->first();
            if(!$category_id){
                $designs = Design::where('design_category_id', null)->paginate(12);
                return $designs;
            }
            if($keyword !== null || $keyword != ''){
                $designs = Design::where('title', 'LIKE' ,'%' . $keyword . '%')
                                    ->where('design_category_id', $category_id->id)
                                    ->paginate(12);
            }else{
                $designs = Design::where('design_category_id', $category_id->id)->paginate(12);
            }
        }

        return $designs;
    }

    public static function getCategories()
    {
        return DesignCategory::orderBy('updated_at', 'desc')->get();
    }

    public static function getDesign($slug)
    {
        return Design::where('slug', $slug)->first();
    }

    public function setDesign($design)
    {
        $newDesign = new Design;
        $newDesign->title = $design->title;
        $newDesign->author = $design->author;
        $newDesign->description = $design->description;
        $newDesign->design_category_id = $design->category;

        $newDesign->slug = $this->checkIfDesignSlugExist($design->title);

        $filepath = $this->storeImage($design->file('image'));

        ($filepath) ? $newDesign->image = $filepath : $newDesign->image = '';

        $result = $newDesign->save();

        return $result;
    }

    public function checkIfDesignSlugExist($slug) {
        $rawSlug = Str::of($slug)->slug('-');

        $result = Design::where('slug', $rawSlug)->first();

        $newSlug = '';
        if($result) {
            for($i = 1; ;$i++) {
                $newSlug = $rawSlug . $i;

                //if not exist then return new slug
                $check = Design::where('slug', $newSlug)->first();
                if(!$check) {
                    return $newSlug;
                }
            }
        }

        return $rawSlug;
    }

    public function storeImage($image) {

        $filename = now()->format("YMdHis") . "design." . $image->extension();
        $path = $image->storeAs('public/designs', $filename);
        $filepath = '';
        if($path){
            $filepath = "designs/" . $filename;

            return $filepath;
        }

        return 0;
    }

    public function updateDesign($design, $input)
    {
        if($input->title != $design->title) {
            $newSlug = $this->checkifdesignslugexist($input->title);
            $design->title = $input->title;
            $design->slug = $newSlug;
        }

        ($input->author != $design->author) ? $design->author = $input->author : '';
        ($input->description != $design->description ) ? $design->description = $input->description : '';
        ($input->category != $design->design_category_id) ? $design->design_category_id = $input->category : '';

        if($input->hasFile('image')){
            $filepath = $this->storeImage($input->file('image'));
            if($filepath) {
                Storage::delete('public/'. $design->image);
                $design->image = $filepath;
            }
        }

        return $design->save();
    }

    public function checkSameUpdateDesign($design, $input)
    {
        if($input->title == $design->title &&
        $input->author == $design->author &&
        $input->description == $design->description &&
        $input->category == $design->design_category_id &&
        $input->hasFile('image') == false)
        {
            return true;
        }

        return false;
    }

    public function deleteDesign(Design $design)
    {
        Storage::delete('public/'. $design->image);
        return $design->delete();
    }

    public function setCategory($category_name)
    {
        return DesignCategory::create([
            'category_name' => $category_name
        ]);
    }

    public function deleteCategory($category)
    {
        return DesignCategory::where('category_name', $category)->delete();
    }
}
