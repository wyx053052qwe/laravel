
@extends('layout.layout')
@section('title','首页')

@section('body')
    <div class="maincont">
        <div class="head-top">
            <img src="{{asset('/layout/images/head.jpg')}}" />
            <dl>
                <dt><a href="user.html"><img src="{{asset('/layout/images/touxiang.jpg')}}" /></a></dt>
                <dd>
                    <h2 class="username">三级分次奥</h2>
                    <ul>
                        <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
                        <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
                        <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
                        <div class="clearfix"></div>
                    </ul>
                </dd>
                <div class="clearfix"></div>
            </dl>
        </div><!--head-top/-->
        <form action="#" method="get" class="search">

            <ul class="reg-login-click">
                @if(session('id'))
                    欢迎{{session('name')}} 登录<li><a href="{{url('login/logout')}}">退出</a></li>
                @else
                    <li><a href="{{url('login/login')}}">登录</a></li>
                    <li><a href="reg.html" class="rlbg">注册</a></li>
                @endif
                <div class="clearfix"></div>
            </ul><!--reg-login-click/-->
            <input type="text" class="seaText fl" />
            <input type="submit" value="搜索" class="seaSub fr" />
        </form><!--search/-->

        <div id="sliderA" class="slider">
            @foreach($data as $g)
                <img src="/uploads/{{$g->goods_img}}" />
            @endforeach
        </div><!--sliderA/-->
        <ul class="pronav">
            @foreach($data as $g)
                <li><a href="{{url('index/proinfo')}}?id={{$g->goods_id}}">{{$g->goods_name}}</a></li>
            @endforeach


            <div class="clearfix"></div>

        </ul><!--pronav/-->
        <div class="index-pro1">
            @foreach($date as $b)
                <div class="index-pro1-list">
                    <dl>
                        <dt><a href="{{url('index/proinfo')}}?id={{$b->goods_id}}"><img src="/uploads/{{$b->goods_img}}"/></a></dt>
                        <dd class=""><a href="{{url('index/proinfo')}}">{{$b->goods_name}}</a><span>已售：488</span></dd>
                        <dd class="ip-price"><strong>{{$b->goods_price}}</strong> <span>{{$b->shop_price}}</span></dd>
                    </dl>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div><!--index-pro1/-->
        <div class="joins"><a href="fenxiao.html"><img src="{{asset('/layout/images/jrwm.jpg')}}" /></a></div>
        <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

        <div class="height1"></div>
        <div class="footNav">
            <dl>
                <a href="{{url('/index/index')}}">
                    <dt><span class="glyphicon glyphicon-home"></span></dt>
                    <dd>微店</dd>
                </a>
            </dl>
            <dl>
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
@endsection


