<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        return ActivityResource::collection(
            Activity::with(['partner', 'type', 'creator'])->paginate(10)
        );
    }
}
