<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait BucketFileTrait
{
    /**
     * Function to upload a file to a bucket
     *
     * @param Request $request
     * @param string $folder
     * @return array
     */
    public function uploadFile(Request $request, string $folder): array
    {
        try {
            $fileName = $request->file->getClientOriginalName();
            $filePath = $folder . '/' . $fileName;
            $res = Storage::disk('s3')->put($filePath, file_get_contents($request->file));
            if ($res) {
                return ['res' => $res, 'path' => env('AWS_DISK_S3_LINK') . $filePath];
            }
        } catch (\Throwable $th) {
            return ['res' => false, 'path' => ''];
        }
    }

    /**
     * Function to delete a file from a bucket
     *
     * @param string $imageName
     * $param string $folder
     * @return array
     */
    public function deleteFile(string $folder, string $imageName): array
    {
        try {
            if (Storage::disk('s3')->delete($folder . '/' . $imageName)) {
                return ['res' => true, 'message' => 'Imagen eliminada con exito!'];
            }
        } catch (\Throwable $th) {
            return ['res' => false, 'message' => 'Error al eliminar la imagen'];
        }
    }

    /**
     * Function to explode a path the image
     *
     * @param string $path
     * @return array
     */
    public function explodePath(string $path): array
    {
        $explodeImage = explode('.com/', $path);
        $image        = $explodeImage[1];
        $explodeImage = explode('/', $image);
        $folder       = $explodeImage[0];
        $image        = $explodeImage[1];
        return ['folder' => $folder, 'file' => $image];
    }
}
