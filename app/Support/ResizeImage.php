<?php


namespace App\Support;

use App\Helper\Helper;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ResizeImage
{

    private $thumbnailPath;

    private string $folderName;

    private string $ds;

    private int $width;

    private int $height;

    private int $quality = 90;

    private bool $aspectRatio = true;

    public static function make(): static
    {
        return new static();
    }

    public function __construct()
    {
        $this->thumbnailPath = null;
        $this->folderName = 'custom-temp';
        $this->ds = DIRECTORY_SEPARATOR;
    }

    private function createDirectory(): void
    {
        $paths = [
            'thumbnail_path' => storage_path('app' . $this->ds . 'public' . $this->ds . $this->folderName)
        ];
        foreach ($paths as $key => $path) {
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
        }
        $this->thumbnailPath = $paths['thumbnail_path'];
    }

    public function width(int $imageWidth): ResizeImage
    {
        $this->width = $imageWidth;
        return $this;
    }

    public function height(int $imageHeight): ResizeImage
    {
        $this->height = $imageHeight;
        return $this;
    }

    public function quality(int $quality): ResizeImage
    {
        $this->quality = $quality;
        return $this;
    }

    public function enableAspectRatio(): ResizeImage
    {
        $this->aspectRatio = true;
        return $this;
    }

    public function upload($originalImage): string
    {
        $this->createDirectory();
        if (!in_array($originalImage->getMimeType(), ["image/svg+xml", "image/svg"])) {
            $fileName = Helper::setFileName($originalImage);
            $path = $this->thumbnailPath . $this->ds . $fileName;
            try {
                if ($this->aspectRatio == false) {
                    Image::make($originalImage)->resize($this->width, $this->height, function ($ratio) {
                        $ratio->aspectRatio();
                    })->save($path, $this->quality);
                } else {
                    Image::make($originalImage)->resize($this->width, $this->height)->save($path, $this->quality);
                }
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
            return $this->thumbnailPath . $this->ds . $fileName;
        } else {
            $path = $originalImage->store("public/custom-temp");
            return storage_path("app/" . $path);
        }
    }

}
