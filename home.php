<?php
session_start();
if(isset($_SESSION['user_id'])){
  echo 'yep it works';
}else{
  header("Location: index.php?error=notLogin");
}

?>
