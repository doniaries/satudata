<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Dataset as DatasetModel;
use App\Models\Organization;
use Illuminate\Support\Facades\Request;

class Dataset extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap'; // Jika menggunakan Bootstrap, sesuaikan dengan tema yang digunakan
    
    // Reset pagination saat filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectOrganization($organizationId)
    {
        $this->selectedOrganization = $organizationId;
        $this->resetPage();
    }

    public function selectTag($tagId)
    {
        $this->selectedTag = $tagId;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'selectedOrganization', 'selectedTag']);
        $this->resetPage();
    }

    // Properti untuk pencarian dan filter
    public $search = '';
    public $searchOrg = '';
    public $searchTag = '';
    public $orderBy = 'relevansi';
    public $showAllOrganizations = false;
    public $showAllTags = false;
    public $showAllFormats = false;
    public $selectedOrganization = null;
    public $selectedTag = null;

    public function render()
    {
        // Ambil organisasi dengan filter pencarian
        $organizationsQuery = Organization::withCount('datasets');
        
        if ($this->searchOrg) {
            $organizationsQuery->where('name', 'like', '%' . $this->searchOrg . '%');
        }
        
        $organizations = $organizationsQuery->orderByDesc('datasets_count')->get();
        
        // Ambil tag dengan filter pencarian
        $tagsQuery = \App\Models\Tag::withCount('datasets');
        
        if ($this->searchTag) {
            $tagsQuery->where('name', 'like', '%' . $this->searchTag . '%');
        }
        
        $tags = $tagsQuery->orderByDesc('datasets_count')->get();

        // Query dataset
        $query = DatasetModel::with(['organization', 'tags'])
            ->where('is_publik', true);

        // Filter berdasarkan pencarian
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('deskripsi_dataset', 'like', '%' . $this->search . '%')
                  ->orWhereYear('tanggal_rilis', 'like', '%' . $this->search . '%')
                  ->orWhereHas('organization', function($q2) {
                      $q2->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Filter berdasarkan organisasi yang dipilih
        if ($this->selectedOrganization) {
            $query->whereHas('organization', function($q) {
                $q->where('id', $this->selectedOrganization);
            });
        }

        // Filter berdasarkan tag yang dipilih
        if ($this->selectedTag) {
            $query->whereHas('tags', function($q) {
                $q->where('tags.id', $this->selectedTag);
            });
        }
        // Sorting sederhana (bisa dikembangkan)
        if ($this->orderBy === 'relevansi') {
            $query->orderByDesc('jumlah_dilihat');
        } else {
            $query->orderByDesc('created_at');
        }
        $totalDatasets = (clone $query)->count();
        $datasets = $query->paginate(10);

        // Ambil tags dan jumlah datasets per tag
        $tags = \App\Models\Tag::withCount('datasets')->orderByDesc('datasets_count')->get();

        // Ambil format dan jumlah dataset per format (dari tabel datasets)
        $formats = \App\Models\Dataset::select('format')
            ->selectRaw('COUNT(*) as total')
            ->whereNotNull('format')
            ->groupBy('format')
            ->orderByDesc('total')
            ->get();

        return view('livewire.dataset', [
            'organizations' => $organizations,
            'datasets' => $datasets,
            'totalDatasets' => $totalDatasets,
            'search' => $this->search,
            'orderBy' => $this->orderBy,
            'tags' => $tags,
            'formats' => $formats,
        ]);
    }
}
