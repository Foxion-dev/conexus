<?php

namespace App\Components;

use App\Models\Logger;

class Log
{

    public $message;
    public $log;

    public function __construct($user, $action, $model, $elementId, $data = [])
    {
        $this->message = $this->constructMessage($user, $action, $model, $elementId);
        $this->log = $this->createLog($user, $action, $model, $elementId, $this->message, $data);
    }

    public function createLog($user, $action, $model, $elementId, $message, $data)
    {
        return Logger::create([
            'user_id' => $user->id,
            'action' => $action,
            'model_name' => $model,
            'element_id' => $elementId,
            'message' => $message,
            'data' => json_encode($data) ?? ''
        ]);

    }
    public function constructMessage($user, $action, $model, $elementId)
    {
        $message = 'Пользователь ' . $user->name . ' ';
        switch ($action){
            case 'add':
                $message .= 'добавил ';
                break;
            case 'update':
                $message .= 'изменил ';
                break;
            case 'delete':
                $message .= 'удалил ';
                break;
            default:
                $message .= 'что-то сделал ';
                break;
        }
        $message .= 'элемент, id - ' . $elementId . ' ';

        switch ($model){
            case 'source':
                $message .= '(источник клиента)';
                break;
            case 'deal':
                $message .= '(сделка)';
                break;
            case 'client':
                $message .= '(клиент)';
                break;
            case 'commission':
                $message .= '(коммиссия)';
                break;
            case 'encashment':
                $message .= '(инкассация)';
                break;
            case 'exchangeRates':
                $message .= '(курс валют)';
                break;
            case 'expense':
                $message .= '(расходы)';
                break;
            case 'leftovers':
                $message .= '(остатки)';
                break;
            case 'officeDay':
                $message .= '(офисный день)';
                break;
            case 'requestMoney':
                $message .= '(запрос средств)';
                break;
            case 'user':
                $message .= '(пользователь)';
                break;
            case 'workDay':
                $message .= '(рабочий день)';
                break;
            default:
                $message .= '(что-то)';
                break;
        }

        return $message;
    }
}
