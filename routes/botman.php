<?php
use App\Http\Controllers\BotManController;

use App\Cookie;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('break cookie', function ($bot) {
    $cookie=Cookie::all()->random(1)->first();
    $bot->reply($cookie->message);
});
$botman->hears('create cookie {text}', function ($bot,$text) {
    $cookie = new Cookie();
    $cookie->message=$text;
    $cookie->save();
    $bot->reply("Cookie saved!");
});
$botman->hears('update cookie {id} with {text}', function ($bot,$id,$text) {
    $cookie=Cookie::find($id);
    if($cookie==null){
        $bot->reply("the cookie does not exists!");    
    }else{
        $cookie->message=$text;
        $cookie->save();
        $bot->reply("Cookie updated");
    }
});
$botman->hears('find cookie with {text}', function ($bot, $text) {
    $cookies = Cookie::where('message','LIKE',"%{$text}%")->get();
    if(count($cookies)==0){
        $bot->reply("I could not find cookies with that text");
        
    }else{
        $bot->reply("Cookie: ID");
        foreach($cookies as $cookie){
            $bot->reply("Cookie: ".$cookie->id);
        }
    }      
});
$botman->hears('delete cookie {id}', function ($bot, $id) {
    $control=Cookie::where('id','=',$id)->delete();
    if($control==0){
        $bot->reply("I could not find cookies with that id");    
    }else{
        $bot->reply("The cookie was deleted");
    }    
    /**
     $cookie = Cookie::find($id);
    if($cookie==null){
        $bot->reply("I could not find cookies with that id");    
    }else{
        $cookie->delete();
        $bot->reply("The cookie was deleted");
    }    
     */ 
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
