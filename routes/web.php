<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    throw new \App\Services\Telegram\Exeptions\TelegramBotApiException('123');
    return view('welcome');
});
