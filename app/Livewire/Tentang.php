<?php

namespace App\Livewire;

use Livewire\Component;

class Tentang extends Component
{
    public function render()
    {
        $tentangs = \App\Models\Tentang::select('judul', 'deskripsi')->paginate(12);
        return view('livewire.tentang', compact('tentangs'));
    }
}
