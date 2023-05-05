<?php

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

  $allowed = array('jpg', 'jpeg', 'png');
  $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

  if(!in_array($file_extension, $allowed)){
    echo "Error: Dosya uzantısı izin verilenlerde değil.";
    exit;
  }

  $new_width = 500;
  $new_height = 500;

  $image = $_FILES['image']['tmp_name'];
  $image_info = getimagesize($image);

  $old_width = $image_info[0];
  $old_height = $image_info[1];
  $mime_type = $image_info['mime'];

  switch($mime_type){
    case 'image/jpeg':
      $source_image = imagecreatefromjpeg($image);
      break;
    case 'image/png':
      $source_image = imagecreatefrompng($image);
      break;
    default:
      echo "Error: Sadece JPG ve PNG dosyaları desteklenmektedir.";
      exit;
  }

  $new_image = imagecreatetruecolor($new_width, $new_height);
  imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);

  $watermark_text = 'My Website';
  $watermark_color = imagecolorallocate($new_image, 255, 255, 255);
  $font_size = 20;
  $font = 'arial.ttf';

  imagettftext($new_image, $font_size, 0, 10, 30, $watermark_color, $font, $watermark_text);

  $new_image_name = uniqid() . '.' . $file_extension;
  $new_image_path = 'uploads/' . $new_image_name;

  switch($mime_type){
    case 'image/jpeg':
      imagejpeg($new_image, $new_image_path, 100);
      break;
    case 'image/png':
      imagepng($new_image, $new_image_path, 0);
      break;
  }

  imagedestroy($source_image);

} else {
  echo "Error: Bir dosya seçiniz.";
}

?>