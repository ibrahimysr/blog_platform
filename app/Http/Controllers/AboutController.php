<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('about.index');
    }

    public function mission()
    {
        return view('about.mission');
    }

    public function projects()
    {
        return view('about.projects');
    }

    public function team()
    {
        return view('about.team');
    }

    public function contact()
    {
        return view('about.contact');
    }

    public function member()
    {
        return view('about.member');
    }

    public function representatives()
    {
        return view('about.representatives');
    }

    public function whyFounded()
    {
        return view('about.why-founded');
    }
}
