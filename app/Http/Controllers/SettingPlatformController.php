<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingPlatformController extends Controller
{
    public function index()
    {
        return view('addons.settingplatform');
    }
}
