<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CetakTabunganResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transactionDate' => date('Y-m-d', strtotime($this->transactionDate)),
            'description' => $this->description,
            'credit' => $this->debitCreditStatus == 'C' ? number_format($this->amount, '0', '.', '.') : '-',
            'debit' => $this->debitCreditStatus == 'D' ? number_format($this->amount, '0', '.', '.') : '-',
            'amount' => number_format($this->amount, '0', '.', '.'),
        ];
    }
}
