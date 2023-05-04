<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionSingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'accountId' => $this->accountId,
            'transactionDate' => $this->transactionDate->format('Y-m-d'),
            'description' => $this->description,
            'debitCreditStatus' => $this->debitCreditStatus,
            'amount' => number_format($this->amount, '0', '.', '.'),
        ];
    }
}
