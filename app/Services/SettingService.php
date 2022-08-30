<?php

namespace App\Services;

use App\Models\Banner;

class SettingService
{
    public function setFileBanner($banner) {
        $filename = now()->format("YMdHis") . "banner." . $banner->extension();
        $path = $banner->storeAs('public/images', $filename);

        return [$filename, $path];
    }

    public function createBanner($filename, $path) {
        $result = Banner::create([
            'filename' => $filename,
            'path' => $path,
            'priorities' => 1,
        ]);
    }
}
