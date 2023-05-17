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
    <title>File Manager</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


    <style>
        /* Style for the folder icons */
        .folder-icon {
            display: inline-block;
            width: 64px;
            height: 64px;
            background-image: url('folder-icon.png');
            background-repeat: no-repeat;
            background-position: center center;
        }

        /* Style for the file list */
        .file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* Style for the individual files */
        .file {
            margin: 10px;
        }
    </style>
    <style>
        .folder {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 75px;
            width: 140px;
            margin: 0 25px;
            background-color: #fff9e9;
            border: 12px solid #EAF2F8;
            border-radius: 20px;
            cursor: pointer;
        }

        .folder:hover {
            background-color: #ddd;
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
            border: 3px solid #dddddd;
            text-align: left;
            padding: 7px;
        }

        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
    </style>

</head>

<body style="background: linear-gradient(to bottom, #c6c6c6, #cfcece, #d8d8d8);">
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
        <div style=" background-color: gray; height : 70px;margin-left:120px;margin-right : 120px;">
            <p
                style="text-align : left; margin-left : 15px;margin-top:10px;margin-bottom:0 ; padding:22px 7px ;color:white; font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                File Manager</p>
        </div>
    </div>


    <div style="height: auto; display: flex;margin-top: 30px;  ">
        <div style="width : 70%; margin-left : 120px;margin-top : 120px;">
            <div class="container" style="display: flex;justify-content: center;align-items: center;height: auto;">
                <div class="folder" onclick="location.href='file_manager.php?type=B.Sc'">
                    <h1>B.Sc</h1>
                </div>
                <div class="folder" onclick="location.href='file_manager.php?type=M.Sc'">
                    <h1>M.Sc</h1>
                </div>
                <div class="folder" onclick="location.href='file_manager.php?type=PhD'">
                    <h1>PhD</h1>
                </div>
            </div>


            <?php


            if (isset($_GET['type'])) {
                $category = $_GET['type'];

                $result1 = array();
                $result2 = array();
                $result3 = array();
                $result4 = array();
                $result5 = array();
                $group_no = array();

                if ($category == "B.Sc") {
                    $sql7 = "select * from submit_task";
                    $res7 = mysqli_query($con, $sql7);
                    if ($res7) {
                        if (mysqli_num_rows($res7) > 0) {
                            $p = 0;
                            while ($row7 = mysqli_fetch_assoc($res7)) {
                                $group_id = $row7['group_id'];
                                $sql8 = "select * from group$group_id";
                                $res8 = mysqli_query($con, $sql8);
                                $row8 = mysqli_fetch_assoc($res8);
                                $st_id = $row8['st_id'];
                                $sql10 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res10 = mysqli_query($con, $sql10);
                                $row10 = mysqli_fetch_assoc($res10);
                                $sql9 = "select * from registration_complete where st_id=$st_id";
                                $res9 = mysqli_query($con, $sql9);
                                $row9 = mysqli_fetch_assoc($res9);
                                $degree = $row9['st_degree'];
                                if ($degree == "B.Sc") {

                                    $result1[] = $row7["task_title"];
                                    $result2[] = $row10["group_name"];
                                    $result3[] = $row7["submitted_file_link"];
                                    $result4[] = "Submitted by group: ";
                                    $result5[] = $row9["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                if ($category == "B.Sc") {
                    $sql11 = "select * from assign_task";
                    $res11 = mysqli_query($con, $sql11);
                    if ($res11) {
                        if (mysqli_num_rows($res11) > 0) {
                            $p = 0;
                            while ($row11 = mysqli_fetch_assoc($res11)) {
                                $group_id = $row11['group_id'];
                                $sql12 = "select * from group$group_id";
                                $res12 = mysqli_query($con, $sql12);
                                $row12 = mysqli_fetch_assoc($res12);
                                $st_id = $row12['st_id'];
                                $sql14 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res14 = mysqli_query($con, $sql14);
                                $row14 = mysqli_fetch_assoc($res14);
                                $sql13 = "select * from registration_complete where st_id=$st_id";
                                $res13 = mysqli_query($con, $sql13);
                                $row13 = mysqli_fetch_assoc($res13);
                                $degree = $row13['st_degree'];
                                if ($degree == "B.Sc") {

                                    $result1[] = $row11["task_title"];
                                    $result2[] = $row14["group_name"];
                                    $result3[] = $row11["task_file_link"];
                                    $result4[] = "Assign to group: ";
                                    $result5[] = $row13["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                if ($category == "M.Sc") {
                    $sql7 = "select * from submit_task";
                    $res7 = mysqli_query($con, $sql7);
                    if ($res7) {
                        if (mysqli_num_rows($res7) > 0) {
                            $p = 0;
                            while ($row7 = mysqli_fetch_assoc($res7)) {
                                $group_id = $row7['group_id'];
                                $sql8 = "select * from group$group_id";
                                $res8 = mysqli_query($con, $sql8);
                                $row8 = mysqli_fetch_assoc($res8);
                                $st_id = $row8['st_id'];
                                $sql10 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res10 = mysqli_query($con, $sql10);
                                $row10 = mysqli_fetch_assoc($res10);
                                $sql9 = "select * from registration_complete where st_id=$st_id";
                                $res9 = mysqli_query($con, $sql9);
                                $row9 = mysqli_fetch_assoc($res9);
                                $degree = $row9['st_degree'];
                                if ($degree == "M.Sc") {

                                    $result1[] = $row7["task_title"];
                                    $result2[] = $row10["group_name"];
                                    $result3[] = $row7["submitted_file_link"];
                                    $result4[] = "Submitted by group: ";
                                    $result5[] = $row9["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                if ($category == "M.Sc") {
                    $sql11 = "select * from assign_task";
                    $res11 = mysqli_query($con, $sql11);
                    if ($res11) {
                        if (mysqli_num_rows($res11) > 0) {
                            $p = 0;
                            while ($row11 = mysqli_fetch_assoc($res11)) {
                                $group_id = $row11['group_id'];
                                $sql12 = "select * from group$group_id";
                                $res12 = mysqli_query($con, $sql12);
                                $row12 = mysqli_fetch_assoc($res12);
                                $st_id = $row12['st_id'];
                                $sql14 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res14 = mysqli_query($con, $sql14);
                                $row14 = mysqli_fetch_assoc($res14);
                                $sql13 = "select * from registration_complete where st_id=$st_id";
                                $res13 = mysqli_query($con, $sql13);
                                $row13 = mysqli_fetch_assoc($res13);
                                $degree = $row13['st_degree'];
                                if ($degree == "M.Sc") {

                                    $result1[] = $row11["task_title"];
                                    $result2[] = $row14["group_name"];
                                    $result3[] = $row11["task_file_link"];
                                    $result4[] = "Assigned to group: ";
                                    $result5[] = $row13["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                if ($category == "PhD") {
                    $sql7 = "select * from submit_task";
                    $res7 = mysqli_query($con, $sql7);
                    if ($res7) {
                        if (mysqli_num_rows($res7) > 0) {
                            $p = 0;
                            while ($row7 = mysqli_fetch_assoc($res7)) {
                                $group_id = $row7['group_id'];
                                $sql8 = "select * from group$group_id";
                                $res8 = mysqli_query($con, $sql8);
                                $row8 = mysqli_fetch_assoc($res8);
                                $st_id = $row8['st_id'];
                                $sql10 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res10 = mysqli_query($con, $sql10);
                                $row10 = mysqli_fetch_assoc($res10);
                                $sql9 = "select * from registration_complete where st_id=$st_id";
                                $res9 = mysqli_query($con, $sql9);
                                $row9 = mysqli_fetch_assoc($res9);
                                $degree = $row9['st_degree'];
                                if ($degree == "PhD") {

                                    $result1[] = $row7["task_title"];
                                    $result2[] = $row10["group_name"];
                                    $result3[] = $row7["submitted_file_link"];
                                    $result4[] = "Submitted by group: ";
                                    $result5[] = $row9["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                if ($category == "PhD") {
                    $sql11 = "select * from assign_task";
                    $res11 = mysqli_query($con, $sql11);
                    if ($res11) {
                        if (mysqli_num_rows($res11) > 0) {
                            $p = 0;
                            while ($row11 = mysqli_fetch_assoc($res11)) {
                                $group_id = $row11['group_id'];
                                $sql12 = "select * from group$group_id";
                                $res12 = mysqli_query($con, $sql12);
                                $row12 = mysqli_fetch_assoc($res12);
                                $st_id = $row12['st_id'];
                                $sql14 = "SELECT * FROM group_list WHERE group_id = $group_id";
                                $res14 = mysqli_query($con, $sql14);
                                $row14 = mysqli_fetch_assoc($res14);
                                $sql13 = "select * from registration_complete where st_id=$st_id";
                                $res13 = mysqli_query($con, $sql13);
                                $row13 = mysqli_fetch_assoc($res13);
                                $degree = $row13['st_degree'];
                                if ($degree == "PhD") {

                                    $result1[] = $row11["task_title"];
                                    $result2[] = $row14["group_name"];
                                    $result3[] = $row11["task_file_link"];
                                    $result4[] = "Assigned to group: ";
                                    $result5[] = $row13["st_name"];
                                }
                                $p++;
                            }

                        }
                    }
                }

                ?>

                <table style="  margin-top : 100px; width : 90%;margin-left : 30px;border:1px;background-color: #c0bbe7">
                    <thead>
                        <tr>
                            <th>Task Title</th>
                            <th>PDF File Link</th>
                            <th>Group Name</th>
                            <th>Student Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($result1); $i++) {
                            ?>
                            <tr>
                                <td style="text-transform: none;">
                                    <?php

                                    echo $result1[$i];
                                    ?>
                                </td>
                                <td>
                                    <a href="uploads/<?= $result3[$i] ?>">Open PDF File</a>
                                </td>
                                <td>
                                    <?php

                                    echo $result2[$i];

                                    ?>
                                </td>
                                <td>
                                    <?php

                                    echo $result5[$i];

                                    ?>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    </tbody>
                </table>

                <?php
            }

            ?>

        </div>
        <div style="width: 30%;padding: 0 35px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 120px; background-color: #cfcece; height: auto; color: black; font-size: 18px;">
            <h3 style="margin-top : 100px; text-align: center;">Welcome to our file repository!</h3>
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