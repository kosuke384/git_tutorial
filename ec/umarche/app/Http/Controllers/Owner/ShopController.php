<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request,$next){
            $id=$request->route()->parameter('shop');
            if(!is_null($id)){
                $shopsOwnerId=Shop::findOrFail($id)->owner->id;
                $shopId=(int)$shopsOwnerId;
                $ownerId=Auth::id();
                if($shopId!==$ownerId){
                    abort(404);
                }
            }
            return $next($request);
        });
    }
    public function index()
    {
        //$ownerId=Auth::id();
        $shops=Shop::where('owner_id',Auth::id())->get();

        return view('owner.shops.index',compact('shops'));
    }

    public function edit(string $id)
    {
        $shop=Shop::findOrFail($id);
        return view('owner.shops.edit',compact('shop'));
    }

    public function update(Request $request, string $id)
    {
        $imageFile=$request->image;
        if(!is_null($imageFile)&&$imageFile->isValid()){
            Storage::putFile('public/shops',$imageFile);
        }
        return redirect()->route('owner.shops.index');
    }
}
