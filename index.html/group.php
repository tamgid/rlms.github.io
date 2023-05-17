<?php
require('connection.inc.php');
require('functions.inc.php');

if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {

} else {
    header('location:login.php');
    die();
}

$res1 = '';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Group page</title>
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
    <style>
        .image-and-text-container {
            display: flex;
            align-items: left;
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
        }

        .image {
            width: 200px;
            height: 200px;
            border-radius: 0%;
        }

        .text-container {
            width: 50%;
            padding-left: 20px;
        }
    </style>
</head>

<body style="background: linear-gradient(to bottom, #c6c6c6, #cfcece, #d8d8d8);">
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
                Our people</p>
        </div>
    </div>


    <div style="height: auto; display: flex;margin-top: 30px;  ">
        <div style="width : 70%; margin-left : 120px;background-color: #cfcece;">
            <table
                style="  margin-top : 100px; width : 75%;margin-left : 100px;border-collapse: separate; border-spacing: 0 10px;">
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
        <div
            style="width: 30%;padding: 0 35px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 120px; background-color: #cfcece; height: auto; color: black; font-size: 18px;">
            <h3 style="margin-top : 100px; text-align: center;">Meet the Talented Minds of Our Lab</h3>
            <p style="font-family : 40px; margin-top: 40px">Welcome to our research lab, where a team of diverse and
                passionate
                individuals come together to push the
                boundaries of knowledge and innovation. Our lab is made up of a talented and dedicated group of
                researchers, engineers, and scientists, each bringing their unique skills and perspectives to the table.
                With a shared goal of making a difference through cutting-edge research and discovery, we believe in the
                power of collaboration and teamwork to solve complex problems and advance scientific understanding. Join
                us on a journey of exploration and discovery as we introduce you to the brilliant minds behind our
                research lab, who are working to make the world a better place.</p>
        </div>
    </div>



    <div style=" color: rgb(249, 244, 244); height: auto;display: flex; margin-top: 50px;">
        <div style="width: 70%; margin-left: 100px;margin-top:0px;color : black;">
            <?php
            if (isset($_GET['type']) && $_GET['type'] != '') {
                $type = get_safe_value($con, $_GET['type']);
                if ($type == 'info') {
                    $id = get_safe_value($con, $_GET['id']);
                    $sql1 = "select * from group$id";
                    $res1 = mysqli_query($con, $sql1);
                    $i = 1;
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $id = $row1['st_id'];
                        $sql5 = "select * from registration_complete where st_id=$id";
                        $res4 = mysqli_query($con, $sql5);
                        $row = mysqli_fetch_assoc($res4);
                        ?>
                        <div class="image-and-text-container">
                            <img src="uploads/<?= $row['st_image'] ?>" alt="image description" class="image">

                            <div class="text-container"
                                style="margin-top:0px; margin-left: 25px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; font-size: 14px">
                                <?php echo $row['st_name'] ?>
                                <br></br>
                                <!-- <?php echo "Id : "; ?>
                                                                    <?php echo $row['st_id'] ?>
                                                                    <br></br> -->
                                <?php echo $row['st_degree'] ?>
                                <?php echo " in Engineering"; ?>
                                <br></br>
                                <!-- <?php echo "Year : "; ?>
                                                                    <?php echo $row['st_year'] ?>
                                                                    <br></br> -->
                                <?php echo $row['st_department'] ?>
                                <br></br>
                                <?php echo "University of Chittagong"; ?>
                                <br></br>

                                <ion-icon name="mail"></ion-icon>
                                <?php echo $row['st_email'] ?>
                                <br></br>
                                <a href="#" class="cta-btn cta-btn-signup"
                                    style="padding: 9px 6px;background-color: #333; font-size: 12px; margin-top: 0px; margin-left: 0px">Read
                                    more <ion-icon name="chevron-forward"></ion-icon></a>

                            </div>
                        </div>

                        <?php $i = $i + 1 ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

        </div>

    </div>



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