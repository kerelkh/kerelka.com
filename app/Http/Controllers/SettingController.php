<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use App\Models\Notice;
use App\Services\SettingService;

use function PHPUnit\Framework\throwException;

class SettingController extends Controller
{
    private SettingService $SettingService;

    public function __construct() {
        $this->SettingService = new SettingService();
    }

    public function uploadBanner(Request $request) {

        if($request->hasFile('banner')){
            $storeFileBanner = $this->SettingService->setFileBanner($request->file('banner'));

            if($storeFileBanner['path']){
                $bannerPath = "images/" . $storeFileBanner['filename'];
                $result = $this->SettingService->createBanner($storeFileBanner['filename'], $bannerPath);
                if($result){
                    return response()->json(["message" => "success"]);
                }
                return response()->json(500);
            }
            return response()->json(500);
        }
        return response()->json(500);
    }

    public function deleteBanner(Request $request, $id) {

        try{
            // delete item in database
            $banner = Banner::where('id', $id)->first();
            $pathBanner = $banner->path;
            $result = $banner->delete();

            if($result){
                // delete file
                Storage::delete('public/' . $pathBanner);
                return response()->json(['message' => 'success'], 204);
            }

            return response()->json(['message' => 'already delete'], 404);
        }catch(\Throwable  $e){
            return response()->json(["error" => $e], 500);
        }
    }

    public function storeNotice(Request $request) {
        $result = Notice::create([
            'message' => $request->notice
        ]);

        if($result){
            return response()->json(['message' => 'success'], 201);
        }

        return response()->json(['message' => 'failed', 409]);
    }
}
