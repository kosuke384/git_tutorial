<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Inertia\Inertia;
use Requests;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customer=Customer::searchCustomers($request->search)
        ->select('id','name','kana','tel')->paginate(50);
        return Inertia::render('Customers/index',[
            'customers'=>$customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $request->validate([
            'name'=>['required','max:20'],
            'kana'=>['required','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u','max:20'],
            'tel'=>['required','max:20','unique:customers,tel'],
            'email'=>['required','email','max:255','unique:customers,email'],
            'postcode'=>['required','max:7'],
            'address'=>['required','max:100'],
            'birthday'=>['date'],
            'gender'=>['required'],
            'memo'=>['max:1000'],
        ]);

        Customer::create([
            'name'=>$request->name,
            'kana'=>$request->kana,
            'tel'=>$request->tel,
            'email'=>$request->email,
            'postcode'=>$request->postcode,
            'address'=>$request->address,
            'birthday'=>$request->birthday,
            'gender'=>$request->gender,
            'memo'=>$request->memo
        ]);

        return to_route('customers.index')
        ->with([
            'message'=>'登録しました',
            'status'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
