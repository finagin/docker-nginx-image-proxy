<?php

namespace App\Helpers;

use App\Contracts\Renderable;

class View implements Renderable
{
    protected string $view;

    protected array $data = [];

    public function __construct(string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public static function make(string $view, array $data = [])
    {
        return new static($view, $data);
    }

    public function render()
    {
        extract($this->data);

        require __DIR__.'/../../resources/views/'.$this->view.'.php';
    }
}
