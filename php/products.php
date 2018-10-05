<?php
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  if(!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
  }


  echo $_GET['id'];
  echo $_GET['view']
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Danh sach san pham</title>
  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
  <?php include 'lib/header.php'; ?>
  
  <div class="container">
    <h3 class="text-center">Chào bạn <?php echo $_COOKIE['username']; ?></h3>
    <p class="text-center">Danh sách sản phẩm của bạn</p> 
    <table class="product">
    <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th colspan="3">Lựa chọn</th>
            </tr>
    <?php
      require "lib/config.php";
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      $user = $_COOKIE['username'];
      $sql = "SELECT id, idsp, tensp, chitietsp, giasp, hinhanhsp 
              FROM sanpham as sp JOIN thanhvien as tv 
              WHERE sp.idtv = tv.id AND tv.tendangnhap = '$user'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          $i = 1;
          while($row = $result->fetch_assoc()) {
            echo '
            
            <tr>
              <td>' . $i . '</td>
              <td>' . $row['tensp'] . '</td>
              <td>' . $row['giasp'] . ' (VND)</td>
              <td><a href="?id='. $row['idsp'] .'&view=chitiet">Xem chi tiết</a></td>
              <td><a href="?id='. $row['idsp'] .'">Sửa</a></td>
              <td><a href="?id='. $row['idsp'] .'">Xóa</a></td>
            </tr>

         ';
            $i = $i + 1;
        }
      } else {
          echo "0 results";
      }

      $conn->close();
    ?>
     </table>
    
    
  </div>
</body>
</html>