<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarVideo extends Component
{
    /**
     * Create a new component instance.
     */

    public $videos;
    public $showViewMoreLink;
    public $paginate;
    public function __construct($videos, $showViewMoreLink, $paginate)
    {
        $this->videos = $videos;
        $this->showViewMoreLink = $showViewMoreLink;
        $this->paginate = $paginate;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-video');
    }
}
