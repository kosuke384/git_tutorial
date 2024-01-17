<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Items/index',[
            'items'=>Item::select('id','name','price','is_selling')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Items/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $request->validate([
            'name'=>['required','max:20'],
            'memo'=>['required'],
            'price'=>['required','numeric']
        ]);

        Item::create([
            'name'=>$request->name,
            'memo'=>$request->memo,
            'price'=>$request->price,
        ]);

        return to_route('items.index')
        ->with([
            'message'=>'登録しました。',
            'status'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return Inertia::render('Items/show',[
            'item'=>$item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return Inertia::render('Items/edit',[
            'item'=>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->name=$request->name;
        $item->memo=$request->memo;
        $item->price=$request->price;
        $item->is_selling=$request->is_selling;
        $item->save();

        return to_route('items.index')
        ->with([
            'message'=>'登録しました。',
            'status'=>'success'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return to_route('items.index')
        ->with([
            'message'=>'削除しました。',
            'status'=>'danger'
        ]);
    }
}
