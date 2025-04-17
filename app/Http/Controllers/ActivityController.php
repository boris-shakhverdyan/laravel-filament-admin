<?php

namespace App\Http\Controllers;

use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with(['partner', 'type'])
            ->withCount('favoritedBy')
            ->paginate(5);

        $userFavorites = auth()->check()
            ? auth()->user()->favoriteActivities->pluck('id')->toArray()
            : [];

        return view('home', compact('activities', 'userFavorites'));
    }

    public function favorites()
    {
        $favorites = auth()->user()
            ->favoriteActivities()
            ->with(['partner', 'type'])
            ->paginate(10);

        return view('activities.favorites', compact('favorites'));
    }

    public function favorite(Activity $activity)
    {
        auth()->user()->favoriteActivities()->syncWithoutDetaching([$activity->id]);
        return back();
    }

    public function unfavorite(Activity $activity)
    {
        auth()->user()->favoriteActivities()->detach($activity->id);
        return back();
    }
}
