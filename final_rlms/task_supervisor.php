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
    <title>Task Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
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
    <header style="padding: 5px; margin-left:0px; font-size :15px">
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
                Submitted Task</p>
        </div>
    </div>


    <div style="height: auto; display: flex; margin-top: 30px; ">
        <div style="width : 70%; margin-left : 120px;background-color: #cfcece;">
            <table
                style="margin-top : 100px; width : 75%;margin-left : 100px;border-collapse: separate; border-spacing: 0 10px; ">
                <thead>
                    <tr>
                        <th>Group_name</th>
                        <th>Member info</th>
                        <th>Task</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 1; $i < 100; $i++) {
                        $sql2 = "select * from group$i";
                        $result = mysqli_query($con, $sql2);
                        if ($result && mysqli_num_rows($result) > 0) { ?>
                            <tr>
                                <td style="text-transform: none;">
                                    <?php
                                    $sql3 = "select * from group_list where group_id=$i";
                                    $result = mysqli_query($con, $sql3);
                                    $row = mysqli_fetch_assoc($result);
                                    echo $row['group_name'];
                                    ?>
                                </td>
                                <td>
                                    <?php

                                    echo "<span class='badge badge-complete'><a href='group.php?type=info&id=" . $i . "'>Member</a></span>";

                                    ?>
                                </td>
                                <td>
                                    <?php

                                    echo "<span class='badge badge-complete'><a href='task_supervisor.php?type=task&id=" . $i . "'>Task</a></span>";

                                    ?>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>

        </div>
        <div style="width: 30%;padding: 0 35px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 120px; background-color: #cfcece; height: auto; color: black; font-size: 18px;">
            <h3 style="margin-top : 100px; text-align: center;">Unveiling the Dynamic Work of Our Research Lab Team</h3>
            <p style="font-family : 40px; margin-top: 40px">At our research lab, we are dedicated to advancing
                scientific understanding and making a difference in the world. Our team of talented researchers,
                engineers, and scientists work tirelessly on a range of projects and tasks, each contributing their
                unique expertise and skills to the lab's collective effort. From conducting experiments and analyzing
                data to developing new technologies and collaborating on cutting-edge research initiatives, we are
                committed to pushing the boundaries of what is possible. Join us on a journey of discovery as we
                showcase the multifaceted and impactful work being done by the members of our research lab.</p>
        </div>
    </div>


    <table style="margin-top : 100px; width : 50%;margin-left : 220px; margin-bottom:100px">
        <thead>
            <tr>
                <th>Task id</th>
                <th>Task title</th>
                <th>Task file</th>
                <th>Student submitted file</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['type']) && $_GET['type'] != '') {
                $type = get_safe_value($con, $_GET['type']);
                if ($type == 'task') {
                    $id = get_safe_value($con, $_GET['id']);
                    $sql1 = "select * from assign_task where group_id=$id";
                    $res1 = mysqli_query($con, $sql1);
                    $i = 1;
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $id = $row1['task_id'];
                        $sql5 = "select * from submit_task where task_id=$id";
                        $res4 = mysqli_query($con, $sql5);
                        $row = mysqli_fetch_assoc($res4);
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
                                <a href="uploads/<?= $row['submitted_file_link'] ?>">Open submitted file</a>
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
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>


    <footer style="margin-top : 200px; height: 110px; padding-top: 50px">
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