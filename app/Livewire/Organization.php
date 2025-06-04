<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\WithPagination;

class Organization extends Component
{
    use WithPagination;

    public function render()
    {
        $organizations = \App\Models\Organization::select('id','name','alamat','nomor_telepon','email_organisasi','facebook','website_organisasi')->paginate(6);
        return view('livewire.organization', compact('organizations'));
    }
}
