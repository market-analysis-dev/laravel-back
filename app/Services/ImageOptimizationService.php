<?php

namespace App\Services;


use Spatie\Image\Image;

class ImageOptimizationService
{

    public function __construct(private readonly Image $image)
    {
    }

    /**
     * @throws \Spatie\Image\Exceptions\CouldNotLoadImage
     */
    public function optimize(string $path): void
    {
        $image = $this->image::load($path);
        $width = $image->getWidth();

        if ($width >= 3000) {
            $image->width(2560);
        } else {
            $image->width(1920);
        }

        $image->save();
    }
}
