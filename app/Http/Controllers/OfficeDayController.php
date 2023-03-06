<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Deal;
use App\Models\Encashment;
use App\Models\Expense;
use App\Models\OfficeDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OfficeDayController extends BaseController
{

    public function findCurrentOfficeDay($officeId)
    {

        $lastDayRecord
            = OfficeDay::whereDateBetween('start', (new Carbon)->now()->startOfDay()->toDateString(), (new Carbon)->now()->endOfDay()->toDateString())
            ->get();
        $todayRecordIds = array_column($lastDayRecord->toArray(), 'id');

        return OfficeDay::whereIn('id', $todayRecordIds)
            ->where([
                ['office_id', '=', $officeId],
            ])->latest()->first();
    }

    public function updateLeftoversFromDeal(Deal $deal)
    {
        $currentLeftovers = $deal->workDay->officeDay->leftovers;
        $receivingCurrency = $deal->receivingCurrency->title;
        $returnCurrency = $deal->returnCurrency->title;;
        $leftoversData = [];

        $leftoversData[$receivingCurrency] = $currentLeftovers->$receivingCurrency - $deal->return_sum;
        $leftoversData[$returnCurrency] = $currentLeftovers->$returnCurrency + $deal->receiving_sum;

        return $currentLeftovers->update($leftoversData);
    }

    public function unsetLeftoversFromDeal(Deal $deal)
    {
        $currentLeftovers = $deal->workDay->officeDay->leftovers;
        $receivingCurrency = $deal->receivingCurrency->title;
        $returnCurrency = $deal->returnCurrency->title;;
        $leftoversData = [];

        $leftoversData[$receivingCurrency] = $currentLeftovers->$receivingCurrency + $deal->return_sum;
        $leftoversData[$returnCurrency] = $currentLeftovers->$returnCurrency - $deal->receiving_sum;

        return $currentLeftovers->update($leftoversData);
    }

    public function updateLeftoversFromExpense(Expense $expense)
    {
        $currentLeftovers = $expense->workDay->officeDay->leftovers;
        $currency = Currency::find($expense->currency_id)->title;
        $leftoversData = [];

        $leftoversData[$currency] = $currentLeftovers->$currency - $expense->amount;

        return $currentLeftovers->update($leftoversData);
    }

    public function unsetLeftoversFromExpense(Expense $expense)
    {
        $currentLeftovers = $expense->workDay->officeDay->leftovers;
        $currency = Currency::find($expense->currency_id)->title;
        $leftoversData = [];

        $leftoversData[$currency] = $currentLeftovers->$currency + $expense->amount;

        return $currentLeftovers->update($leftoversData);
    }

    public function updateLeftoversFromEncashment(Encashment $encashment)
    {
        $currentLeftovers = $encashment->workDay->officeDay->leftovers;
        $currency = Currency::find($encashment->currency_id)->title;
        $leftoversData = [];

        $leftoversData[$currency] = $encashment->type_id == 1 ? $currentLeftovers->$currency + $encashment->amount : $currentLeftovers->$currency - $encashment->amount ;

        return $currentLeftovers->update($leftoversData);
    }

    public function unsetLeftoversFromEncashment(Encashment $encashment)
    {
        $currentLeftovers = $encashment->workDay->officeDay->leftovers;
        $currency = Currency::find($encashment->currency_id)->title;
        $leftoversData = [];

        $leftoversData[$currency] = $encashment->type_id == 1 ? $currentLeftovers->$currency - $encashment->amount : $currentLeftovers->$currency + $encashment->amount ;

        return $currentLeftovers->update($leftoversData);
    }
}
