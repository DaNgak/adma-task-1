<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ticket_id' => $this->ticket_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'reporter_id' => $this->reporter_id,
            'category_id' => $this->category_id,
            'reporter' => $this->reporter_id ? $this->reporter->email . ' (' . $this->reporter->name .')' : null,
            'category' => $this->category_id ? $this->category->name : null,
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}
