<?php
  session_start();
  if (isset($_SESSION['email'])) {
    redirect('/main');
  } else {
    redirect('/login');
  }
?>