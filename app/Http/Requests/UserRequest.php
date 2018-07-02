<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //權限驗證
        //true代表所有權限都通過即可
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,'
            . Auth::id(),
            'email'=> 'required|email',
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }

    public function messages()
    {
      return [
        'avatar.mimes' => '頭像必須是jpeg, bmp, png, gif 格式的圖片',
        'avatar.dimensions' => '圖片的清晰度不夠，寬和高需要200px以上',
        'name.unique' => '用戶名已被佔用，請重新填寫',
        'name.regex' => '用戶名只支持英文、數字、-、和底線',
        'name.between' => '用戶名必須介於 3 - 25 個字中間',
        'name.required' => '用戶名稱不能為空',
      ];
    }
}
