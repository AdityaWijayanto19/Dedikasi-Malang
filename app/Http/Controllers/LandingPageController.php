<?php

namespace App\Http\Controllers;

use App\Enums\StatusPostingan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
     public function index()
    {
        $kegiatan = Kegiatan::where('status', StatusPostingan::Publish)
            ->latest()
            ->get();

        return view('welcome', compact('kegiatan'));
    }
}
