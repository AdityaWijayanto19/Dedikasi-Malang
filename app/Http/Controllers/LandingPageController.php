<?php

namespace App\Http\Controllers;

use App\Enums\StatusPostingan;
use App\Enums\StatusCerita;
use App\Models\Cerita;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Enums\pengurusStatus;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function indexKegiatan()
    {
        
        $kegiatan = Kegiatan::where('status', StatusPostingan::Publish)
        ->latest()
        ->get();
        
        $cerita = Cerita::where('status', StatusCerita::Publish)->latest()->get();

        $pengurus = Pengurus::where('status', pengurusStatus::Active)->get();

        return view('welcome', compact('kegiatan', 'cerita', 'pengurus'));
    }
}
