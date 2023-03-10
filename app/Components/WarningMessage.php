<?php

namespace App\Components;

use App\Models\User;
use GuzzleHttp\Client;

class WarningMessage
{
    protected $botToken = '5899265693:AAGisqUFeRnDsT_nwFKUPGmNHEhEZmRDsGc';
    protected $groupId = '-1001837252585';
    protected $url;
    public $message;
    public $client;

    public function __construct()
    {
        $this->url = 'https://api.telegram.org/bot' . $this->botToken . '/sendMessage';

        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout'  => 10,
            'verify' => false
        ]);
    }

    public function setData()
    {

    }

    public function setMessage($workDay, $data)
    {
        $currentUser = $workDay->user;
        $officeDay = $workDay->officeDay;
        $office = $officeDay->office;

        $this->message = "Внимание! Обнаружено несоответствие" . "\n".
        "<b>Пользователь: </b>" . $currentUser->name. "\n".
        "<b>Офис: </b>" . $office->name. "\n".
        "<b>Остатки USD: </b>"  . "Факт - " . $data["usd_fact"] . " | В CRM -". $officeDay->leftovers->USD. "\n".
        "<b>Остатки USDT: </b>" . "Факт - " . $data["usdt_fact"] . " | В CRM -". $officeDay->leftovers->USDT. "\n".
        "<b>Остатки GEL: </b>"  . "Факт - " . $data["gel_fact"] . " | В CRM -". $officeDay->leftovers->GEL. "\n".
        "<b>Остатки KZT: </b>"  . "Факт - " . $data["kzt_fact"] . " | В CRM -". $officeDay->leftovers->KZT. "\n".
            "<b>Комментарий: </b>" . ($data["comment"] ?? "-")
        ;
    }

    public function sendMessage()
    {
        try{
            $response = $this->client->request('POST', $this->url, [
                'form_params' => [
                    'chat_id' => $this->groupId,
                    'parse_mode' => 'html',
                    'text' => $this->message,
                ]
            ]);

            return $response->getStatusCode();
        }catch (\Exception $error){
            return 500;
        }
    }
}
