<?php
require('connection.inc.php');
require('functions.inc.php');
$st_name = '';
$st_id = '';
$st_email = '';
$st_username = '';
$st_password = '';
$st_department = '';
$st_year = '';
$st_degree = '';
$st_image = '';
$short_desc = '';
$group_id;
$st_id;
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

} else {
    header('location:login.php');
    die();
}

$is_create = 0;

if (isset($_POST['create'])) {
    $group_name = get_safe_value($con, $_POST['group_name']);
    for ($k = 1; $k < 100; $k++) {
        $table = "select * from group$k";
        $sql1 = mysqli_query($con, $table);
        if (!$sql1) {
            $is_create = 1;
            $team = "group$k";
            mysqli_query($con, "insert into group_list(group_id,group_name) values('$k','$group_name')");
            $sql = "CREATE TABLE `final_project`.`$team` (`st_name` VARCHAR(100) NOT NULL , `st_id` INT(100) NOT NULL AUTO_INCREMENT ,PRIMARY KEY (`st_id`)) ENGINE = InnoDB;";
            $res = mysqli_query($con, $sql);
            echo "The group is created successfully";
            header('location:main_page_supervisor.php');
            break;
        }
    }
}

if (isset($_POST['delete'])) {
    $group_id = get_safe_value($con, $_POST['group_id']);
    mysqli_query($con, "DROP TABLE group$group_id");
    mysqli_query($con, "DELETE FROM group_list WHERE group_id =$group_id");
    mysqli_query($con, "DELETE FROM assign_task WHERE group_id =$group_id");
    mysqli_query($con, "DELETE FROM submit_task WHERE group_id =$group_id");
}


if (isset($_POST['add_member'])) {
    $group_id = get_safe_value($con, $_POST['group_id']);
    $student_id = get_safe_value($con, $_POST['student_id']);

    $res = mysqli_query($con, "select * from registration_pending where st_id='$student_id'");
    $row = mysqli_fetch_assoc($res);
    $st_name = $row['st_name'];
    $st_id = $row['st_id'];
    $st_email = $row['st_email'];
    $st_password = $row['st_password'];
    $st_department = $row['st_department'];
    $st_year = $row['st_year'];
    $st_degree = $row['st_degree'];
    $st_image = $row['st_image'];

    $group = "group$group_id";

    $sql5 = "INSERT INTO $group (`st_name`, `st_id`) VALUES ('$st_name', '$st_id')";
    $res = mysqli_query($con, $sql5);
    $sql3 = "INSERT INTO `registration_complete` (`st_name`, `st_id`, `st_email`,`st_password`, `st_department`, `st_year`, `st_degree`, `st_image`) VALUES ('$st_name', '$st_id', '$st_email',  '$st_password', '$st_department', '$st_year', '$st_degree', '$st_image')";
    $res = mysqli_query($con, $sql3);

    $sql4 = "DELETE FROM `registration_pending` WHERE `registration_pending`.`st_id` = $st_id";
    $res = mysqli_query($con, $sql4);

    header('location:main_page_supervisor.php');

}


$sql2 = "select * from registration_pending";
$res = mysqli_query($con, $sql2);

?>


<!DOCTYPE html>
<html>

<head>
    <title>Main page supervisor</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


    <style>
        .left-section {
            float: left;
            width: 80%;
            height: 1750px;
            overflow-y: scroll;
        }

        .right-section {
            float: right;
            width: 20%;
            height: 1750px;
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
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
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

<body style="background: linear-gradient(to bottom, #bdbcbc, #dad8d8, #e5e5e5);">
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
        <div style=" background-color: gray; height : 70px;margin-left:70px;margin-right : 350px;">
            <p
                style="text-align : left; margin-left : 15px;margin-top:10px;margin-bottom:0 ; padding:22px 7px ; color:white; font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Create group</p>
        </div>
    </div>


    <div class="left-section">
        <div style="height : auto ; display: flex; margin-top: 125px;">
            <div style=" width: 65%;margin-left: 125px">
                <table style="">
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
            <form method="post" enctype="multipart/form-data"
                style="width: 35%; height: 140px;border-radius: 5px;margin-left: 50px;margin-right: 100px">
                <div class="form-group">
                    <label style="margin: 2px 0; font-size: 15px; ">Name</label>
                    <input
                        style="margin: 5px 0; font-style: italic; height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="group_name" class="form-control" placeholder="Enter group name" required>
                </div>
                <button
                    style="width: 25%; background-color: black;color: white;padding: 6px 10px;margin: 20px 0;border-radius: 2px;"
                    type="submit" name="create" class="cta-btn cta-btn-signup">create</button>
            </form>
        </div>


        <div style=" background-color: #adadad; height : 65px; margin-left : 70px; margin-right: 62px;margin-top: 100px">
            <h2
                style="text-align : left; margin-left : 5px;margin-bottom:0 ; padding: 20px;font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Add Member</h2>
        </div>



        <div style="height : auto; margin-top : 90px; display: flex;">

            <form method="post" enctype="multipart/form-data"
                style="width: 35%;height: 140px; border-radius: 5px;margin-left: 125px ">
                <div class="form-group">
                    <input
                        style="margin: 3px 0;font-style: italic; height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="group_id" class="form-control" placeholder="Group id" required>
                </div>
                <div class="form-group">
                    <input
                        style="margin: 5px 0;font-style: italic;height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="student_id" class="form-control" placeholder="Student id" required>
                </div>
                <button
                    style="width: 20%; background-color: black;color: white;padding: 6px 10px;margin: 15px 0;border-radius: 2px;"
                    type="submit" name="add_member" class="cta-btn cta-btn-signup">add</button>
            </form>

            <form method="post" enctype="multipart/form-data"
                style="width: 30%; height: 135px;border-radius: 5px;margin-left: 50px;margin-right: 100px">
                <div class="form-group">
                    <label style="margin: 2px 0; font-size: 15px; ">Group id</label>
                    <input
                        style="margin: 5px 0; font-style: italic; height: 40px; width: 100%; background-color:  #F3F3F3; text-align: left;"
                        type="text" name="group_id" class="form-control" placeholder="Group id" required>
                </div>
                <button
                    style="width: 22%; background-color: black;color: white;padding: 6px 10px;margin: 20px 0;border-radius: 2px;"
                    type="submit" name="delete" class="cta-btn cta-btn-signup">delete</button>
            </form>

        </div>

        <div style="height : auto; margin-top : 75px; ">

            <table
                style="width : 82%; margin-left: 125px; margin-right: 50px; margin-bottom : 150px;margin-top: 75px; border-collapse: separate; border-spacing: 0 10px;">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Degree</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr style="margin-top : 20px;">
                            <td>
                                <?php echo $row['st_id'] ?>
                            </td>
                            <td style="text-transform: none;">
                                <?php echo $row['st_name'] ?>
                            </td>
                            <td style="text-transform: none;">
                                <?php echo $row['st_email'] ?>
                            </td>
                            <td style="text-transform: none;">
                                <?php echo $row['st_department'] ?>
                            </td>
                            <td style="text-transform: none; margin-right: 50px">
                                <?php echo $row['st_degree'] ?>
                            </td>
                            <td>
                                <?php echo $row['st_year'] ?>
                            </td>
                            <?php $i = $i + 1 ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>


    <div class="right-section">
        <?php
        $s_email = $_SESSION['email'];
        $s_password = $_SESSION['password'];
        $sql = "select * from supervisor_registration where s_email='$s_email' and s_password='$s_password'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>

        <div class="team-section" style="margin-top: 50px;margin-left: 10px">
            <div class="member">
                <img src="farah.jpg" alt="Member 1" style="margin-bottom: 40px;">
                <?php echo $row['s_name']; ?>
                <br></br>
                <?php echo $row['s_status']; ?>
                <br></br>
                <?php echo $row['s_department']; ?>
                <br></br>
                <?php echo $row['s_institution']; ?>
                <br></br>
                <ion-icon name="mail"></ion-icon>
                <?php echo $row['s_email']; ?>
            </div>
        </div>
    </div>

    <footer style="margin-top : 1760px; height: 110px; padding-top: 50px">
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