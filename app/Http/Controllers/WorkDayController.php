<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Leftovers;
use App\Models\Office;
use App\Models\OfficeDay;
use App\Models\User;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;


class WorkDayController extends BaseController
{
    public function start()
    {
        $offices = Office::all();
        return view('auth.start', compact('offices'));
    }

    public function step2(WorkDay $workDay)
    {
        return view('auth.step2', compact('workDay'));
    }

    public function changeOffice()
    {

        $data = request()->validate([
            'office_id' => 'required|integer',
        ]);

        $office = Office::findOrFail($data['office_id']);


        $officeDay = OfficeDayController::findCurrentOfficeDay($office->id);
        if(!$officeDay){
            $officeDay = OfficeDay::create(
                [
                    'office_id' => $office->id,
                    'start' => Carbon::now()
                ],
            );
        }

        $workDay = self::findCurrentWorkDay($officeDay->id);
        if (!$workDay) {

            $workDay = WorkDay::create(
                [
                    'office_day_id' => $officeDay->id,
                    'user_id' => auth()->user()->id,
                    'start' => Carbon::now()
                ],
            );
//            dd($workDay);

            $user = User::find(auth()->user()->id);
            $user->update(['work_day_id' => $workDay->id]);
        }

        if($officeDay->commissions_id_buy && $officeDay->commissions_id_sale && $officeDay->leftovers_id){

            $user = User::find(auth()->user()->id);
            $user->update(['work_day_id' => $workDay->id]);

            return redirect()->route('index');
        }

//        auth()->user()->current_day = $workDay;
        $previousDay = OfficeDay::whereDateBetween('start', (new Carbon)->startOfYear()->startOfDay()->toDateString(), (new Carbon)->yesterday()->endOfDay()->toDateString())
            ->where(['office_id' => $office->id])
            ->latest()
            ->first();
//
//        $previousDay = WorkDay::whereDateBetween('start', (new Carbon)->startOfYear()->startOfDay()->toDateString(), (new Carbon)->yesterday()->endOfDay()->toDateString())
//            ->where(['office_day_id' => $previousOfficeDay->id])
//            ->latest()
//            ->first();
//        dump($previousOfficeDay);
//        dd($previousDay);
        return view('auth.step2', compact('workDay', 'previousDay'));
    }

    public function officeSetData()
    {

        $data = request()->validate([
            'office_id' => 'required|numeric',
            'work_day_id' => 'required|numeric',
            'USD' => 'required|numeric',
            'USDT' => 'required|numeric',
            'KZT' => 'numeric',
            'GEL' => 'numeric',
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
//        dd($data);
        $workDay = WorkDay::find($data['work_day_id']);
        $officeDay = OfficeDay::find($workDay->officeDay->id);
//        dump($workDay);
//        dd($officeDay);
        if ($workDay && $officeDay) {

            $leftovers = Leftovers::create([
//                'office_id' => $data['office_id'],
                'USD' => $data['USD'],
                'USDT' => $data['USDT'],
                'KZT' => $data['KZT'],
                'GEL' => $data['GEL'],
            ]);

            $commisionBuy = Commission::create([
//                'office_id' => $data['office_id'],
                'type' => 'buy',
                'from_0' => $data['buy_from_0'],
                'from_100' => $data['buy_from_100'],
                'from_1000' => $data['buy_from_1000'],
                'from_10000' => $data['buy_from_10000'],
                'from_50000' => $data['buy_from_50000'],
                'from_100000' => $data['buy_from_100000'],
            ]);

            $commisionSale = Commission::create([
//                'office_id' => $data['office_id'],
                'type' => 'sale',
                'from_0' => $data['sale_from_0'],
                'from_100' => $data['sale_from_100'],
                'from_1000' => $data['sale_from_1000'],
                'from_10000' => $data['sale_from_10000'],
                'from_50000' => $data['sale_from_50000'],
                'from_100000' => $data['sale_from_100000'],
            ]);

            $officeDay->update([
                'commissions_id_buy' => $commisionBuy->id,
                'commissions_id_sale' => $commisionSale->id,
                'leftovers_id' => $leftovers->id,
            ]);

            $user = User::find(auth()->user()->id);
            $user->update(['work_day_id' => $workDay->id]);
//            dd($workDay);
//            $this->current_day = $workDay;
//            auth()->user()->current_day = $workDay;
            return redirect()->route('index');
        }
    }

    public function findCurrentWorkDay($officeDayId)
    {

        $lastDayRecord
            = WorkDay::whereDateBetween('start', (new Carbon)->now()->startOfDay()->toDateString(), (new Carbon)->now()->endOfDay()->toDateString())
            ->get();
        $todayRecordIds = array_column($lastDayRecord->toArray(), 'id');

        $workDay = WorkDay::whereIn('id', $todayRecordIds)
            ->where([
                ['user_id', '=', auth()->user()->id],
                ['office_day_id', '=', $officeDayId],
            ])->latest()->first();

        return $workDay;
    }
}
