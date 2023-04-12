<?php session_start(); ?>
<?php include './include/headers.php'; ?>
<?php include './include/connect.php'; ?>
<?php
  $req = empty($_POST) ? $_GET : $_POST;
  $action = $req['action'];
  $response = array();
  if (isset($req['action'])) {
    $response['status'] = "OK";
    $response['action'] = $action;
    $action = strtolower($action);
    switch ($action) {
      case 'doregister':
        if (isset($req['email']) && isset($req['password'])) {
          $password = $req['password'];
          $password = md5($password);
          $email = $req['email'];
          $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
          @mysqli_query($con, $query);
        } else {
          $response['status'] = "FAIL";
          $response['error'] = "Incomplete Parameters";
          $response['code'] = "001";
        }
        break;
      case 'dologin':
        if (isset($req['email']) && isset($req['password'])) {
          $password = $req['password'];
          $password = md5($password);
          $email = $req['email'];
          $query = "SELECT email, password FROM users WHERE email = '$email'";
          $search = (mysqli_query($con, $query));
          $res = mysqli_fetch_assoc($search);
          if (isset($res)) {
            if ($password !== $res['password']) {
              $response['status'] = "FAIL";
              $response['error'] = "Incorrect login credentials";
              $response['code'] = "004";
            } else {
              $_SESSION['email'] = $email;
            }
          } else {
            $response['status'] = "FAIL";
            $response['error'] = "Account not found";
            $response['code'] = "003";
          }
        } else {
          $response['status'] = "FAIL";
          $response['error'] = "Incomplete Parameters";
          $response['code'] = "002";
        }
        break;
      case 'doadditem':
        if (isset($req['email']) && isset($req['item'])) {
          $email = $req['email'];
          $item = $req['item'];
          $query = "INSERT INTO list (email, item) VALUES ('$email', '$item')";
          @mysqli_query($con, $query);
        } else {
          $response['status'] = "FAIL";
          $response['error'] = "Incomplete Parameters";
          $response['code'] = "005";
        }
        break;
      case 'deleteitem':
        if (isset($req['email']) && isset($req['id'])) {
          $email = $req['email'];
          $id = $req['id'];
          $query = "DELETE FROM list WHERE email = '$email' AND id = '$id'";
          @mysqli_query($con, $query);
        } else {
          $response['status'] = "FAIL";
          $response['error'] = "Incomplete Parameters";
          $response['code'] = "006";
        }
        break;
      case 'updateitem':
        if (isset($req['email']) && isset($req['id']) && isset($req['status'])) {
          $email = $req['email'];
          $id = $req['id'];
          $status = $req['status'];
          $query = "UPDATE list SET status = '$status' WHERE id = '$id' AND email = '$email'";
          @mysqli_query($con, $query);
        } else {
          $response['status'] = "FAIL";
          $response['error'] = "Incomplete Parameters";
          $response['code'] = "007";
        }
        break;
      default:
        $response['status'] = "FAIL";
        $response['error'] = "Invalid Action";
        $response['code'] = "100";
        break;
    }
  }
  print_r(json_encode($response));
?>