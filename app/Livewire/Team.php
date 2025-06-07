<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

class Team extends Component
{
    use WithPagination;

    public function render()
    {
        $teams = \App\Models\Team::select('id', 'name', 'alamat', 'nomor_telepon', 'email_organisasi', 'facebook', 'website_organisasi')->paginate(6);
        return view('livewire.team', compact('teams'));
    }
}
