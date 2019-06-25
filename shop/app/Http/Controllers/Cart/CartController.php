<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function buycart(Request $request)
    {
        $data = $request->all();
        if(empty($data['goods_id'])){
            echo ("<script>alert('选择商品添加购物车');location.href='/'</script>");
        }else{
            $res = DB::table('shop_cart')->where('goods_id', $data['goods_id'])->first();
//        dd($res);
            $goods = DB::table('shop_goods')->where('goods_id', $data['goods_id'])->first();
            $by_number = $data['goods_num'];
//        dd($storem);
//dd(session('id'));
            if (!empty(session('id'))) {
                if (empty($res)) {
                    if ($by_number >= $goods->goods_num) {
                        echo('买的太多了啊');die();
                    } else {
                        $add_price = $goods->goods_price * $by_number;
                        $user_id = session('id');
                        $ress = DB::table('shop_cart')->insert([
                            'goods_id' => $data['goods_id'],
                            'by_number' => $by_number,
                            'user_id' => $user_id,
                            'add_price' => $add_price,
                            'create_time' => time(),
                        ]);
                        if ($ress) {
                            echo json_encode(['content'=>'添加成功','code'=>1]);
                        } else {
                            echo json_encode(['content'=>'添加失败','code'=>2]);
                        }
                    }
                } else {
                    //修改数据
                    $storem = $res->by_number + $data['goods_num'];
                    if ($storem >= $goods->goods_num) {
                        echo('买的太多了');
                    } else {
                        $add_price = $goods->goods_price * $storem;
                        $user_id = session('id');
                        $ress = DB::table('shop_cart')->where('goods_id', $data['goods_id'])->update([
                            'goods_id' => $data['goods_id'],
                            'by_number' => $storem,
                            'user_id' => $user_id,
                            'add_price' => $add_price,
                            'create_time' => time(),
                        ]);
                        if ($ress) {
                            echo json_encode(['content'=>'添加成功','code'=>1]);
                        } else {
                            echo json_encode(['content'=>'添加失败','code'=>2]);
                        }
                    }
                }
            } else {
                echo json_encode(['content'=>'请登录后添加']);
            }
            //添加到cookie
//            $goodsinfo =Cookie::get('goods_info');
//            $goodsinfo=unserialize(base64_decode($goodsinfo));
////           dump($goodsinfo);
//            if (empty($goodsinfo)) {
//                $add_price = $goods->goods_price * $by_number;
//                if ($by_number >= $goods->goods_num) {
//                    echo('买的太多了啊');
//                } else {
//                    $datainfo[]=[
//                        'goods_id' => $data['goods_id'],
//                        'by_number' => $by_number,
//                        'add_price' => $add_price,
//                    ];
//                    $datainfo=base64_encode(serialize($datainfo));
//                    Cookie::queue('goods_info',$datainfo) ;
//                    echo('添加购物车成功');
//                }
//            } else {
//                $floge=0;
//                foreach($goodsinfo as $k=>$v){
//                    if ($v['by_number']+$data['goods_num'] >= $goods->goods_num) {
//                        echo('买的太多了啊');
//                    } else {
//                        if($v['goods_id']==$data['goods_id']){
//                            $goodsinfo[$k] = [
//                                'goods_id' => $data['goods_id'],
//                                'by_number' => $data['goods_num'] + $v['by_number'],
//                                'add_price' =>($data['goods_num'] + $v['by_number']) * $goods->goods_price
//                            ];
//                            $goodsinfo = base64_encode(serialize($goodsinfo));
//                            Cookie::queue('goods_info', $goodsinfo);
//                            echo('添加购物车成功le');die();
//                        }else{
//                            $floge=1;
//                        }
//                    }
//                }
//                if($floge==1){
//                    $aaa=$data['goods_num']*$goods->goods_price;
//                    $goodsinfo[]=[
//                        'goods_id' => $data['goods_id'],
//                        'by_number' => $data['goods_num'],
//                        'add_price' =>$aaa ,
//                    ];
//                    $goodsinfo=base64_encode(serialize($goodsinfo));
//                    Cookie::queue('goods_info',$goodsinfo) ;
//                    echo('添加购物车成功a');
//                }
//            }
//        }
        }

    }
    public function buycar(Request $request)
    {
        $cartinfo=DB::table('shop_cart')->get()->toArray();
        foreach($cartinfo as $k=>$v){
            $goods_id[]=$v->goods_id;
        }
        if(empty(session('id'))){
            echo ("<script>alert('请登录');location.href='/'</script>");
//            return \redirect('/index/index');
        }else{
            if(empty($v->goods_id)) {
                echo("<script>alert('请选择商品添加购物车');location.href='/'</script>");
            }else{
                $goodsinfo=DB::table('shop_goods')->whereIN('shop_goods.goods_id',$goods_id)->join('shop_cart', 'shop_cart.goods_id', '=', 'shop_goods.goods_id')->get()->toArray();
//        dd($goodsinfo);
                $price = 0;
                foreach ($goodsinfo as $k => $v) {
                    $price += $v->add_price;
                }

            }
            return view('cart.buycart',['goodsinfo'=>$goodsinfo,'price'=>$price]);
        }

    }
    public function pay(Request $request){
        $goods_id=$request->all();
        $goods_id=$goods_id['goods_id'];
        $goods_id=explode(',',$goods_id);
//        dd($goods_id);
        $data=DB::table('shop_goods')->whereIN('shop_goods.goods_id',$goods_id)->join('shop_cart', 'shop_cart.goods_id', '=', 'shop_goods.goods_id')->get();
//        dd($data);
        $price = 0;
        foreach ($data as $k => $v) {
            $price += $v->add_price;
        }
        return view('cart.pay',['data'=>$data,'price'=>$price]);
    }
    public function address()
    {
        return view('cart.address');
    }
    //检测是否登录
    public function dopay()
    {
        if (!empty(session('id'))){
            echo 1;
        } else {
            echo 2;
        }
    }
    public function addpay(Request $request)
    {
        $data=$request->all();
        $price=$data['price'];
        $goods_id=$data['id'];
        $goods_id=trim($goods_id,',');
        $goods_id=explode(',',$goods_id);
//        dd($goods_id);
        $user_id=session('id');
        $goods=DB::table('shop_goods')->whereIN('shop_goods.goods_id',$goods_id)->join('shop_cart', 'shop_cart.goods_id', '=', 'shop_goods.goods_id')->get()->toArray();
        $total=0;
        foreach($goods as $k=>$v){
            $total +=$v->add_price;
            $res=DB::table('shop_goods')->whereIN('goods_id',$goods_id)->update(['goods_num'=>$v->goods_num-$v->by_number]);
        }

        $res=DB::table('shop_cart')->whereIN('goods_id',$goods_id)->where('user_id',$user_id)->delete();
        $number = time() . mt_rand('10000', '99999') . $user_id;
//        $orderInfo=;
        $goods_id=implode(',',$goods_id);
        $re = DB::table('shop_order')->insertGetId([
            'goods_id' => $goods_id,
            'user_id' => $user_id,
            'order_no' => $number,
            'order_amount' => $total,
            'pay_status'=>2
        ]);

        if($re){
            echo json_encode(['content'=>'下单成功','code'=>1,'id'=>$re]);
        }else{
            echo json_encode(['content'=>'下单失败','code'=>2]);
        }
    }
    public function success(Request $request)
    {
        $ddd=$request->all();
        $id=$ddd['id'];
        $data=DB::table('shop_order')->where('order_id',$id)->first();
        return view('cart.success',['data'=>$data]);
    }

}