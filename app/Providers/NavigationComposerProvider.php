<?php

namespace App\Providers;

use App\Models\Cerita;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Kegiatan;

class NavigationComposerProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('components.navbar', function ($view) {
            $kegiatan_batch = Kegiatan::select('slug', 'batch') 
                ->orderBy('id', 'asc')
                ->get();

            $cerita_batch = Cerita::select('slug', 'title') 
                ->orderBy('id', 'asc')
                ->get();

            $view->with('kegiatan_batch', $kegiatan_batch);
            $view->with('cerita_batch', $cerita_batch);
        });
    }
}
