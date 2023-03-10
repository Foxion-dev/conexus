<?php

namespace App\Http\Controllers;

use App\Components\WarningMessage;
use App\Models\Collector;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\Office;
use App\Models\RequestMoney;
use App\Models\User;
use App\Models\WorkDay;
use Carbon\Carbon;
use function Symfony\Component\Translation\t;

class StatisticController extends BaseController
{

    public function index()
    {

        $typeData = [
          'deals' => 'По количеству сделок',
          'profit' => 'По прибыли',
          'turnover_in' => 'По обороту (полученных)',
          'turnover_out' => 'По обороту (отданных)',
        ];

        $offices = Office::all();
        $users = User::all();

        return view('statistic.index', compact( 'typeData', 'offices', 'users'));
    }

    public function filter()
    {
        $statistic = [];
        $data = request()->validate([
            'start_interval' => 'date',
            'end_interval' => 'date',
            'user_id' => '',
            'office_id' => '',
        ]);
//        dd($data);
        $statistic['data'] = [
            'start' => $data['start_interval'],
            'finish' => $data['end_interval']
        ];

        $typeData = [
            'deals' => 'По количеству сделок',
            'profit' => 'По прибыли',
            'turnover_in' => 'По обороту (полученных)',
            'turnover_out' => 'По обороту (отданных)',
        ];

        $offices = Office::all();
        $users = User::all();
//        dd($data);
        if(isset($data['user_id']) && $data['user_id'][0] !== null){
            foreach ($data['user_id'] as $userId){
                $statistic['items'][] = $this->getUserStatistic($data, $userId);
            }
        }

        if(isset($data['office_id'])  && $data['office_id'][0] !== null){
            foreach ($data['office_id'] as $officeId){
                $statistic['items'][] = $this->getOfficeStatistic($data, $officeId);
            }
        }

        return view('statistic.index', compact('statistic', 'typeData', 'offices', 'users', 'data'));
    }

    protected function getUserStatistic($data, $userId)
    {
        $result = [];
        $request = Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->select('deals.*', 'work_days.user_id')
            ->where(['user_id' => $userId]);

        $turnOverDollar = $this->getTurnover($data, $userId, 1, 'user');
        $turnOverTether = $this->getTurnover($data, $userId, 3, 'user');

        $result['title'] = 'Пользователь - '. User::find($userId)->name;
        $result['profit'] = $request->sum('commission_sum');
        $result['count_deals'] = $request->count();
        $result['turnover_dollar'] = $turnOverDollar;
        $result['turnover_usdt'] = $turnOverTether;

        return $result;
    }

    protected function getOfficeStatistic($data, $officeId)
    {
        $result = [];

        $request = Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->join('office_days', 'work_days.office_day_id', '=', 'office_days.id')
            ->select('deals.*', 'work_days.office_day_id','office_days.office_id')
            ->where(['office_id' => $officeId]);

        $turnOverDollar = $this->getTurnover($data, $officeId, 1, 'office');
        $turnOverTether = $this->getTurnover($data, $officeId, 3, 'office');

        $result['title'] = 'Офис - '. Office::find($officeId)->name;
        $result['profit'] = $request->sum('commission_sum');
        $result['count_deals'] = $request->count();
        $result['turnover_dollar'] = $turnOverDollar;
        $result['turnover_usdt'] = $turnOverTether;

        return $result;
    }

    private function getTurnover($data, $itemId, $currencyId, $type = 'office')
    {
        if($type === 'office'){
            return $this->getOfficeReceivingTurnover($data, $itemId, $currencyId) + $this->getOfficeReturnTurnover($data, $itemId, $currencyId);
        }

        if($type === 'user'){
            return $this->getUserReceivingTurnover($data, $itemId, $currencyId) + $this->getUserReturnTurnover($data, $itemId, $currencyId);
        }

        return false;
    }

    private function getOfficeReceivingTurnover($data, $officeId, $currencyId){

        return Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->join('office_days', 'work_days.office_day_id', '=', 'office_days.id')
            ->select('deals.*', 'work_days.office_day_id','office_days.office_id')
            ->where(['office_id' => $officeId, 'receiving_currency_id' => $currencyId])
            ->sum('receiving_sum');
    }

    private function getOfficeReturnTurnover($data, $officeId, $currencyId){

        return Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->join('office_days', 'work_days.office_day_id', '=', 'office_days.id')
            ->select('deals.*', 'work_days.office_day_id','office_days.office_id')
            ->where(['office_id' => $officeId, 'return_currency_id' => $currencyId])
            ->sum('return_sum');
    }

    private function getUserReceivingTurnover($data, $userId, $currencyId){

        return Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->select('deals.*', 'work_days.user_id')
            ->where(['user_id' => $userId, 'receiving_currency_id' => $currencyId])
            ->sum('receiving_sum');
    }

    private function getUserReturnTurnover($data, $userId, $currencyId){

        return Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->select('deals.*', 'work_days.user_id')
            ->where(['user_id' => $userId, 'return_currency_id' => $currencyId])
            ->sum('return_sum');
    }
}
