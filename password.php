<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>passsword hash</title>
  </head>
  <body>
    <form method="post">
      <input type="text" name="pass">
      <button type="submit" name="button">Password</button>
    </form>
    <?php
      if (isset($_POST['button'])) {
        // $p = $_POST['pass'];
        $p = '$2y$10$ZRe81vy47xhFxfGNa2h6B.VGIi4YMVGWJu3zpuvAuAzt/lN548IOK';
        // $pass = password_hash("$p",PASSWORD_DEFAULT);
        // echo "<input type='text' name='name' width=255 value='$pass'>";
        if (password_verify('uchy', $p)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }
      }
    ?>
  </body>
</html>
