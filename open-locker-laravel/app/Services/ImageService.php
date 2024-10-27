<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ImageService
{
    /**
     * Saves the uploaded image file to disk.
     *
     * @param UploadedFile $file
     * @return Image
     */
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

        $image->setFilePath($path);
        $image->save();

        return $image;
    }

    /**
     * Removes the given image from disk and deletes the entity.
     *
     * @param Image $image
     * @return void
     */
    public static function delete(Image $image): void
    {
        Storage::delete($image->getFilePath());
        $image->delete();
    }
}
