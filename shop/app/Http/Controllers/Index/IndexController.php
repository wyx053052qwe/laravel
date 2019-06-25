<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $goods_info=DB::table('shop_goods')->limit(5)->get();
        $date=DB::table('shop_goods')->where('brand_id',1)->limit(10)->get();
        return view('index.index',['data'=>$goods_info,'date'=>$date]);
    }
    public function proinfo(Request $request)
    {
        $data=$request->all();
        $goodsinfo=DB::table('shop_goods')->where('goods_id',$data['id'])->first();
//    dd($goodsinfo);
        return view('index.proinfo',['goodsinfo'=>$goodsinfo]);
    }
    public function prolist()
    {
        $goods_info=DB::table('shop_goods')->get();
        return view('index.prolist',['goods_info'=>$goods_info]);
    }
    public function user()
    {
        return view('/index/user');
    }
}
