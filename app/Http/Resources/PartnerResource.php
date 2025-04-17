<?php

namespace App\Http\Resources;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Partner $resource
 */
class PartnerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->resource->id,
            'name'     => $this->resource->name,
            'website'  => $this->resource->website,
            'logo'     => $this->resource->logo,
            'location' => $this->resource->location,
        ];
    }
}
