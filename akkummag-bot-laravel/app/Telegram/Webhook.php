<?php

namespace App\Telegram;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Facades\Telegraph;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Stringable;


class Webhook extends WebhookHandler
{
    public function start():void{
        $this->chat->message("Вас приветствует бот магазина АККУМ-МАГ.👋\nБудем выбирать аккумулятор для вашего авто?🚗\n\n❗Бот не отвечает на ваши сообщения❌. Пользуйтесь меню на главной панели✅")->send();
        $this->mainPage();

    }
    //specific functions============================================================================
    public function mainPage():void{
        Telegraph::message("Сейчас вы находитесь на главной панели бота.🚩\nПользуйтесь меню ниже👇")
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Каталог📖')->action('catalog'),
                Button::make('Мы на карте города📍')->action('map'),
                Button::make('Частые Вопросы❓')->action('questions'),
                Button::make('Помощь🆘')->action('help'),
        ]))->send();
    }
    public function qPage():void{
        Telegraph::message("Надеемся, вы найдете ответ на ваш вопрос😊")
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Чем EFB-аккумуляторы лучше обычных❓')->action('q1'),
                Button::make('Почему отправляее через 100% предоплату❓')->action('q2'),
                Button::make('Через какие почтовые службы отправляете❓')->action('q3'),
                Button::make('Какой у вас график работы❓')->action('q4'),
                Button::make('А могу ли я забронить заказ и приехать забрать его сам❓')->action('q5'),
                Button::make('Если я не нашел нужный мне аккумулятор, что мне делать❓')->action('q6'),
                Button::make('Если я не нашел ответ на свой вопрос❓')->action('help'),
                Button::make('На главную↩')->action('mainPage'),
            ]))->send();
    }
     //==============================================================================================
    protected function handleChatMessage(Stringable $text): void{
        Telegraph::message("Извините, я не понимаю вас😥. Вернитесь на главную панель и воспользуйтесь кнопками или меню команд👊")
        ->keyboard(Keyboard::make()->buttons([
            Button::make('На главную↩')->action('mainPage'),
    ]))->send();

    }
    public function catalog():void{
        $this->chat->message("каталог")->send();

    }
    public function map():void{
        Telegraph::location(40.776676, -73.971321)->send();
        Telegraph::message("Локация нашего магазина в городе.\nРаботаем ПН-ВС | 00:00-24:00. Рады вам в любое время!😎")
        ->keyboard(Keyboard::make()->buttons([
            Button::make('На главную↩')->action('mainPage'),
    ]))->send();

    }
    public function questions():void{
        $this->chat->message("Ниже приведены наиболее частые вопросы наших покупателей👇👇👇")->send();
        $this->qPage();
    }
            public function q1():void{
                Telegraph::message("EFB-аккумуляторы быстрее традиционных кислотных батарей восстанавливают заряд в процессе эксплуатации. Также они способны перенести большее число глубоких разрядок, чем обычные кислотные аккумуляторы. Плюс обеспечивают в 2 раза больше циклов «разрадки-зарядки» без утраты функциональности😉")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }
            public function q2():void{
                Telegraph::message("Мы хотим быть 100% уверены в намерениях сделать клиентом заказ. При предоплате, на электронную почту клиента мы отправляем квитанцию, которая подтверждает его платеж и гарантирует ему доставку заказа😎")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }
            public function q3():void{
                Telegraph::message("Отправляем через такие почтовые службы🚚:\n- НОВАЯ ПОЧТА🔴\n- Деливери🟡\n- Meest Express🔵")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }
            public function q4():void{
                Telegraph::message("Мы обрабатываем заказы ПН-ВС | 10:00-20:00.\nМагазин работает ПН-ВС | 00:00-24:00. Рады вам в любое время!😎")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }
            public function q5():void{
                Telegraph::message("Да✅. При оформлении заказа, выберите пункт САМОВЫВОЗ. После оформления заказа, приходите в любое время к нам в магазин и мы вам передадим товар😉")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }
            public function q6():void{
                Telegraph::message("Не беда❗Вы можете:\n- Обратиться к нам в магазин🏪\n- Написать нам на email📧: akkummag@gmail.com\n- Позвонить нам в поддержку📞: +38(ХХХ)-ХХХ-ХХ-ХХ\n\n Мы поможем подобрать достойную альтернативу🔥")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('Другие вопросы❔')->action('qPage'),
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();
            }


    public function help():void{
        Telegraph::message("Возникли трудности❓\n- Пишите нам на email📧: akkummag@gmail.com\n- Звоните нам на номер📞: +38(ХХХ)-ХХХ-ХХ-ХХ\n\nМЫ ВАМ ПОМОЖЕМ❗️")
                    ->keyboard(Keyboard::make()->buttons([
                        Button::make('На главную↩')->action('mainPage'),
                    ]))->send();

    }


}