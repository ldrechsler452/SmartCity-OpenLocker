<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ImageService
{
    public static function store(UploadedFile $file): Image
    {
        $image = new Image();

        $image->setAttribute('original_name', $file->getClientOriginalName());

        $extension = $file->getClientOriginalExtension();
        $path = Storage::putFileAs(
            path: '/images',
            file: $file,
            name: $image->getUuid() . '.' . $extension
        );

        $image->setFilePath(storage_path($path));
        $image->save();

        return $image;
    }
}
