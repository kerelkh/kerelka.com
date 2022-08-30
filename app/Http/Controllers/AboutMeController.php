<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\Contact;
use App\Services\AboutMeService;
use App\Http\Requests\ContactRequest;

class AboutMeController extends Controller
{
    private $page = 'About me';

    public function index() {

        $designs = AboutMeService::getDesign(6);
        $projects = AboutMeService::getProject(6);

        return view('aboutme', [
            'page' => $this->page,
            'designs' => $designs,
            'projects' => $projects
        ]);
    }

    public function storeContact(ContactRequest $request) {

        $result = AboutMeService::setContact($request);

        if($result) {
            return redirect()->route('aboutme')->with('message', 'Thank you for your messages');
        }

        return back()->with('error', 'Your message failed to send');
    }
}
