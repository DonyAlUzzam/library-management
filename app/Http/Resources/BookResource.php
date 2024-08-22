<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'publish_date' => $this->publish_date,
            'author_id' => $this->author_id,
            'author' => new AuthorResource($this->whenLoaded('author')),
        ];
    }
}
