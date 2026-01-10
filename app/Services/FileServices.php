<?php

namespace App\Services;

use Illuminate\Container\Attributes\Storage;

class FileServices
{
    public function UploadOrUpdate($file, $folder, $oldFile = null)
    {
        if ($oldFile) {
            Storage::disk('public')->delete($oldFile);
        }

        return $file->store($folder, 'public');
    }

    public function deleteFile($path){
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
