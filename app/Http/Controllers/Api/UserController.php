<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\UserResource;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with(['roles'])->paginate(10)
        );
    }
}
