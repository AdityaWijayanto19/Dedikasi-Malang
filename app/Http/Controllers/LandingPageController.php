<?php

namespace App\Http\Controllers;

use App\Enums\StatusPostingan;
use App\Models\Cerita;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
     public function indexKegiatan()
    {
        $kegiatan = Kegiatan::where('status', StatusPostingan::Publish)
            ->latest()
            ->get();

        $cerita = Cerita::latest()->get();

        return view('welcome', compact('kegiatan', 'cerita'));
    }
}
