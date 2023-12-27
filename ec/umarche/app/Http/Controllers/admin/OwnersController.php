<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner;//エロクアント
use Illuminate\Support\Facades\DB;//クエリビルダー
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Models\Shop;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    public function index()
    {
        // $date_now=Carbon::now();
        // $date_patse=Carbon::parse(now());
        // echo $date_now;
        // echo $date_patse;
        // $e_all=Owner::all();
        // $q_all=DB::table('owners')->select('name','created_at')->get();
        // $q_first=DB::table('owners')->select('name')->first();
        // $c_test=collect([
        //     'name'=>'test'
        // ]);
        // var_dump($q_first);
        // dd($e_all,$q_all,$q_first,$c_test);
        $owners=Owner::select('id','name','email','created_at')->paginate(3);

        return view('admin.owners.index',compact('owners'));
        return view('admin.owners.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed'],
        ]);

        try{
            $owner=Owner::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Shop::create([
                'owner_id'=>$owner->id,
                'name'=>'店名を入力してください',
                'information'=>'',
                'filename'=>'',
                'is_selling'=>true
            ]);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message'=>'オーナー情報を登録しました',
            'status'=>'info'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $owner=Owner::findOrFail($id);
        // dd($owner);
        return view('admin.owners.edit',compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $owner=Owner::FindOrFail($id);
        $owner->name=$request->name;
        $owner->email=$request->email;
        $owner->password=Hash::make($request->password);
        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message'=>'オーナー情報を編集しました',
            'status'=>'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Owner::FindOrFail($id)->delete();

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message'=>'オーナー情報を削除しました',
            'status'=>'alert'
        ]);

        
    }

    public function expiredOwnerIndex(){
            $expiredOwners=Owner::onlyTrashed()->get();
            return view('admin.expired-owners',compact('expiredOwners'));
    }

    public function expiredOwnersDestroy($id){
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return view('admin.expired-owners.index');
    }
}
