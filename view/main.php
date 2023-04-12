<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    redirect('/login');
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
  <link rel="stylesheet" href="<?= base() ?>/assets/css/main.css" type="text/css" />
</head>
<body>
  <div id="notebook">
    <p class="date"><span class="month"><?=date("M")?></span> <span class="day"><?= date("d") ?></span></p>
    <a href="<?=base()?>/logout" id="logout">Logout</a>
    <h1>My List</h1>
    <form id="addItem">
      <div class="form-inline">
        <label for="item">Add Item</label>
        <div class="input-group">
          <input type="text" id="item" name="item" placeholder="Item Name" />
          <button type="submit"><span>+</span></button>
        </div>
      </div>
    </form>
    <ul id="shopping-list">
      <?php
      include "./include/connect.php";
      $email = $_SESSION['email'];
      $query = "SELECT id, item, status FROM list WHERE email = '$email'";
      $search = (mysqli_query($con, $query));
      while ($res = mysqli_fetch_assoc($search)) {
      ?>
      <li class="item" data-id="<?= $res['id'] ?>"><input type="checkbox"  data-id="<?= $res['id'] ?>" <?php if(isset($res['status']) && $res['status'] > 0){ echo "checked"; } ?> /><p><?= $res['item']?></p></li>
      <?php } ?>
      
    </ul>
    <center>
      <small>Double click on an item to delete it.</small>
    </center>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base() ?>/assets/js/main.js" type="text/javascript"></script>
  <script>
    let basename = "<?= base() ?>";
    let email = "<?= $_SESSION['email'] ?>";
  </script>
</body>

</html>