<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Đăng kí thành viên</title>
  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
  <?php include 'lib/header.php'; ?>
  <div class="container">
    <h1>Đăng nhập</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Tên đăng nhập</td>
          <td><input type="text" name="uername" /></td>
        </tr>
        <tr>
          <td>Mật khẩu</td>
          <td><input type="password" name="password" /></td>
        </tr>
        <tr>
          <td>
              <input type="submit" value="Đăng nhập" />
          </td>
        </tr>
      </table>
      <p>Bạn chưa có tài khoản? Đăng kí tại đây!</p>
    </form>
  </div>

</body>
</html>