<?php

namespace App\Components;

use App\Models\Logger;

class Log
{
    public function __construct($user, $action, $model, $elementId)
    {

        $message = $this->constructMessage($user, $action, $model, $elementId);

        Logger::create([
            'user_id' => $user->id,
            'action' => $action,
            'model_name' => $model,
            'element_id' => $elementId,
            'message' => $message
        ]);
    }

    public function constructMessage($user, $action, $model, $elementId)
    {
        $message = 'Пользователь ' . $user->name . ' ';
        switch ($action){
            case 'add':
                $message .= 'добавил';
                break;
            case 'update':
                $message .= 'изменил';
                break;
            case 'delete':
                $message .= 'удалил';
                break;
            default:break;
        }

        return $message;
    }
}
