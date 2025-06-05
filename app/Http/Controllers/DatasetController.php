<?php

namespace App\Http\Controllers;

use App\Livewire\Dataset as DatasetComponent;
use App\Models\Organization;
use App\Models\Tag;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function index()
    {
        return app(DatasetComponent::class)();
    }

    public function byOrganization($organizationSlug)
    {
        $organization = Organization::where('slug', $organizationSlug)->firstOrFail();
        
        // Simpan filter organization di session atau langsung oper ke komponen
        return app(DatasetComponent::class)->mount(organization: $organization->slug)();
    }

    public function byTag($tagSlug)
    {
        $tag = Tag::where('slug', $tagSlug)->firstOrFail();
        
        // Simpan filter tag di session atau langsung oper ke komponen
        return app(DatasetComponent::class)->mount(tag: $tag->slug)();
    }
}
