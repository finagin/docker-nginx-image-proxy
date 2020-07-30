<?php

namespace App\Helpers;

class Image
{
    protected string $path;

    protected string $service;

    protected string $size = '';

    protected const DEFAULT_SIZE = 600;

    public const LOCAL = 'local';

    public const PINTEREST = 'pinterest';

    public const CUSTOM = 'custom';

    protected const SERVICES = [
        self::LOCAL => [
            'origin' => 'http://test-nginx.loc/storage/',
            'proxy' => 'http://test-nginx.loc/resize/local/',
        ],
        self::PINTEREST => [
            'origin' => 'https://i.pinimg.com/originals/',
            'proxy' => 'http://test-nginx.loc/resize/pinterest/',
        ],
        self::CUSTOM => [
            'origin' => 'https://i.pinimg.com/originals/',
            'proxy' => 'http://test-nginx.loc/resize/custom/',
        ],
    ];

    public function __construct($path, $service = self::LOCAL)
    {
        $this->path = $path;
        $this->service = $service;
        $this->setSize();
    }

    public function setSize(int $size = self::DEFAULT_SIZE): self
    {
        $this->size = $this->service === static::CUSTOM
            ? $size.'/'
            : '';

        return $this;
    }

    public function getUrl($origin = false): string
    {
        $size = $origin
            ? ''
            : $this->size;

        return static::SERVICES[$this->service][$origin ? 'origin' : 'proxy'].$size.$this->path;
    }

    public function getOriginalUrl(): string
    {
        return $this->getUrl(true);
    }

    public static function make($path, $service = self::LOCAL): self
    {
        return new static($path, $service);
    }
}
