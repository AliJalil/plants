<?php
session_start();

// Flash message helper
function flash($name = '', $message = '', $class = 'alert alert-success'){
  if(!empty($name)){
    //No message, create it
    if(!empty($message) && empty($_SESSION[$name])){
      if(!empty( $_SESSION[$name])){
          unset( $_SESSION[$name]);
      }
      if(!empty( $_SESSION[$name.'_class'])){
          unset( $_SESSION[$name.'_class']);
      }
      $_SESSION[$name] = $message;
      $_SESSION[$name.'_class'] = $class;
    }
    //Message exists, display it
    elseif(!empty($_SESSION[$name]) && empty($message)){
      $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : 'success';
      echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
      unset($_SESSION[$name]);
      unset($_SESSION[$name.'_class']);
    }
  }
}

function checkImg($source, $noImgName = "noImage.png")
{

    clearstatcache();
    $imageSource = URLROOT . "/public/images/statics/" . $noImgName;
    $upOne = realpath(dirname(__FILE__) . '/../..');
    $target = $upOne . "\public\images\\";
    //print_r($target);
//    print_r( URLROOT . "/public/images/" . $source);
    //print_r($target.$source);
    if (isset($source) && !empty($source)) {
        if (file_exists($target . $source)) {

            $imageSource = URLROOT . "/public/images/" . $source;
        }
        else
        {
            $imageSource = URLROOT . "/public/images/statics/" . $noImgName;
        }
    }
    else
    {
        $imageSource = URLROOT . "/public/images/statics/" . $noImgName;
    }

    echo $imageSource;
}