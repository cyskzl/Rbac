@extends('admin.layouts.public')
@section('css')
    @parent
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
@endsection
@section('content')
    <div class="layui-layout layui-layout-admin">
    <div class="layui-header header header-demo">
        <div class="layui-main">
            <a class="logo" href="{{route('admin.home')}}">
                后台管理
            </a>
            <ul class="layui-nav" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">admin</a>
                    <dl class="layui-nav-child"> <!-- 二级菜单 -->
                        <dd><a href="">个人信息</a></dd>
                        <dd><a href="">切换帐号</a></dd>
                        <dd><a href="./login.html">退出</a></dd>
                    </dl>
                </li>
                <!-- <li class="layui-nav-item">
                  <a href="" title="消息">
                      <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                  </a>
                  </li> -->
                <li class="layui-nav-item x-index"><a href="/">前台首页</a></li>
            </ul>
        </div>
    </div>
    <div class="layui-side layui-bg-black x-side">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                <li class="layui-nav-item">
                    <a class="javascript:;" href="javascript:;">
                        <i class="layui-icon" style="top: 3px;">&#xe613;</i><cite>管理员管理</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd class="">
                            <a href="javascript:;" _href="{{route('admin_user.index')}}">
                                <cite>管理员列表</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./admin-role.html">
                                <cite>角色管理</cite>
                            </a>
                        </dd>
                        <dd class="">
                            <a href="javascript:;" _href="./admin-rule.html">
                                <cite>权限管理</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item" style="height: 30px; text-align: center">
                </li>
            </ul>
        </div>

    </div>
    <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
        <div class="x-slide_left"></div>
        <ul class="layui-tab-title">
            <li class="layui-this">
                我的桌面
                <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
            </li>
        </ul>
        <div class="layui-tab-content site-demo site-demo-body">
            <div class="layui-tab-item layui-show">
                <iframe frameborder="0" src="{{url('admin/welcome')}}" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
    <div class="site-mobile-shade">
    </div>
</div>
@endsection