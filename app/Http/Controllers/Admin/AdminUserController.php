<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
use App\Models\AdminUserRole;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = AdminUser::orderBy('id', 'desc')->get();
        return view('admin.rbac.admin_users.index', compact('adminUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.rbac.admin_users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adminUserData = $request->except('_token');
        $role_id = $adminUserData['data']['role_id'];
        unset($adminUserData['data']['role_id']);
        unset($adminUserData['data']['repassword']);
        $adminUserData['data']['password'] = bcrypt($adminUserData['data']['password']);
        DB::beginTransaction();
        try{
            $id = AdminUser::create($adminUserData['data'])->id;
            AdminUserRole::create(['admin_user_id' => $id, 'role_id' => $role_id]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $adminUser = AdminUser::find($id);
        return view('admin.rbac.admin_users.edit', compact('roles', 'adminUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage. //先看看是不是最后一个管理再删除吧！
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            AdminUser::destroy($id);
            AdminUserRole::where('admin_user_id', $id)->delete();
            echo json_encode(['success' => 1, 'tip' => '已删除！']);
            DB::commit();
        } catch (\Exception $e) {
            echo json_encode(['success' => 0, 'tip' => '删除失败']);
            DB::rollBack();
        }
    }
}
