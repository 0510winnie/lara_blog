<?php

use App\User;

return [
  //page title
  'title' => '用戶',

  //模型單數，用作頁面 『新建 $single』
  'single' => '用戶',

  //數據模型，用作數據的CRUD
  'model' => User::class,

  //設置當前頁面的訪問權限，通過返回布林值來控制權限
  'permission' => function()
  {
    return Auth::user()->can('manage_users');
  },

  //字段負責渲染數據表格，由無數的列組成
  'columns' => [
    
    //列的提示，這是一個最小化“列”信息配置的例子，讀取的是模型裡對應
    //的屬性的值，如 $model->id
    'id',
    
    'avatar' => [
      //數據表裡列的名稱
      'title' => '用戶照片',

      //默認情況下會直接輸出數據，也可以使用output
      'output' => function($avatar, $model){
        return empty($avatar)? 'N/A' : '<img src="'.$avatar.'" width="40">';
      },

      //是否允許排序
      'sortable' => false,
    ],

    'name' => [
      'title' => '用戶名',
      'sortable' => false,
      'output' => function($name, $model) {
        return '<a href="/users/' .$model->id.'" target=_blank>' . $name.'</a>';
      },
    ],
    
    'email' => [
      'title' => '電子郵件',
    ],

    'operation' => [
      'title' => '管理',
      'sortable' => false,
    ],
  ],

  //“模型表單”設置選項
  'edit_fields' => [
    'name' => [
      'title' => '用戶名',
    ],
    'email' => [
      'title' => '電子郵件',
    ],
    'password' => [
      'title' => '密碼',

      //表單使用input類型密碼
      'type' => 'password',
    ],
    'avatar' => [
      'title' => '用戶照片',

      //設置表單項目的類型，默認的type是input
      'type' => 'image',

      //圖片上傳必須設置圖片存放路徑
      'location' => public_path() . '/uploads/images/avatar/',
    ],
    'roles' => [
      'title' => '用戶角色',

      //指定數據的類型為關聯模型
      'type' => 'relationship',

      //關聯模型的字段，用來做關聯顯示
      'name_field' => 'name',
    ],
  ],

  //過濾數據 設置
  'filters' => [
    'id' => [
      //過濾表單 顯示名稱
      'title' => '用戶 ID',
    ],
    'name' => [
      'title' => '用戶名稱',
    ],

    'email' => [
      'title' => '電子郵件',
    ],
  ],
];