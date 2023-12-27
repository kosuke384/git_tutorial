<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    public function showServiceProviderTest(){
        $encrypt=app()->make('encrypter');
        $password=$encrypt->encrypt('password');

        $sample=app()->make('serviceproviderTest');


        dd($sample,$password,$encrypt->decrypt($password));
    }

    public function showServiceContainerTest(){
        app()->bind('lifeCycleTest',function(){
            return 'テスト';
        });

        $test=app()->make('lifeCycleTest');

        //サービスコンテナ無し
        //$message=new Message();
        //$sample=new Sample($message);
        //$sample->run();

        //サービスコンテナあり
        app()->bind('sample',Sample::class);
        $sample=app()->make('sample');
        $sample->run();
        dd($test,app());
    }
}

class Sample{
    public $message;
    public function __construct(Message $message){
        $this->message=$message;
    }
    public function run(){
        $this->message->send();
    }
}

class Message{
    public function send(){
        echo('メッセージ');
    }
}
