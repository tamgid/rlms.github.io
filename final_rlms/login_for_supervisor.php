<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['login_submit'])) {
    $s_email = get_safe_value($con, $_POST['email']);
    $s_password = get_safe_value($con, $_POST['password']);
    $sql = "select s_email,s_password from supervisor_registration where s_email='$s_email' and s_password='$s_password'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['email'] = $s_email;
        $_SESSION['password'] = $s_password;
        header('location:main_page_supervisor.php');
        die();
    } else {
        $msg = "Please enter correct login details";
    }

}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login for Supervisor</title>
    <link rel="stylesheet" href="style_signup.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style_signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

</head>

<body style="background: linear-gradient(to bottom, #5f5972, #9391aa, #adadca);" >
    <div class="main" style="width: 350px;height: 400px;" >
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="post">
                <label for="chk" aria-hidden="true" style="margin-top:50px">Login</label>
                <input type="text" name="email" placeholder="Email" required="" style="margin: 16px auto;" >
                <input type="password" name="password" placeholder="Password" required="">
                <button type="submit" name="login_submit" style="margin: 35px auto;" >Login</button>
            </form>
        </div>

    
    </div>
</body>

</html>