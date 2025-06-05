<?php

namespace App\Livewire;

use Livewire\Component;

class Tag extends Component
{
    public function render()
    {
        $tags = \App\Models\Tag::select('id', 'name', 'slug')->paginate(6);
        return view('livewire.tag', compact('tags'));
    }
}
