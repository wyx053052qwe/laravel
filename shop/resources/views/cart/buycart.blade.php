
@extends('layout.layout')
@section('title','商品详情页')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('body')
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
        <table class="shoucangtab">
            <tr>
                <td width="75%"><span class="hui">购物车共有：<strong class="orange"></strong>件商品</span></td>
                <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
                    <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
                </td>
            </tr>
        </table>

        <div class="dingdanlist">
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" class="check" /> 全选</a></td>
            </tr>
            @foreach($goodsinfo as $c)
                <?php $time=date('Y-h-d H:i:s',$c->create_time)?>
                <table>

                    <tr>
                        <td width="4%"><input type="checkbox" name="1" class="che" checked id="{{$c->goods_id}}"/></td>
                        <td class="dingimg" width="15%"><img src="/uploads/{{$c->goods_img}}" /></td>
                        <td width="50%">
                            <h3>{{$c->goods_name}}</h3>
                            <time>{{$time}}</time>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4"><strong class="orange">{{$c->add_price}}</strong></th>
                    </tr>
                </table>
            @endforeach
        </div><!--dingdanlist/-->

        <div class="dingdanlist">
            <tr>
                <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
            </tr>
            </table>
        </div><!--dingdanlist/-->
        <div class="height1"></div>
        <div class="gwcpiao">
            <table>
                <tr>
                    <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
                    <td width="50%">总计：<strong class="orange">¥{{$price}}</strong></td>
                    <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
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
        $(document).on('click','.check',function(){
            var ch=$('.check').prop('checked');
            if(ch==true){
                $('.che').prop('checked',true);
            }else{
                $('.che').prop('checked',false);
            }
        })
        $(document).on('click','.jiesuan',function(){
            var  goods_id='';
            $('.che').each(function() {
                if ($(this).prop('checked')) {
                    goods_id += ',' + $(this).attr('id');
                }
            })
            goods_id= goods_id.substr(1,goods_id.length);
            $.post(
                    "{{url('/cart/dopay')}}",
                    function(res){
//                    alert(res)
                        if (res == 1) {
                            location.href = "{{url('/cart/pay')}}?goods_id="+goods_id;
                        } else if (res == 2) {
                            alert('请登录后结算');
                            location.href = "{{url('login/login')}}";
                        }
                    }
            )
        })
    </script>
@endsection