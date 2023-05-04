<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionSingleResource;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $transaksi = DB::transaction(function () use ($request) {
            $transaction = Transaction::create([
                'accountId' => $request->accountId,
                'transactionDate' => now(),
                'description' => $request->description,
                'debitCreditStatus' => $request->debitCreditStatus,
                'amount' => $request->amount,
            ]);
            if ($transaction->description === "Bayar Listrik") {
                if ($transaction->amount > 100000) {
                    $totalPoint = (int)round(($transaction->amount / 2000) * 0);
                    $totalPoint += (int)round((($transaction->amount - 50000) / 2000) * 1);
                    $totalPoint += (int)round(($transaction->amount / 2000) * 2);
                } elseif ($transaction->amount > 50000) {
                    $totalPoint = (int)round(($transaction->amount / 2000) * 0);
                    $totalPoint += (int)round((($transaction->amount - 50000) / 2000) * 1);
                } elseif ($transaction->amount <= 50000) {
                    $totalPoint = (int)round(($transaction->amount / 2000) * 0);
                }
            };
            if ($transaction->description === "Beli Pulsa") {
                if ($transaction->amount > 30000) {
                    $totalPoint = (int)round(($transaction->amount / 1000) * 0);
                    $totalPoint += (int)round((($transaction->amount - 10000) / 1000) * 1);
                    $totalPoint += (int)round(($transaction->amount / 1000) * 2);
                } elseif ($transaction->amount > 10000) {
                    $totalPoint = (int)round(($transaction->amount / 1000) * 0);
                    $totalPoint += (int)round((($transaction->amount - 10000) / 1000) * 1);
                } elseif ($transaction->amount <= 10000) {
                    $totalPoint = (int)round(($transaction->amount / 1000) * 0);
                }
            };

            $customer = Customer::find($transaction->accountId);
            $customer->forceFill([
                'total_point' => $customer->total_point + $totalPoint
            ]);
            $customer->save();

            return $transaction;
        });
        return response()->json([
            'message' => 'Transaksi baru berhasil ditambahkan',
            'data' => new TransactionSingleResource($transaksi),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
