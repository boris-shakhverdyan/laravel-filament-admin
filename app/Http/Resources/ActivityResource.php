<?php

namespace App\Http\Resources;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Activity $resource
 */
class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->resource->id,
            'title'              => $this->resource->title,
            'description'        => $this->resource->description,
            'short_description'  => $this->resource->short_description,
            'registration_url'   => $this->resource->registration_url,
            'location'           => $this->resource->location,
            'type'               => $this->resource->type->name ?? null,
            'partner'            => new PartnerResource($this->whenLoaded('partner')),
            'created_by'         => $this->resource->creator->name ?? null,
            'created_at'         => $this->resource->created_at?->toDateTimeString(),
        ];
    }
}
