<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'name'=> $this->name,
            'id'=> $this->id,
        ];

        if (!empty($this->children)) {
            $result['children'] = self::collection($this->children);
        }

        return $result;
    }
}
