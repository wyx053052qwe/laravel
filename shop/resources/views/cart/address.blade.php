@extends('layout.layout')
@section('title','我的页面')

@section('body')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>收货地址</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="{{asset('/layout/images/head.jpg')}}" />
    </div><!--head-top/-->
    <form action="login.html" method="get" class="reg-login">
        <div class="lrBox">
            <div class="lrList"><input type="text" placeholder="收货人" /></div>
            <div class="lrList"><input type="text" placeholder="详细地址" /></div>
            <div class="lrList">
                <select>
                    <option>省份/直辖市</option>
                </select>
            </div>
            <div class="lrList">
                <select>
                    <option>区县</option>
                </select>
            </div>
            <div class="lrList">
                <select>
                    <option>详细地址</option>
                </select>
            </div>
            <div class="lrList"><input type="text" placeholder="手机" /></div>
            <div class="lrList2"><input type="text" placeholder="设为默认地址" /> <button>设为默认</button></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="保存" />
        </div>
    </form><!--reg-login/-->

    <div class="height1"></div>
    <div class="footNav">
        <dl>
            <a href="{{url('/')}}">
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
        <dl class="ftnavCur">
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
<!--jq加减-->
<script src="{{asset('/layout/js/jquery.spinner.js')}}"></script>
<script>
    $('.spinnerExample').spinner({});
</script>
@endsection