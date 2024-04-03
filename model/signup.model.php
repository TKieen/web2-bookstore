<?php
  include_once('connect.php');
  $database = new connectDB();

  function checkLogin($username, $password)
  {
    global $database;
    $sql = "SELECT *
              FROM accounts
              WHERE username = '$username'";
    $result = $database->query($sql);

    // Kiểm tra xem có tồn tại không?
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $db_password = $row['password'];

      // So sánh mật khẩu nhập vào với mật khẩu trong cơ sở dữ liệu
      if ($password == $db_password) {
        $database->close();
        return true;
      } else {
        $database->close();
        return false;
      }
    } else {
      $database->close();
      return false;
    }
  }

  function checkRegister($username, $fullname, $phoneNumber, $address, $password) {
    global $database;
    // Kiểm tra username có tồn tại hay chưa
    $sqlCheckExistUsername = "SELECT * FROM accounts WHERE username = '$username'";
    $resultCheckExistUsername = $database->query($sqlCheckExistUsername);
    if (mysqli_num_rows($resultCheckExistUsername) > 0) {
      return (object) array (
        'success' => false,
        'message' => "Hệ thống đã tồn tại username: $username"
      );
    }

    // Nếu như username chưa tồn tại, thì tạo tài khoản
    $sqlInsertAccount = "INSERT INTO accounts (username, password, role_id) 
                        VALUES ('$username', '$password', 1)";
    $sqlInsertUserInfo = "INSERT INTO user_infoes (user_id, fullname, phone_number, address)
                              VALUES ('$username', '$fullname', '$phoneNumber', '$phoneNumber')";

    $resultInsertAccount = $database->execute($sqlInsertAccount);
    $resultInsertUserInfo = $database->execute($sqlInsertUserInfo);
   
    // Nếu như insert thành công vào database
    if ($resultInsertAccount && $resultInsertUserInfo) {
      return (object) array (
        'success' => true,
        'message' => "Đăng ký thành công"
      );
    } else {
      return (object) array (
        'success' => false,
        'message' => "Đã xảy ra lỗi khi đăng ký"
      );
    }
  }
?>