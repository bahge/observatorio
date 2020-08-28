<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>