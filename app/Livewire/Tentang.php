<?php

namespace App\Livewire;

use Livewire\Component;

class Tentang extends Component
{
    public function render()
    {
        $tentangs = \App\Models\Tentang::all();
        return view('livewire.tentang', compact('tentangs'));
    }
}
