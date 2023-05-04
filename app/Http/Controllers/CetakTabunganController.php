<?php

namespace App\Http\Controllers;

use App\Http\Resources\CetakTabunganResource;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakTabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        // dd(Carbon::datetime($request->startDate));
        $cetak = Transaction::query()
            ->where('accountId', $request->accountId)
            ->whereDate('transactionDate', '>=', $request->startDate)
            ->whereDate('transactionDate', '<=', $request->endDate);
        // dd($cetak->get());
        return CetakTabunganResource::collection($cetak->get());
    }
}
