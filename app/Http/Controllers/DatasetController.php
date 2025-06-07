<?php

namespace App\Http\Controllers;

use App\Livewire\Dataset as DatasetComponent;
use App\Models\Tag;
use App\Models\Team;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function index()
    {
        return app(DatasetComponent::class)();
    }

    public function byTeam($teamSlug)
    {
        $team = Team::where('slug', $teamSlug)->firstOrFail();

        // Simpan filter team di session atau langsung oper ke komponen
        return app(DatasetComponent::class)->mount(team: $team->slug)();
    }

    public function byTag($tagSlug)
    {
        $tag = Tag::where('slug', $tagSlug)->firstOrFail();

        // Simpan filter tag di session atau langsung oper ke komponen
        return app(DatasetComponent::class)->mount(tag: $tag->slug)();
    }
}
