<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Dataset as DatasetModel;
use App\Models\Organization;
use Illuminate\Support\Facades\Request;

class Dataset extends Component
{
    public $search = '';
    public $orderBy = 'relevansi';

    public function render()
    {
        // Ambil organisasi beserta jumlah dataset
        $organizations = Organization::withCount('datasets')->orderByDesc('datasets_count')->get();

        // Query dataset
        $query = DatasetModel::with(['organization'])
            ->where('is_publik', true);
        
        if ($this->search) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        }
        // Sorting sederhana (bisa dikembangkan)
        if ($this->orderBy === 'relevansi') {
            $query->orderByDesc('jumlah_dilihat');
        } else {
            $query->orderByDesc('created_at');
        }
        $datasets = $query->paginate(10);
        $totalDatasets = $query->count();

        return view('livewire.dataset', [
            'organizations' => $organizations,
            'datasets' => $datasets,
            'totalDatasets' => $totalDatasets,
            'search' => $this->search,
            'orderBy' => $this->orderBy,
        ]);
    }
}

