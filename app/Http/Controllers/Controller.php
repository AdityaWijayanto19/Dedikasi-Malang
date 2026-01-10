<?php

namespace App\Http\Controllers;
use App\Services\FileServices;

abstract class Controller
{
    protected $fileServices;

    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }
}
