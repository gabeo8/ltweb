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
    <h1 class="text-center">Thêm sản phẩm mới</h1>
    <p class="text-center">Vui lòng điền đầy đủ thông tin bên dưới để thêm sản phẩm mới</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table class="addproduct-page">
        <tr>
          <td>Tên sản phẩm</td>
          <td><input type="text" name="tensp" /></td>
        </tr>
        <tr>
          <td>Chi tiết sản phẩm</td>
          <td><textarea name="chitietsp" cols="30"></textarea></td>
        </tr>
        <tr>
          <td>Giá sản phẩm</td>
          <td><input type="text" name="giasp" /><span>(VND)</span></td>
        </tr>
        <tr>
          <td>Hình đại diện</td>
          <td><input type="file" name="hinhdaidien" /></td>
        </tr>
        <tr>
          <td colspan="2">
              <input class="btn btn-submit" type="submit" value="Thêm sản phẩm" />
              <input class="btn btn-reset" type="reset" value="Làm lại" />
          </td>
        </tr>
      </table>
    </form>
  </div>

</body>
</html>