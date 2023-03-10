<?php

namespace App\Http\Controllers;

use App\Components\WarningMessage;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\Encashment;
use App\Models\Expense;
use App\Models\OfficeDay;
use App\Models\User;
use App\Models\WorkDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public function close()
    {
        $workDay = WorkDay::find(auth()->user()->work_day_id);
        $currentUser = User::find(auth()->user()->id);
        $officeDay = $workDay->officeDay;

        if($workDay && $officeDay){
            $days = $officeDay->days;

            foreach ($days as $day) {

                $day->update(['finish' => \Carbon\Carbon::now()]);
                $user = User::find($day->user_id);
                $user->update(['work_day_id' => null]);

                if($user->id != $currentUser->id){
                    Auth::setUser($user);
                    Auth::logout();
                }
            }

            $officeDay->update(['finish' => \Carbon\Carbon::now()]);
        }

        Auth::setUser($currentUser);
        $data['work_day'] = $workDay;
        return view('closed', compact('data'));
    }

    public function warning()
    {
        $workDay = WorkDay::find(auth()->user()->work_day_id);
        $data = request()->validate([
            'usd_fact' => 'required|integer',
            'usd_system' => 'required|integer',
            'usdt_fact' => 'required|integer',
            'usdt_system' => 'required|integer',
            'gel_fact' => 'required|integer',
            'gel_system' => 'required|integer',
            'kzt_fact' => 'required|integer',
            'kzt_system' => 'required|integer',
            'comment' => '',
        ]);


        $request = new WarningMessage();
        $request->setMessage($workDay, $data);
        $status = $request->sendMessage();

        if($status === 200){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Сообщение о несоответствии отправлено!']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Ошибка отправки сообщения! Обратитесь к администратору!']);
        }
    }
}
