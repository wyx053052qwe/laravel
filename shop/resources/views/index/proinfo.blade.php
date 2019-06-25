
@extends('layout.layout')
@section('title','商品详情页')

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="maincont">

        <header>
            <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
            <div class="head-mid">
                <h1>产品详情</h1>
            </div>
        </header>

        <div id="sliderA" class="slider" status="{{$goodsinfo->goods_num}}" price="{{$goodsinfo->goods_price}}" ids="{{$goodsinfo->goods_id}}">

            <img src="/uploads/{{$goodsinfo->goods_img}}" />

        </div><!--sliderA/-->
        <table class="jia-len">
            <tr>
                <th><strong class="orange">{{$goodsinfo->goods_price}}</strong></th>
                <td>
                    <a href="javascript:;" class="decreas" >-</a>
                    <input type="text" class="spinner" value="1" style="width:30px;height:20px;" />
                    <a href="javascript:;" class="increas">+</a>

                </td>
            </tr>
            <tr>
                <td>
                    <strong>{{$goodsinfo->goods_name}}</strong>
                    <p class="hui">{{$goodsinfo->content}}</p>
                </td>
                <td align="right">
                    <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
                </td>
            </tr>
        </table>
        <table class="jrgwc">
            @csrf
            <tr>
                <th>
                    <a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
                </th>
                <td><a href="javascript:;" class="submit">加入购物车</a></td>
            </tr>
        </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/layout/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/layout/js/bootstrap.min.js"></script>
    <script src="/layout/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/layout/js/jquery.excoloSlider.js"></script>
    <script>
        $(function () {
            $("#sliderA").excoloSlider();
        });
    </script>
    <!--jq加减-->
    <script src="/layout/js/jquery.spinner.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.spinnerExample').spinner({});
        //点击加号
        $(document).on('click','.increas',function(){
            var num=$('.spinner').val();
            var status=$('.slider').attr('status');
            var price= $('.slider').attr('price');
            var status=parseInt(status);
            if(num>=status){
                alert('兄弟库存不够了');
            }else{
                var num=parseInt(num)+1;

            }
            $('.spinner').val(num);
            var total=checkPrice(num,price);
            $('.orange').html(total);
            checkPrice();
        })
        //点击减号
        $(document).on('click','.decreas',function(){
            var num=$('.spinner').val();
            var price= $('.slider').attr('price');
            if(num<=1){
                alert('至少买一件');
            }else{
                var num=parseInt(num)-1;
            }
            $('.spinner').val(num);
            var total=checkPrice(num,price);
            $('.orange').html(total);
            checkPrice();
        })

        //失焦事件
        $(document).on('blur','.spinner',function(){
            var num=$('.spinner').val();
            var num=parseInt(num);
            var price= $('.slider').attr('price');
            var status=$('#sliderA').attr('status');
            var status=parseInt(status);
            if(num<=1){
                alert('至少买一件');
            }else if(num>=status){
                alert('超过库存了');
                $('.spinner').val(status);
            }else if(isNaN(num)){
                $('.spinner').val(1);
            }else{
                $('.spinner').val(num);
            }
            var num= $('.spinner').val();

            var total=checkPrice(num,price);
            $('.orange').html(total);
            checkPrice();

        })

        //计算商品总价
        function checkPrice(num,price)
        {
            var total=parseInt(num*price);
            return total;
        }
        // 提交
        $(document).on('click','.submit',function(){
            var goods_id=$('.slider').attr('ids');
            var goods_num=$('.spinner').val();
            $.post(
                    "{{url('cart/buycart')}}",
                    {goods_id:goods_id,goods_num:goods_num},
                    function(res){
                        if(res.code==1){
                            alert(res.content);
                            location.href="{{url('/cart/buycar')}}";
                        }else if(res.code==2){
                            alert(res.content);
                            location.href="{{url('/index/proinfo')}}"
                        }else{
                            alert(res.content);
                            location.href="{{url('/login/login')}}"
                        }
                    },
                    'json'
            )
        })
    </script>
@endsection
