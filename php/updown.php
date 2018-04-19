<!-- https://davidkorea.applinzi.com/updown.php -->


<?php

  //sae only!!
  $s =new SaeStorage();

  ob_start();
  readfile($_FILES['fileup']['tmp_name']);
  $img = ob_get_contents();
  ob_end_clean();

  //file size
  // $size = strlen($img);

  file_put_contents(SAE_TMP_PATH."/bg.jpg",$img);

  if($s->upload('weixin','test.jpg',SAE_TMP_PATH."/bg.jpg")){
    echo "yay!upload success!";
  }else{
    echo "TT...upload failed";
  }



?>