<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Kegiatan; 

class NavigationComposerProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('components.navbar', function ($view) {
            $kegiatan_batch = Kegiatan::select('slug', 'batch') // <-- Sudah benar
                                     ->orderBy('id', 'asc') 
                                     ->get();

            $view->with('kegiatan_batch', $kegiatan_batch);
        });
    }
}