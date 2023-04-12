<?php
  session_start();
  if (isset($_SESSION['email'])) {
    redirect('/main');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    <?= app ?>
  </title>
  <meta charset="UTF-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Raccoon Shopping List Assessment">
  <meta name="author" content="John S">
  <link rel="stylesheet" href="<?= base() ?>/assets/css/login.css" type="text/css" />
</head>

<body>
  <div id="wrapper">
    <form id="loginForm">
      <div class="form-structor">
        <div class="form signup" data-action="doregister">
          <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
          <div class="form-holder">
            <input type="email" class="input email" placeholder="Email" />
            <input type="password" class="input password" placeholder="Password" />
            <input type="password" class="input cpassword" placeholder="Confirm Password" />
          </div>
          <button type="submit" class="submit-btn">Sign up</button>
        </div>
        <div class="form login slide-up" data-action="dologin">
          <div class="center">
            <h2 class="form-title" id="login"><span>or</span>Log in</h2>
            <center></span><?= slogan ?> </span></center>
            <div class="form-holder">
              <input type="email" class="input email" placeholder="Email" />
              <input type="password" class="input password" placeholder="Password" />
            </div>
            <button type="submit" class="submit-btn">Log in</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base() ?>/assets/js/login.js" type="text/javascript"></script>
  <script>
    let basename = "<?=base()?>";
  </script>
</body>

</html>