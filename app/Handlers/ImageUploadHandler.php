<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
  //只允許以下extension的圖片文件上傳  
  protected $allowed_ext = ["png", "jpg", "gif", "jpeg"];

  public function save($file, $folder, $file_prefix, $max_width = false)
  {
      //建造儲存的文件夾規則，如：uploads/images/avatar/201709/21/
      //文件夾切割能讓查找效率更高
      $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

      //文件具體儲存的物理路徑，'public_path()'獲取的是public folder的路徑
      //如：/home/.../lara_blog/public/uploads/images/avatars/201709/21/
      $upload_path = public_path() . '/' . $folder_name;

      //獲取文件的extension
      $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

      //加prefix是為了增加辨識度，可以是相關model的id
      //in this case is user id
      $filename = $file_prefix . '_' . time() .str_random(10) . '.' .$extension;

      //如果上傳的不是圖片將停止操作
      if(!in_array($extension, $this->allowed_ext)){
        return false;
      }

      //將圖片移動到我們的目標儲存路徑中
      $file->move($upload_path, $filename);

      //如果限制了圖片寬度，就進行裁減
      if($max_width && $extension != 'gif'){

        //此類中封裝的函數，用於裁剪圖片
        $this->reduceSize($upload_path . '/' . $filename, $max_width);
      }


      return [
        'path' => "/$folder_name/$filename"
      ];
   }

   public function reduceSize($file_path, $max_width)
   {
      //先實例化，傳參是文件的路徑
      $image = Image::make($file_path);

      //進行大小調整的操作
      $image->resize($max_width, null, function($constraint){
        
        //設定寬度是 $max_width，高度等比例雙方縮放
        $constraint->aspectRatio();
        
        //防止截圖時圖片尺寸變大
        $constraint->upsize();

      });
      
      //對照片修改後保存
      $image->save();
   }
      
}