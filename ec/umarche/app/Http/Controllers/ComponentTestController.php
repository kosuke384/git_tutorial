<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    public function showComponent1(){
        $title="変数タイトル1";
        return view('tests.component-test1',compact('title'));
    }

    public function showComponent2(){
        return view('tests.component-test2');
    }
}
