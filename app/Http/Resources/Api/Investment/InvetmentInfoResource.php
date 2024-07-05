<?php

namespace App\Http\Resources\Api\Investment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvetmentInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'=>$this->user_id,
            'age' => $this->age,
            'edu_level' => $this->edu_level,
            'married' => $this->married == 1 ? 'Married' : 'Not Married',
            'kids' => $this->kids,
            'life_stage' => $this->life_stage,
            'occu_category' => $this->occu_category,
            'income' => $this->income,
            'risk' => $this->risk,
            'eager' => $this->eager == 1 ? 'Eager' : 'Not Eager',
            'investment_amount' => $this->investment_amount,
            'end_date' => $this->end_date,
        ];
    }
}
