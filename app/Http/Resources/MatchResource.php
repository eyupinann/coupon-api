<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "oran" => $this->oran,
            "tahmin" => $this->tahmin,
            "durum" => $this->durum,
            "coupon_date" => $this->coupon_date,
            "created_at" => date_format($this->created_at, 'd-m-Y-H-i-s'),
            "updated_at"=> date_format($this->updated_at, 'd-m-Y-H-i-s'),
            "taraflar" => $this->taraflar,
            "eventId" => $this->eventId,
            "coupon" => CouponResource::make($this->coupon),
        ];
    }
}
