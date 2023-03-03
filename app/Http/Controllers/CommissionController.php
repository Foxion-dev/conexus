<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\WorkDay;
use Illuminate\Http\Request;

class CommissionController extends BaseController
{
    public function edit(Commission $commission)
    {
        $workDay = WorkDay::find(auth()->user()->work_day_id);
        return view('comissions.edit', compact( 'workDay'));
    }

    public function update(Commission $commission)
    {
        $data = request()->validate([
            'buy_from_0' => 'numeric',
            'buy_from_100' => 'numeric',
            'buy_from_1000' => 'numeric',
            'buy_from_10000' => 'numeric',
            'buy_from_50000' => 'numeric',
            'buy_from_100000' => 'numeric',
            'sale_from_0' => 'numeric',
            'sale_from_100' => 'numeric',
            'sale_from_1000' => 'numeric',
            'sale_from_10000' => 'numeric',
            'sale_from_50000' => 'numeric',
            'sale_from_100000' => 'numeric',
        ]);

        $workDay = WorkDay::find(auth()->user()->work_day_id);

        $commissionBuy = Commission::find($workDay->commissionsBuy->id);
        $commissionSale = Commission::find($workDay->commissionsSale->id);

        $commissionBuyData = [
            'from_0' => $data['buy_from_0'],
            'from_100' => $data['buy_from_100'],
            'from_1000' => $data['buy_from_1000'],
            'from_10000' => $data['buy_from_10000'],
            'from_50000' => $data['buy_from_50000'],
            'from_100000' => $data['buy_from_100000'],
        ];

        $commissionSaleData = [
            'from_0' => $data['sale_from_0'],
            'from_100' => $data['sale_from_100'],
            'from_1000' => $data['sale_from_1000'],
            'from_10000' => $data['sale_from_10000'],
            'from_50000' => $data['sale_from_50000'],
            'from_100000' => $data['sale_from_100000'],
        ];

        $commissionBuy->update($commissionBuyData);
        $commissionSale->update($commissionSaleData);

        return redirect()->route('commissions.edit');

    }
}
