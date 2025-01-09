  <?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/backend-vef/views/login.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: views/login.php");
    exit;
}

  ?>