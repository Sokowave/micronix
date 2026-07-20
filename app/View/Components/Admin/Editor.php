<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Editor extends Component
{
    public function __construct(
        public string $name,
        public ?string $value = '',
        public string $placeholder = '',
    ) {}

    public function render()
    {
        return view('components.admin.editor');
    }
}