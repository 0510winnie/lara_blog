<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        switch($this->method())
        {
          
          //Create
          case'POST';

          //Update
          case'PUT';
          case'PATCH';
          {
            return [
                'title' => 'required|min:2',
                'body' => 'required|min:2',
                'category_id' => 'required|numeric', 
            ];
          }
          //Post, Put & Patch 使用同一套驗證規則
          
          case'GET';
          case'DELETE';
          default:
          {
            return [];
          };

        }
       
    }

    public function messages()
    {
      return [
        'title.min' => '標題必須至少兩個字',
        'body.min' => '文章內容必須至少兩個字'
      ];
    }
}
