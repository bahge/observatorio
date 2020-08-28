<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;

  $users = $this->dados[0]['users'];
?>

<?php 
  if (!empty($users)):
    foreach ($users as $user):
      extract($user);
?>
<?php    
    endforeach;
  endif;
?>
      
