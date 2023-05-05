# Image Resizing and Watermarking Script

This is a PHP script for resizing and watermarking images. It takes an image file as input, resizes it to a specified size, adds a watermark, and saves the new image as a file.

## Usage

1. Upload the script to your web server.
2. Use a HTML form to allow users to upload their image file to your web server.
3. Use the following PHP code to include the script in your web page:
<br/>
`
include 'resize-watermark.php';
`
4. In the same PHP file, use the following code to call the resizeAndWatermark function:
<br/>
`
$newImagePath = resizeAndWatermark($_FILES['image']['tmp_name'], $file_extension, $new_width, $new_height, $watermark_text, $font, $font_size, $watermark_color);
`
- $newImagePath is the path to the newly created image file.
- $_FILES['image']['tmp_name'] is the path to the uploaded image file.
- $file_extension is the extension of the uploaded image file.
- $new_width and $new_height are the desired dimensions of the new image.
- $watermark_text is the text to be used for the watermark.
- $font is the path to the TrueType font file to be used for the watermark text.
- $font_size is the size of the font to be used for the watermark text.
- $watermark_color is the color to be used for the watermark text.

## Example
<br/>
`
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

  include 'resize-watermark.php';

  $allowed = array('jpg', 'jpeg', 'png');
  $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
  if(!in_array($file_extension, $allowed)){
    echo "Error: The file extension is not allowed.";
    exit;
  }

  $new_width = 500;
  $new_height = 500;

  $newImagePath = resizeAndWatermark($_FILES['image']['tmp_name'], $file_extension, $new_width, $new_height, 'My Website', 'arial.ttf', 20, imagecolorallocate($new_image, 255, 255, 255));

  echo "The new image has been saved as $newImagePath";
}
`

## Requirements

- GD Library
- PHP 5.5 or higher
