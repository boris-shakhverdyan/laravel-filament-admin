<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\PartnerResource;
use App\Models\Activity;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return PartnerResource::collection(
            Partner::paginate(10)
        );
    }
}
