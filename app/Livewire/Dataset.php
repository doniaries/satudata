<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Dataset as DatasetModel;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class Dataset extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind'; // Menggunakan tema Tailwind untuk pagination

    // Reset pagination saat filter berubah
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Clear all filters and reset to default state
     */
    public function clearFilters()
    {
        $this->reset(['search', 'organization', 'tag']);
        $this->resetPage();

        // Redirect ke halaman dataset tanpa parameter
        return redirect()->route('datasets.index');
    }

    /**
     * Properti untuk pencarian dan filter
     */
    public $search = '';
    public $orderBy = 'relevansi';
    public $organization = null;
    public $tag = null;
    public $organizations = [];
    public $tags = [];
    public $totalDatasets = 0;
    public $showAllFormats = false;
    protected $queryString = ['search', 'orderBy', 'organization', 'tag'];

    /**
     * Mount the component with optional organization and tag parameters
     */
    public function mount($organization = null, $tag = null)
    {
        $this->organization = $organization;
        $this->tag = $tag;
        $this->showAllFormats = false; // Default value
    }

    public function toggleShowAllFormats()
    {
        $this->showAllFormats = !$this->showAllFormats;
    }

    public function render()
    {
        // Ambil semua organisasi dengan jumlah dataset
        $this->organizations = Organization::withCount('datasets')
            ->orderByDesc('datasets_count')
            ->get();

        // Ambil semua tag dengan jumlah dataset
        $this->tags = Tag::withCount('datasets')
            ->orderByDesc('datasets_count')
            ->get();

        // Query dataset
        $query = DatasetModel::with(['organization', 'tags'])
            ->where('is_publik', true);

        // Filter berdasarkan pencarian
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi_dataset', 'like', '%' . $this->search . '%')
                    ->orWhereYear('tanggal_rilis', 'like', '%' . $this->search . '%')
                    ->orWhereHas('organization', function ($q2) {
                        $q2->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Filter berdasarkan organisasi yang dipilih
        if ($this->organization) {
            $query->whereHas('organization', function ($q) {
                $q->where('slug', $this->organization);
            });
        }

        // Filter berdasarkan tag yang dipilih
        if ($this->tag) {
            $query->whereHas('tags', function ($q) {
                $q->where('slug', $this->tag);
            });
        }

        // Sorting
        if ($this->orderBy === 'relevansi') {
            $query->orderByDesc('jumlah_dilihat');
        } else {
            $query->orderByDesc('created_at');
        }

        $this->totalDatasets = (clone $query)->count();
        $datasets = $query->paginate(10);

        // Ambil format file yang tersedia langsung dari kolom format di tabel datasets
        $formats = DatasetModel::select('format', DB::raw('COUNT(*) as total'))
            ->whereNotNull('format')
            ->groupBy('format')
            ->orderBy('format')
            ->get();

        return view('livewire.dataset', [
            'datasets' => $datasets,
            'totalDatasets' => $this->totalDatasets,
            'organizations' => $this->organizations,
            'tags' => $this->tags,
            'formats' => $formats,
            'showAllFormats' => $this->showAllFormats,
            'search' => $this->search,
            'orderBy' => $this->orderBy,
        ]);
    }
}
