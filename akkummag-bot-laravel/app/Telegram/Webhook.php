<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Support\Stringable;

class Webhook extends WebhookHandler
{
    public function start():void{
        //$this->chat->message("Вас приветствует бот магазина АККУМ-МАГ.\nБудем выбирать аккумулятор для вашего авто?🚗\n\n❗Бот не отвечает на ваши сообщения❌. Пользуйтесь меню ниже👇")->send();
    
        Telegraph::message("Вас приветствует бот магазина АККУМ-МАГ.\nБудем выбирать аккумулятор для вашего авто?🚗\n\n❗Бот не отвечает на ваши сообщения❌. Пользуйтесь меню ниже👇")
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Каталог📖')->action('catalog'),
                Button::make('Мы на карте города📍')->action('map'),
                Button::make('Частые Вопросы❓')->action('questions'),
                Button::make('Помощь🆘')->action('help'),
        ]))->send();

    }
    protected function handleChatMessage(Stringable $text): void{
        Telegraph::message("Извините, я не понимаю вас😥. Воспользуйтесь кнопками ниже или меню команд👊")
        ->keyboard(Keyboard::make()->buttons([
            Button::make('Каталог📖')->action('catalog'),
            Button::make('Мы на карте города📍')->action('map'),
            Button::make('Частые Вопросы❓')->action('questions'),
            Button::make('Помощь🆘')->action('help'),
    ]))->send();
    }

    public function catalog():void{
        $this->chat->message("каталог")->send();
    }
    public function map():void{
        $this->chat->message("карта")->send();
    }
    public function questions():void{
        $this->chat->message("вопросы")->send();
    }
    public function help():void{
        $this->chat->message("помощь")->send();
    }


}