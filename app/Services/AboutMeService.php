<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Design;
use App\Models\Project;

class AboutMeService
{
    public static function getDesign($limit)
    {
        return Design::orderBy('created_at', 'desc')->limit($limit)->get();
    }

    public static function getProject($limit)
    {
        return Project::orderBy('created_at', 'desc')->limit(6)->get();
    }

    public static function setContact($contact)
    {
        return Contact::create($contact);
    }
}
