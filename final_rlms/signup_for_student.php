<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['submit']) && isset($_FILES['my_image'])) {

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 12500000) {
            $em = "Sorry, your file is too large.";
            header("Location: signup_student.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);


            } else {
                $em = "Sorry, you can not upload file of this type.";
                header("Location: signup_student.php?error=$em");
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: signup_student.php?error=$em");
    }

    $st_name = get_safe_value($con, $_POST['name']);
    $st_id = get_safe_value($con, $_POST['id']);
    $st_email = get_safe_value($con, $_POST['email']);
    $st_password = get_safe_value($con, $_POST['password']);
    $st_department = get_safe_value($con, $_POST['department']);
    $st_year = get_safe_value($con, $_POST['year']);
    $st_degree = get_safe_value($con, $_POST['degree']);

    mysqli_query($con, "select * from student_registration where st_id='$st_id'");
    mysqli_query($con, "insert into registration_pending(st_name,st_id,st_email,st_password,st_department,st_year,st_image,st_degree) values('$st_name','$st_id','$st_email','$st_password','$st_department','$st_year','$new_img_name','$st_degree')");
    
    require 'mail.php' ;
        $mail->addAddress($st_email);

        $mail->Subject="SignUp Successful";
        $mail->Body="Dear ".$st_name.",\n\nWe are delighted to welcome you to our Research Lab! Congratulations on successfully signing up for our platform. Your participation is valuable to us, and we look forward to working with you to achieve your research goals. Our team is always available to support and guide you throughout your journey with us. Don't hesitate to contact us if you have any questions or concerns.\n\nThank you for choosing our platform, and once again, congratulations on joining our community!\n\nBest regards,\nResearch Lab Management Systems Team.\n\n";
        $mail->send();

    header('location:home.php');
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>Signup for Student</title>
    <link rel="stylesheet" href="style_signup.css">
    <link rel="stylesheet" type="text/css" href="slide navbar style_signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body style="background: linear-gradient(to bottom, #5f5972, #9391aa, #adadca);" >

    <div class="main" style="width: 400px;">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

            <form method="post" enctype="multipart/form-data">
                <label for="chk" aria-hidden="true" style="margin-top:25px">Sign up</label>
                <input type="text" name="name" placeholder="User name" required=""
                    style="margin: 13px auto;height: 15px;">
                <input type="text" name="id" placeholder="User id" required="" style="margin: 13px auto;height: 15px;">
                <input type="email" name="email" placeholder="Email" required=""
                    style="margin: 13px auto;height: 15px;">
                <input type="password" name="password" placeholder="Password" required=""
                    style="margin: 13px auto;height: 15px;">
                <input type="text" name="department" placeholder="Department" required=""
                    style="margin: 13px auto;height: 15px;">
                <input type="text" name="year" placeholder="Year" required="" style="margin: 13px auto;height: 15px;">
                <input type="text" name="degree" placeholder="Degree" required=""
                    style="margin: 13px auto;height: 15px;">
                <input type="file" name="my_image" placeholder="Year" required=""
                    style="margin: 13px auto;height: 15px;">
                <button type="submit" name="submit" style="margin: 27px auto;">Sign up</button>
            </form>
        </div>
    </div>
</body>

</html>