@extends('layout.layout')
@section('title','商品列表页')

@section('body')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <form action="#" method="get" class="prosearch"><input type="text" /></form>
        </div>
    </header>
    <ul class="pro-select">
        <li class="pro-selCur"><a href="javascript:;">新品</a></li>
        <li><a href="javascript:;">销量</a></li>
        <li><a href="javascript:;">价格</a></li>
    </ul><!--pro-select/-->
    @foreach($goods_info as $g)
    <div class="prolist">
        <dl>
            <dt><a href="{{url('index/proinfo')}}?id={{$g->goods_id}}"><img src="/uploads/{{$g->goods_img}}" width="100" height="100" /></a></dt>
            <dd>
                <h3><a href="{{url('index/proinfo')}}?id={{$g->goods_id}}">{{$g->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$g->goods_price}}</strong> <span>¥{{$g->shop_price}}</span></div>
            </dd>
            <div class="clearfix"></div>
        </dl>

            <div class="clearfix"></div>
        </dl>
    </div><!--prolist/-->
    @endforeach
    <div class="height1"></div>
    <div class="footNav">
        <dl>
            <a href="{{url('/')}}">
                <dt><span class="glyphicon glyphicon-home"></span></dt>
                <dd>微店</dd>
            </a>
        </dl>
        <dl class="ftnavCur">
            <a href="{{url('index/prolist')}}">
                <dt><span class="glyphicon glyphicon-th"></span></dt>
                <dd>所有商品</dd>
            </a>
        </dl>
        <dl>
            <a href="{{url('/cart/buycar')}}">
                <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
                <dd>购物车 </dd>
            </a>
        </dl>
        <dl>
            <a href="{{url('/index/user')}}">
                <dt><span class="glyphicon glyphicon-user"></span></dt>
                <dd>我的</dd>
            </a>
        </dl>
        <div class="clearfix"></div>
    </div><!--footNav/-->
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('/layout/js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('/layout/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/layout/js/style.js')}}"></script>
<!--焦点轮换-->
<script src="{{asset('/layout/js/jquery.excoloSlider.js')}}"></script>
<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>
</body>
@endsection