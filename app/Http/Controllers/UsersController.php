<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Session;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('users.edit', compact('user'));
      //和show方法一樣接受$user用戶作為傳參, url:/users/1/edit 會讀取id為1用戶並注入到此方法
      //為隱性model route binding
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        
        $data = $request->all();
        
        if($request->avatar){
          $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
          if($result){
            //此判斷是因為imageUploadHandler對file extension做了限定，不允許將return false
            $data['avatar'] = $result['path'];
          }
        }
        $user->update($data);
        //使用form request （表單請求驗證）來驗證用戶提交的數據
        //這一步才是執行更新

        return redirect()->route('users.show', $user->id)->with('success', '個人資料更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
