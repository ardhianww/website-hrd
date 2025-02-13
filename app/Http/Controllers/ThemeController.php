<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ThemeController extends Controller
{
    public function setDarkMode()
    {
        Cookie::queue('theme', 'dark', 525600); // Cookie berlaku selama 1 tahun
        return response()->json(['message' => 'Dark mode enabled']);
    }

    public function setLightMode()
    {
        Cookie::queue('theme', 'light', 525600);
        return response()->json(['message' => 'Light mode disabled']);
    }
} 