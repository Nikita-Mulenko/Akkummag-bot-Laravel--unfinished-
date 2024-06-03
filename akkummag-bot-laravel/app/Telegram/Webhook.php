<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;

class Webhook extends WebhookHandler
{
    public function start():void{
        $this->chat->message("Вас приветствует бот магазина АККУМ-МАГ.\nБудем выбирать аккумулятор для вашего авто?🚗\n\n❗Бот не отвечает на ваши сообщения❌. Пользуйтесь меню ниже👇")->send();
    }
    

}