@extends('admin.layouts.public')
@section('content')
    <div class="x-nav">
            <span class="layui-breadcrumb">
              <a><cite>首页</cite></a>
              <a><cite>会员管理</cite></a>
              <a><cite>管理员列表</cite></a>
            </span>
        <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
        <form class="layui-form x-center" action="" style="width:80%">
            <div class="layui-form-pane" style="margin-top: 15px;">
                <div class="layui-form-item">
                    <label class="layui-form-label">日期范围</label>
                    <div class="layui-input-inline">
                        <input class="layui-input" placeholder="开始日" id="LAY_demorange_s">
                    </div>
                    <div class="layui-input-inline">
                        <input class="layui-input" placeholder="截止日" id="LAY_demorange_e">
                    </div>
                    <div class="layui-input-inline">
                        <input type="text" name="username"  placeholder="请输入登录名" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width:80px">
                        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                    </div>
                </div>
            </div>
        </form>
        <xblock>
            <button class="layui-btn" onclick="admin_add('添加用户','{{route('admin_user.create')}}','600','500')">
                <i class="layui-icon">&#xe608;</i>添加
            </button>
            <span class="x-right" style="line-height:40px">共有数据：88 条</span>
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th>用户名</th>
                <th>邮箱</th>
                <th>超级管理员</th>
                <th>所属角色</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($adminUsers as $adminUser)
            <tr>
                <td>{{$adminUser->name}}</td>
                <td>{{$adminUser->email}}</td>
                <td >{{$adminUser->is_super}}</td>
                <td ></td>
                <td >{{$adminUser->created_at}}</td>
                <td class="td-manage">
                    <a title="编辑" href="javascript:;" onclick="admin_edit('编辑','{{route('admin_user.edit', ['id' => $adminUser->id])}}','4','','510')"
                       class="ml-5" style="text-decoration:none">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="admin_del(this,'{{$adminUser->id}}')"
                       style="text-decoration:none">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div id="page"></div>
    </div>
@endsection()
@section('javascript')
    @parent
    <script src="{{asset('adminStyle/js/x-layui.js')}}"></script>
    <script src="{{asset('adminStyle/js/x-ajax.js')}}"></script>
    <script>
        layui.use(['laydate','element','laypage','layer'], function(){
            $ = layui.jquery;//jquery
            laydate = layui.laydate;//日期插件
            lement = layui.element();//面包导航
            laypage = layui.laypage;//分页
            layer = layui.layer;//弹出层

            //以上模块根据需要引入

            laypage({
                cont: 'page'
                ,pages: 100
                ,first: 1
                ,last: 100
                ,prev: '<em><</em>'
                ,next: '<em>></em>'
            });

            var start = {
                min: laydate.now()
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            };

            var end = {
                min: laydate.now()
                ,max: '2099-06-16 23:59:59'
                ,istoday: false
                ,choose: function(datas){
                    start.max = datas; //结束日选好后，重置开始日的最大日期
                }
            };

            document.getElementById('LAY_demorange_s').onclick = function(){
                start.elem = this;
                laydate(start);
            }
            document.getElementById('LAY_demorange_e').onclick = function(){
                end.elem = this
                laydate(end);
            }

        });

        /*添加*/
        function admin_add(title,url,w,h){
            x_admin_show(title,url,w,h);
        }

        //编辑
        function admin_edit (title,url,id,w,h) {
            x_admin_show(title,url,w,h);
        }
        /*删除*/
        function admin_del(obj,id){
            var json = {_token:'{{csrf_token()}}'};
            var url = '{{url('admin/admin_user')}}' + '/' + id;
            var res = adminAjax(url,json,'delete');
            console.log(res);
//            layer.confirm('确认要删除吗？',function(index){
//                //发异步删除数据
//                if (res.success == 1) {
//                    $(obj).parents("tr").remove();
//                    layer.msg(res.tip,{icon:1,time:1000});
//                } else {
//                    layer.msg(res.tip,{icon:1,time:1000});
//                }
//            });
        }
    </script>
@endsection
