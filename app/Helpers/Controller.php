<?php

namespace App\Helpers;

use App\Contracts\Renderable;

class Controller
{
    public function main(): Renderable
    {
        $images = [
            Image::make('30845deb719c61c0bb246ef8e5465cc9.jpg', Image::LOCAL),
            Image::make('63/21/ea/6321eac2ed3ff1eeb5bad506a7b16b72.jpg', Image::PINTEREST),
            Image::make('95/1d/07/951d0717835ad0e2e7dfb7a414879627.jpg', Image::PINTEREST),
            Image::make('95/1d/07/951d0717835ad0e2e7dfb7a414879627.jpg', Image::CUSTOM)
                ->setSize(100),
            Image::make('95/1d/07/951d0717835ad0e2e7dfb7a414879627.jpg', Image::CUSTOM)
                ->setSize(200),
        ];

        return View::make('main', compact('images'));
    }
}

