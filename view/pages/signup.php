<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign Up</title>
    <link rel="stylesheet" href="css/signup/signup.css?v=<?php echo time(); ?>">
   
</head>
<body>

   <div class="container">
        <div class="button-container">
            <!-- Button to open the login form -->
            <button onclick="showForm('loginForm', this)" class="button active">Đăng nhập</button>
    
            <!-- Button to open the sign-up form -->
            <button onclick="showForm('signupForm', this)" class="button">Đăng ký</button>
        </div>
     
        <!-- Login form -->
        <div id="loginForm" class="form-container active">  
            <h2>Form Đăng nhập</h2>
            <!-- Your login form goes here -->
            <form action="login_process.php" method="POST">
                <div class="form-row">
                    <label for="username">Tên tài khoản:</label>
                    <input type="text" placeholder="Nhập tên tài khoản" name="username" required>
                </div>
                <div class="form-row">
                    <label for="psw">Mật khẩu:</label>
                    <input type="Mật khẩu" placeholder="Nhập Mật khẩu" name="psw" required>
                </div>
                <button type="submit">Đăng nhập</button>
            </form>
        </div>
     
        <!-- Sign-up form -->
        <div id="signupForm" class="form-container">
            <h2>Form Đăng ký</h2>
            <!-- Your sign-up form goes here -->
            <form action="signup_process.php" method="POST">
                <div class="form-row">
                    <label for="username">Tên tài khoản:</label>
                    <input type="text" placeholder="Nhập tên tài khoản" name="username" required>
                </div>
                <div class="form-row">
                    <label for="name">Họ và tên</label>
                    <input type="text" placeholder="Nhập Họ và tên" name="name" required>
                </div>
                <div class="form-row">
                    <label for="number">Số điện thoại:</label>
                    <input type="number" placeholder="Nhập Số điện thoại:" name="number" required>
                </div>
                <div class="form-row">
                    <label for="address">Địa chỉ</label>
                    <input type="text" placeholder="Nhập địa chỉ" name="address" required>
                </div>
                
                <div class="form-row">
                    <label for="psw">Mật khẩu:</label>
                    <input type="password" placeholder="Nhập Mật khẩu" name="psw" required id="psw">
                </div>
                <div class="form-row">
                    <label for="psw-repeat">Lặp lại Mật khẩu:</label>
                    <input type="password" placeholder="Nhập lại Mật khẩu" name="psw-repeat" required id="psw-repeat">
                </div>
                <button type="submit">Đăng kí</button>
            </form>
        </div>
        
        </div>
    </div>
 
 
    <script>
        // Ham de hien dang ki hay dang nhap
        function showForm(formId, button) {
           var forms = document.querySelectorAll('.form-container');
           forms.forEach(function(form) {
               if (form.id === formId) {
                   form.classList.add('active');
               } else {
                   form.classList.remove('active');
               }
           });

           var buttons = document.querySelectorAll('.button');
           buttons.forEach(function(btn) {
               btn.classList.remove('active');
           });

           button.classList.add('active');
       }

// Ham check mat khau co trung voi lap lai mat khau 
       var password = document.getElementById("psw");
var confirmPassword = document.getElementById("psw-repeat");
var signUpButton = document.querySelector("#signupForm button[type='submit']");

// Thêm sự kiện 'input' vào trường nhập liệu "Lặp lại Mật khẩu"
confirmPassword.addEventListener("input", function() {
    // Nếu giá trị của trường "Lặp lại Mật khẩu" khớp với giá trị của trường "Mật khẩu"
    if (password.value === confirmPassword.value) {
        // Xóa thông báo lỗi (nếu có)
        confirmPassword.setCustomValidity('');
    } else {
        // Đặt thông báo lỗi
        confirmPassword.setCustomValidity('Mật khẩu không khớp');
    }
});

// Thêm sự kiện 'submit' vào form
document.querySelector("#signupForm").addEventListener("submit", function(event) {
    // Kiểm tra nếu trường "Lặp lại Mật khẩu" không hợp lệ
    if (!confirmPassword.validity.valid) {
        // Ngăn chặn việc gửi form
        event.preventDefault();
    }
});
    </script>
</body>
</html>