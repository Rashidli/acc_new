<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{

    public function uploadFile(UploadedFile $image, ?string $path = 'files', string $disk = 'public'): string
    {
        $name = $path . '/' . Str::uuid()->toString() . '.' . $image->extension();
        $image->storeAs($disk, $name);
        return $name;
    }

    public function removeFile($image_name, string $disk = 'public')
    {
        Storage::disk($disk)->delete($image_name);
    }

}
