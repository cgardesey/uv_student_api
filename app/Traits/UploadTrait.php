<?php
namespace App\Traits;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        ini_set('post_max_size', '2000M');
        ini_set('upload_max_filesize', '2000M');
        $name = !is_null($filename) ? $filename : str_random(25);
        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
        return $file;
    }
}