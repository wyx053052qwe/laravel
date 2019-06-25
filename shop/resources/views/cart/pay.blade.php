
@extends('layout.layout')
@section('title','订单页面')

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">
        <div class="maincont">
            <header>
                <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
                <div class="head-mid">
                    <h1>购物车</h1>
                </div>
            </header>
            <div class="head-top">
                <img src="{{asset('/layout/images/head.jpg')}}" />
            </div><!--head-top/-->
            <div class="dingdanlist" onClick="window.location.href='address.html'">
                <table>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
                        <td align="right"><img src="{{asset('/layout/images/jian-new.png')}}" /></td>
                    </tr>
                    <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
                        <td align="right"><img src="{{asset('/layout/images/jian-new.png')}}" /></td>
                    </tr>
                    <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">支付方式</td>
                        <td align="right"><span class="hui">网上支付</span></td>
                    </tr>
                    <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">优惠券</td>
                        <td align="right"><span class="hui">无</span></td>
                    </tr>
                    <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
                        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
                    </tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
                        <td align="right"><span class="hui">个人</span></td>
                    </tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">发票内容</td>
                        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
                    </tr>
                    <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="3">商品清单</td>
                    </tr>
                    @foreach($data as $g)
                        <?php $time=date('Y-h-d H:i:s',$g->create_time)?>
                        <tr class="ids" id="{{$g->goods_id}}">
                            <td class="dingimg" width="15%"><img src="/uploads/{{$g->goods_img}}" /></td>
                            <td width="50%">
                                <h3>{{$g->goods_name}}</h3>
                                <time>下单时间：{{$time}}</time>
                            </td>
                            <td align="right"><span class="qingdan">X {{$g->by_number}}</span></td>
                        </tr>
                        <tr>
                            <th colspan="3"><strong class="orange">{{$g->add_price}}</strong></th>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">商品金额</td>
                        <td align="right"><strong class="orange">¥{{$price}}</strong></td>
                    </tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
                        <td align="right"><strong class="green">¥0.00</strong></td>
                    </tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
                        <td align="right"><strong class="green">¥0.00</strong></td>
                    </tr>
                    <tr>
                        <td class="dingimg" width="75%" colspan="2">运费</td>
                        <td align="right"><strong class="orange">¥20.80</strong></td>
                    </tr>
                </table>
            </div><!--dingdanlist/-->


        </div><!--content/-->

        <div class="height1"></div>
        <div class="gwcpiao">
            <table>
                <tr>
                    <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                    <td width="50%">总计：<strong class="orange" id="price">{{$price}}</strong></td>
                    <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
                </tr>
            </table>
        </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('/layout/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('/layout/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/layout/js/style.js')}}"></script>
    <!--jq加减-->
    <script src="{{asset('/layout/js/jquery.spinner.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.spinnerExample').spinner({});
        $(document).on('click','.jiesuan',function(){
            var id='';
        $('.ids').each(function(){
            id +=','+$(this).attr('id');
        });
            var price=$('#price').html();
            $.post(
                    "{{url('/cart/addpay')}}",
                    {price:price,id:id},
                    function(res){
                        if(res.code==1){
                            alert(res.content);
                            location.href="{{url('/cart/success')}}?id="+res.id;
                        }else{
                            alert(res.content);
                            location.href="{{url('/cart/pay')}}";
                        }
                    },
                    'json'
            );
        })
    </script>
@endsection