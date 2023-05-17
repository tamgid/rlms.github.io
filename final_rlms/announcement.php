<?php
require('connection.inc.php');
require('functions.inc.php');
$task_id = '';
$task_title = '';
$new_img_name = '';
$group_id = '';

if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

} else {
    header('location:login.php');
    die();
}


if (isset($_POST['assign']) && isset($_FILES['my_image'])) {

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 1250000000000) {
            $em = "Sorry, your file is too large.";
            header("Location: assign_task.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "pdf");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                //insert into database

            } else {
                $em = "Sorry, you can not upload file of this type.";
                header("Location: assign_task.php?error=$em");
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: assign_task.php?error=$em");
    }

    $task_id = get_safe_value($con, $_POST['task_id']);
    $task_title = get_safe_value($con, $_POST['task_title']);
    $group_id = get_safe_value($con, $_POST['group_id']);


    mysqli_query($con, "insert into assign_task(task_id,task_title,task_file_link,group_id,status) values('$task_id','$task_title','$new_img_name','$group_id','0')");

    $sql9 = "select * from group$group_id";
    $res9 = mysqli_query($con, $sql9);
    require 'mail.php';
    $i = 0;
    while ($row9 = mysqli_fetch_assoc($res9)) {
        $st_id = $row9['st_id'];
        $sql8 = "select * from registration_complete where st_id=$st_id";
        $res8 = mysqli_query($con, $sql8);
        $row8 = mysqli_fetch_assoc($res8);
        $st_name = $row8['st_name'];
        $st_email = $row8['st_email'];


        $mail->addAddress($st_email);

        $mail->Subject = "Task Assignment";
        $mail->Body = "Dear " . $st_name . ",\n\nI hope you are doing well. I am assigning you a task for our research project.Please complete this task and let me know if you have any questions or issues.\n\nThank you for your hard work and dedication to our research lab.\n\nBest regards,\nResearch Lab Management Systems Team.\n\n";
        $mail->send();
        $i++;

    }

    header('location:announcement.php');
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Announcement</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <style>
        .left-section {
            float: left;
            width: 80%;
            height: 700px;
            overflow-y: scroll;
        }

        .right-section {
            float: right;
            width: 20%;
            height: 700px;
            overflow-y: scroll;
        }
    </style>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 0px solid #dddddd;
            text-align: left;
            padding: 7px;
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
    </style>
    <style>
        body {
            background-image: url("bac1.jpg");
            background-size: cover;
            /* color : antiquewhite */
        }
    </style>
</head>

<body style="background: linear-gradient(to bottom, #c6c6c6, #cbcbcd, #d8d8d8);">
    <header style="padding: 5px; margin-left:0px; font-size: 15px;">
        <img style="height : 55px" src="culogo.png" alt="">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="main_page_supervisor.php">Profile</a></li>
                <li><a href="group.php">Groups</a></li>
                <li><a href="file_manager.php">File manager</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="announcement.php">Announcement</a></li>
                <li><a href="researchers.php">Researchers</a></li>
                <li><a href="researchers_schedule.php">Researchers Schedules</a></li>
                <li style="margin-right: 235px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>

    <div style=" background-color: #404040; height : 50px;margin-left:0px ;padding-top:80px">
        <div style=" background-color: gray; height : 70px;margin-left:120px;margin-right : 120px;">
            <p
                style="text-align : left; margin-left : 15px;margin-top:10px;margin-bottom:0 ; padding:22px 7px ;color:white; font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Announcement</p>
        </div>
    </div>


    <div class="container" style=" color: rgb(249, 244, 244); height: auto;display: flex;margin-top:30px">
        <img src="robi.jpg" alt="Image" style="width: 70%;height: 500px; margin-left: 120px;">
        <div class="text" style="width: 30%;padding: 0 40px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 120px; background-color: #cdcdcd; height: auto; color: black; font-size: 18px;
        ">
            <h3 style="margin-top : 50px; text-align: center;">The Work of Our Research Lab Team</h3>
            <p style="text-align : left; margin-top: 40px">Unveiling the Dynamic Work of Our Research Lab Team. At our
                research lab, we
                tackle some of the most complex challenges facing society today. Our team of researchers and scientists
                work tirelessly to conduct experiments, analyze data, and develop innovative solutions to these
                challenges. Our research lab is committed to advancing scientific knowledge and making a difference in
                the world. Join us on a journey of discovery as we introduce you to the diverse range of tasks performed
                by the members of our
                research lab.
            </p>
        </div>
    </div>


    <div style=" background-color: #adadad; height : 65px; margin-left : 120px; margin-right: 120px;">
        <h2 style="text-align : left; margin-left : 10px;margin-bottom:0 ; padding: 20px;font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
            Assign Task</h2>
    </div>

    <div style="height: auto; display: flex;margin-top: 100px ">
        <div style="width : 60%; margin-left: 120px;">
            <table style=" width : 100%;    ">
                <thead>
                    <tr>
                        <th>Group_id</th>
                        <th>Group_name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql3 = "select * from group_list";
                    $res1 = mysqli_query($con, $sql3);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res1)) { ?>
                        <tr>
                            <td>
                                <?php echo $row['group_id'] ?>
                            </td>
                            <td style="text-transform: none;">
                                <?php echo $row['group_name'] ?>
                            </td>
                            <?php $i = $i + 1 ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div style="width: 50%; margin-right: 120px;  height: auto; color: black; ">
            <form method="post" enctype="multipart/form-data" style="width: 90%; height: 250px; border-radius: 5px;">
                <div class="form-group">
                    <input
                        style="margin: 5px 0;  height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="task_id" class="form-control" placeholder="task_id" required>
                </div>
                <div class="form-group">
                    <input
                        style="margin: 5px 0;  height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="task_title" class="form-control" placeholder="title" required>
                </div>
                <div class="form-group">
                    <input
                        style="margin: 5px 0;  height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="file" name="my_image" class="form-control" required>
                </div>
                <div class="form-group">
                    <input
                        style="margin: 5px 0;  height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="group_id" class="form-control" placeholder="group_id" required>
                </div>
                <button
                    style="width: 21%; background-color: black;color: white;padding: 6px 10px;margin: 20px 0;border-radius: 2px;"
                    type="submit" name="assign" class="cta-btn cta-btn-signup">assign</button>
            </form>
        </div>
    </div>



    <footer style="margin-top : 200px; height: 110px; padding-top: 50px">
        <div class="container">
            <p class="text-center">
                Contact Us:
                <a href="mailto:info@researchlab.com"><ion-icon name="mail"></ion-icon> info@researchlab.com</a>
                |
                <span><ion-icon name="call"></ion-icon> (123) 456-7890</span>
            </p>
            <p class="text-center">
                Follow Us:
                <a href="https://www.facebook.com/ShadakurRahman.Tamgid/"><ion-icon name="logo-facebook"></ion-icon>
                    Facebook</a>
                |
                <a href=""><ion-icon name="logo-twitter"></ion-icon> Twitter</a>
                |
                <a href="#"><ion-icon name="logo-linkedin"></ion-icon> LinkedIn</a>
            </p>
        </div>
    </footer>

</body>

</html>