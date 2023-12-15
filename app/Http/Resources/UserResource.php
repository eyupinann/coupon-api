<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->pay_date != null) {
            $payDate = Carbon::createFromFormat('Y-m-d', $this->pay_date);
            $today = Carbon::today();
        }
        if ($this->type != 0) {
            $check = ($this->type == 1) ? 7 : (($this->type == 2) ? 30 : 90);
        } else {
            $check = 0;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'type' => $this->type ?? '',
            'pay_date' => $this->pay_date,
            'weeks_left' => ($check != 0) ? $check - $today->diffInDays($payDate) : 0,
        ];
    }

}
