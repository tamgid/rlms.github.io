<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['signup_submit'])) {
    $s_name = get_safe_value($con, $_POST['name']);
    $s_id = get_safe_value($con, $_POST['id']);
    $s_email = get_safe_value($con, $_POST['email']);
    $s_password = get_safe_value($con, $_POST['password']);
    $s_institution = get_safe_value($con, $_POST['institution']);
    $s_department = get_safe_value($con, $_POST['department']);
    $s_status = get_safe_value($con, $_POST['status']);
    mysqli_query($con, "insert into supervisor_registration(s_name,s_id,s_email,s_password,s_institution,s_department,s_status) values('$s_name','$s_id','$s_email','$s_password','$s_institution','$s_department','$s_status')");
    header('location:home.php');
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Signup for Supervisor</title>
    <link rel="stylesheet" href="style_signup.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style_signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

</head>

<body style="background: linear-gradient(to bottom, #5f5972, #9391aa, #adadca);" >
    
    <div class="main" style="width: 400px;" >
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="post">
                <label for="chk" aria-hidden="true" style="margin-top:30px">Sign up</label>
                <input type="text" name="name" placeholder="User name" required="">
                <input type="text" name="id" placeholder="User id" required="">
                <input type="text" name="email" placeholder="Email" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="text" name="institution" placeholder="Institution" required="">
                <input type="text" name="department" placeholder="Department" required="">
                <input type="text" name="status" placeholder="Status" required="">
                <button type="submit" name="signup_submit">Sign up</button>
            </form>
        </div>


    </div>
</body>

</html>