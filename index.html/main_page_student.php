<?php
require('connection.inc.php');
require('functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

} else {
    header('location:login.php');
    die();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Main page student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

    <style>
        .left-section {
            float: left;
            width: 80%;
            height: 1700px;
            overflow-y: scroll;
        }

        .right-section {
            float: right;
            width: 20%;
            height: 1700px;
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
</head>

<body style="background: linear-gradient(to bottom, #b5b5b5, #c3c3c3, #cccccc);">

    <header style="padding: 5px; margin-left:0px ; font-size: 15px;">
        <img style="height : 55px" src="culogo.png" alt="">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="main_page_student.php">Profile</a></li>
                <li><a href="student_schedule.php">Schedule</a></li>
                <li><a href="file_manager_student.php">File manager</a></li>
                <li style="margin-right: 755px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>



    <div style=" background-color: #404040; height : 50px;margin-left:0px ;padding-top:80px">
        <div style=" background-color: gray; height : 70px;margin-left:70px;margin-right : 350px;">
            <p
                style="text-align : left; margin-left : 15px;margin-top:10px;margin-bottom:0 ; padding:22px 7px ; color:white; font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Student Profile</p>
        </div>
    </div>


    <div class="right-section">
        <?php
        $st_email = $_SESSION['email'];
        $st_password = $_SESSION['password'];
        $sql = "select * from registration_complete where st_email='$st_email' and st_password='$st_password'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>
        <div class="team-section" style="margin-top: 50px;margin-left: 10px">
            <div class="member">
                <img style="margin-bottom: 30px;" src="uploads/<?= $row['st_image'] ?>">
                <br></br>
                <?php echo $row['st_name']; ?>
                <br></br>
                <?php echo "Id: " ?>
                <?php echo $row['st_id']; ?>
                <br></br>
                <?php echo $row['st_department']; ?>
                <p>University of Chittagong</p>
                <ion-icon name="mail"></ion-icon>
                <?php echo $row['st_email']; ?>
            </div>
        </div>
    </div>



    <div class="left-section">

        <div class="container" style=" color: rgb(249, 244, 244); height: auto;display: flex;margin-top:30px">
            <img src="import.jpg" alt="Image" style="width: 60%;height: 400px; margin-left: 70px;">
            <div class="text" style="width: 30%;padding: 0 40px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 62px; background-color: #c3c3c3; height: auto; color: black; font-size: 18px;
        ">
                <h3 style="margin-top: 40px">Your group</h3>
                <p style="text-align : left; margin-top: 30px">Welcome back! On this page, you can view and edit
                    your personal profile information. Here, you can review your past contributions to our research lab
                    and update your contact information. We appreciate your dedication to our mission and are proud to
                    have you as a member of our team.
                </p>
            </div>
        </div>



        <div style=" background-color: #adadad; height : 65px; margin-left : 70px; margin-right: 62px;margin-top: 80px">
            <h2
                style="text-align : left; margin-left : 5px;margin-bottom:0 ; padding: 20px;font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Meeting Info</h2>
        </div>



        <?php
        $st_email = $_SESSION['email'];
        $st_password = $_SESSION['password'];
        $sql2 = "select * from registration_complete where st_email='$st_email' and st_password='$st_password'";
        $res = mysqli_query($con, $sql2);
        $row = mysqli_fetch_assoc($res);
        $id = $row['st_id'];

        for ($k = 1; $k < 100; $k++) {
            $table = "select * from group$k";
            $sql1 = mysqli_query($con, $table);
            if ($sql1) {
                $team = "group$k";
                $sql9 = "select * from $team where st_id='$id'";
                $res1 = mysqli_query($con, $sql9);
                $row9 = mysqli_fetch_assoc($res1);
                if ($res1 && $row9 > 0) {
                    $_SESSION['group_id'] = $k;
                    $sql4 = "select * from group_list where group_id='$k'";
                    $res2 = mysqli_query($con, $sql4);
                    $row2 = mysqli_fetch_assoc($res2);
                    break;
                }
            }

        }

        ?>

        <div style="text-align:left; margin-left: 80px">
            <?php
            echo '<div style=" margin-top : 80px; font-size: 20px">' . "Group : " . $row2['group_name'] . '</div>';
            echo '<div style=" margin-top : 15px; font-size: 20px">' . "Supervisor : Rudra Pratap Deb Nath" . '</div>';

            $sql6 = "SELECT * from schedule_list WHERE group_id = $k and id = (select max(id) from schedule_list WHERE group_id=$k)";

            $res6 = mysqli_query($con, $sql6);
            $row6 = mysqli_fetch_assoc($res6);

            echo '<div style=" margin-top : 15px; font-size: 18px">' . "Title : " . $row6['title'] . '</div>';
            echo '<div style=" margin-top : 15px; font-size: 18px">' . "Description : " . $row6['description'] . '</div>';
            echo '<div style=" margin-top : 15px; font-size: 18px">' . "Start_time : " . $row6['start_datetime'] . '</div>';
            echo '<div style=" margin-top : 15px; font-size: 18px">' . "End_time : " . $row6['end_datetime'] . '</div>';

            ?>
        </div>

        <div style=" background-color: #adadad; height : 65px; margin-left : 70px; margin-right: 62px;margin-top: 80px">
            <h2
                style="text-align : left; margin-left : 5px;margin-bottom:0 ; padding: 20px;font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Submit Task</h2>
        </div>





        <div class="container" style="height: auto;display: flex;margin-top:100px">


            <table style="width : 60%;margin-left : 70px;">
                <thead>
                    <tr>
                        <th style="text-align: left;">Task id</th>
                        <th style="text-align: left;">Task title</th>
                        <th style="text-align: left;">Task file</th>
                        <th style="text-align: left;">Student submitted file</th>
                        <th style="text-align: left;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql1 = "select * from assign_task where group_id=$k";
                    $res1 = mysqli_query($con, $sql1);
                    $i = 1;
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $id = $row1['task_id'];
                        $sql5 = "select * from submit_task where task_id=$id";
                        $res4 = mysqli_query($con, $sql5);
                        $row4 = mysqli_fetch_assoc($res4);
                        ?>
                        <tr>
                            <td>
                                <?php echo $row1['task_id'] ?>
                            </td>
                            <td style="text-transform: none;">
                                <?php echo $row1['task_title'] ?>
                            </td>
                            <td>
                                <a href="uploads/<?= $row1['task_file_link'] ?>">Open assign file</a>
                            </td>
                            <td>
                                <a href="uploads/<?= $row4['submitted_file_link'] ?>">Open submitted file</a>
                            </td>
                            <td>
                                <?php
                                if ($row1['status'] == 0) {
                                    echo "Pending";
                                } else {
                                    echo "Complete";
                                }
                                ?>
                            </td>
                            <?php $i = $i + 1 ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text" style="width: 40%; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 100px; background-color: #c3c3c3; height: auto; color: black; font-size: 20px;
        ">
                <form method="post" enctype="multipart/form-data"
                    style="width: 90%; height: 190px; border-radius: 5px;margin-left: 40px">
                    <div class="form-group" style="margin-top: 0px">
                        <input
                            style="margin: 4px 0; height: 37px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                            type="text" name="task_id" class="form-control" placeholder="task_id" required>
                    </div>
                    <div class="form-group">
                        <input
                            style="margin: 4px 0;  height: 37px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                            type="text" name="task_title" class="form-control" placeholder="title" required>
                    </div>
                    <div class="form-group">
                        <input
                            style="margin: 4px 0;height: 37px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                            type="file" name="my_image" class="form-control" required>
                    </div>
                    <button
                        style="width: 25%; background-color: black;color: white;padding: 6px 10px;margin: 15px 0;border-radius: 2px;"
                        type="submit" name="student_submit" class="cta-btn cta-btn-signup">submit</button>
                </form>
            </div>
        </div>


        <?php
        if (isset($_POST['student_submit']) && isset($_FILES['my_image'])) {

            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];

            if ($error === 0) {
                if ($img_size > 1250000000000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: main_page_student.php?error=$em");
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png", "pdf");
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                    } else {
                        $em = "Sorry, you can not upload file of this type.";
                        header("Location: main_page_student.php?error=$em");
                    }
                }
            } else {
                $em = "Unknown error occurred!";
                header("Location: main_page_student.php?error=$em");
            }

            $task_id = get_safe_value($con, $_POST['task_id']);
            $task_title = get_safe_value($con, $_POST['task_title']);
            $group_id = $k;

            mysqli_query($con, "insert into submit_task(task_id,task_title,submitted_file_link,group_id) values('$task_id','$task_title','$new_img_name','$group_id')");
            mysqli_query($con, "UPDATE `assign_task` SET `status` = '1' WHERE `assign_task`.`task_id` = $task_id");

        }
        ?>

    </div>


    <footer style="margin-top : 1710px; height: 110px; padding-top: 50px">
        <div class="container">
            <p class="text-center">
                Contact Us:
                <a href="mailto:info@researchlab.com"><ion-icon name="mail"></ion-icon> info@researchlab.com</a>
                |
                <!-- Phone: (123) 456-7890 -->
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