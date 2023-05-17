<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['submit'])) {
    $st_email = get_safe_value($con, $_POST['email']);
    $st_password = get_safe_value($con, $_POST['password']);
    $sql = "select st_email,st_password from registration_complete where st_email='$st_email' and st_password='$st_password'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['email'] = $st_email;
        $_SESSION['password'] = $st_password;
        header('location:main_page_student.php');
        die();
    } else {
        $msg = "Please enter correct login details";
    }

}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Login for Student</title>
    <link rel="stylesheet" href="style_signup.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style_signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body style="background: linear-gradient(to bottom, #5f5972, #9391aa, #adadca);" >
    <div class="main" style="width: 350px;height: 420px;">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="post">
                <label for="chk" aria-hidden="true" style="margin-top:50px">Login</label>
                <input type="text" name="email" placeholder="Email" required="" style="margin: 16px auto;">
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit" name="submit" style="margin: 35px auto;">Login</button>
            </form>
        </div>
    </div>
</body>

</html>