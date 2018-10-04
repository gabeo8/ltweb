<?php
    // get form input
    
    // echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
  if((isset($_POST['dangnhap']) && $_POST['dangnhap'] !='') 
      && (isset($_POST['matkhau'])&& $_POST['matkhau'] !='')
      && (isset($_POST['matkhau2'])&& $_POST['matkhau2'] !='')
      && (isset($_FILES['hinhdaidien']['name']) && $_FILES['hinhdaidien']['name'] !='')
      && (isset($_POST['st'])&& $_POST['st'] !='')
      && (isset($_POST['gt'])&& $_POST['gt'] !='')
      && (isset($_POST['nn'])&& $_POST['nn'] !='')
    ) {


    $dn = $_POST['dangnhap'];
    if ($_POST['matkhau'] == $_POST['matkhau2']) {
      $mk = $_POST['matkhau'];
      $mk_hash = password_hash($mk, PASSWORD_DEFAULT);
    }
    
    $target_dir = 'uploads/';
    $target_file = $target_dir  . uniqid() . '-' . basename($_FILES['hinhdaidien']['name']);
    if (move_uploaded_file($_FILES["hinhdaidien"]["tmp_name"], $target_file)) {
      $avatar = $target_file;
    }
    $gt = $_POST['gt'];
    $nn = $_POST['nn'];
    if (isset($_POST['st']) && is_array($_POST['st']) && count($_POST['st']) > 0) {
      $st = implode(', ', $_POST['st']);
    }
    // 3. validation
     

    // mysql
    require "lib/config.php";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO thanhvien (tendangnhap, matkhau, hinhanh, gioitinh, nghenghiep, sothich)
    VALUES ('$dn', '$mk_hash', '$avatar', '$gt', '$nn', '$st')";

    if ($conn->query($sql) === TRUE) {
      setcookie('username', $dn, time() + (86400 * 30), "/"); // 86400 = 1 day
      header("Location: /profile.php");
      exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
?>

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
    <h1>Đăng kí tài khoản mới</h1>
    <p>Vui lòng điền đầy đủ thông tin bên dưới để đăng kí tài khoản mới</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <td>Tên đăng nhập</td>
          <td><input type="text" name="dangnhap" /></td>
        </tr>
        <tr>
          <td>Mật khẩu</td>
          <td><input type="password" name="matkhau" /></td>
        </tr>
        <tr>
          <td>Gõ lại mật khẩu</td>
          <td><input type="password" name="matkhau2" /></td>
        </tr>
        <tr>
          <td>Hình đại diện</td>
          <td><input type="file" name="hinhdaidien" /></td>
        </tr>
        <tr>
          <td>Giới tính</td>
          <td>
            <input type="radio" name="gt" value="Nam" /> Nam
            <input type="radio" name="gt" value="Nữ" /> Nữ
            <input type="radio" name="gt" value="Khác" /> Khác
          </td>
        </tr>
        <tr>
          <td>Nghề nghiệp</td>
          <td>
            <select name="nn">
              <option value="Học sinh">Học sinh</option>
              <option value="Sinh viên">Sinh viên</option>
              <option value="Giáo viên">Giáo viên</option>
              <option value="Khác">Khác</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Sở thích</td>
          <td>
            <input type="checkbox" name="st[]" value="Thể thao" /> Thể thao
            <input type="checkbox" name="st[]" value="Du lịch" /> Du lịch
            <input type="checkbox" name="st[]" value="Âm nhạc" /> Âm nhạc
            <input type="checkbox" name="st[]" value="Thời trang" /> Thời trang
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
              <input type="submit" value="Đăng kí" />
              <input type="reset" value="Làm lại" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>