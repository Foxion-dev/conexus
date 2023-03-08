<?php

namespace App\Http\Controllers;

use App\Models\Collector;
use App\Models\Currency;
use App\Models\Deal;
use App\Models\Office;
use App\Models\RequestMoney;
use App\Models\User;
use App\Models\WorkDay;
use Carbon\Carbon;

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

        if(isset($data['user_id'])){
            foreach ($data['user_id'] as $userId){
                $statistic['items'][] = $this->getUserStatistic($data, $userId);
            }
        }

        if(isset($data['office_id'])){
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

        $result['title'] = 'Пользователь - '. User::find($userId)->name;
        $result['profit'] = $request->sum('commission_sum');
        $result['count_deals'] = $request->count();
        $result['turnover_in'] = $request->sum('receiving_sum');
        $result['turnover_out'] = $request->sum('return_sum');

        return $result;
    }

    protected function getOfficeStatistic($data, $officeId)
    {
        $result = [];

        $request = Deal::whereDateBetween('deals.created_at', (new Carbon)->parse($data['start_interval'])->startOfDay()->toDateString(), (new Carbon)->parse($data['end_interval'])->startOfDay()->toDateString())
            ->join('work_days', 'deals.work_day_id', '=', 'work_days.id')
            ->join('office_days', 'work_days.office_day_id', '=', 'office_days.id')
            ->select('deals.*', 'work_days.office_day_id','office_days.office_id')
            ->where(['office_id' => $officeId])->get();

        $result['title'] = 'Офис - '. Office::find($officeId)->name;
        $result['profit'] = $request->sum('commission_sum');
        $result['count_deals'] = $request->count();
        $result['turnover_in'] = $request->sum('receiving_sum');
        $result['turnover_out'] = $request->sum('return_sum');
//        dump($result);
        return $result;
    }
}
