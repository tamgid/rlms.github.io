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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha384-D/IMc6s7VnsKtjSSXd7T8Xvzve0tVav0sTjKtWx78t0B+YRbMgn0JF2WxrXvOf4H" crossorigin="anonymous">
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

</head>

<body style="background: linear-gradient(to bottom, #b5b5b5, #c3c3c3, #cccccc);">
    <header style="padding: 5px; margin-left:0px">
        <img style="height : 55px" src="culogo.png" alt="">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="main_page_supervisor.php">Create group</a></li>
                <li><a href="group.php">Groups</a></li>
                <li><a href="file_manager.php">File manager</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="announcement.php">Announcement</a></li>
                <li><a href="researchers.php">Researchers</a></li>
                <li><a href="researchers_schedule.php">Researchers Schedules</a></li>
                <li style="margin-right: 270px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>


    <div style=" background-color: #404040; height : 40px;margin-left:0px ;padding-top:85px">
        <div style=" background-color: gray; height : 75px;margin-left:100px;margin-right : 100px;">
            <p
                style="text-align : left; margin-left : 20px;margin-top:0px;margin-bottom:0 ; padding:25px 16px ; color:white; font-size: 24px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                File management</p>
        </div>
    </div>

    <div class="container" style="  height: auto;display: flex;margin-top:35px">
        <div style="width: 65%; ">
            <div class="container" style=" height: auto;display: flex;">
                <div style="width: 40%; margin-top: 100px;text-align:left; margin-left: 200px">
                    <h3>Folder</h3>
                    <?php
                    $name[] = array();
                    $name[1] = "B.Sc";
                    $name[2] = "M.Sc";
                    $name[3] = "PhD";

                    for ($i = 1; $i < 4; $i++) { ?>
                        <!-- <ion-icon name="folder"></ion-icon> -->
                        <?php
                        echo '<div style="font-size: 19px;margin-top: 40px;">' . "<span class='badge badge-complete'><a href='file_manager.php?type=file&id=" . $i . "'>$name[$i]</a></span>" . '</div>';
                    }
                    ?>
                </div>
                <div style="width: 40%; margin-top: 100px;margin-left:0px ;text-align:left">
                    <h3>File</h3>
                    <?php
                    if (isset($_GET['type']) && $_GET['type'] != '') {
                        $type = get_safe_value($con, $_GET['type']);
                        if ($type == 'file') {
                            $id = get_safe_value($con, $_GET['id']);
                            if ($id == 1) {
                                $sql4 = "select * from assign_task";
                                $res4 = mysqli_query($con, $sql4);
                                if ($res4) {
                                    if (mysqli_num_rows($res4) > 0) {
                                        $p = 0;
                                        while ($row4 = mysqli_fetch_assoc($res4)) {
                                            $group_id = $row4['group_id'];
                                            $sql5 = "select * from group$group_id";
                                            $res5 = mysqli_query($con, $sql5);
                                            $row5 = mysqli_fetch_assoc($res5);
                                            $st_id = $row5['st_id'];
                                            $sql6 = "select * from registration_complete where st_id=$st_id";
                                            $res6 = mysqli_query($con, $sql6);
                                            $row6 = mysqli_fetch_assoc($res6);
                                            $degree = $row6['st_degree'];
                                            if ($degree == "B.Sc") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row4['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                <a href="uploads/<?= $row4['task_file_link'] ?>">Open File</a>
                                                <br></br>
                                                <?php

                                            }
                                            $p++;
                                        }

                                    }
                                }
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
                                            $sql9 = "select * from registration_complete where st_id=$st_id";
                                            $res9 = mysqli_query($con, $sql9);
                                            $row9 = mysqli_fetch_assoc($res9);
                                            $degree = $row9['st_degree'];
                                            if ($degree == "B.Sc") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row7['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                <a href="uploads/<?= $row7['task_file_link'] ?>">Open File</a>
                                                <br></br>
                                                <?php

                                            }
                                            $p++;
                                        }

                                    }
                                }
                            } else if ($id == 2) {
                                $sql4 = "select * from assign_task";
                                $res4 = mysqli_query($con, $sql4);
                                if ($sql4) {
                                    if (mysqli_num_rows($res4) > 0) {
                                        $p = 0;
                                        while ($row4 = mysqli_fetch_assoc($res4)) {
                                            $group_id = $row4['group_id'];
                                            $sql5 = "select * from group$group_id";
                                            $res5 = mysqli_query($con, $sql5);
                                            $row5 = mysqli_fetch_assoc($res5);
                                            $st_id = $row5['st_id'];
                                            $sql6 = "select * from registration_complete where st_id=$st_id";
                                            $res6 = mysqli_query($con, $sql6);
                                            $row6 = mysqli_fetch_assoc($res6);
                                            $degree = $row6['st_degree'];
                                            if ($degree == "M.Sc") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row4['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                    <a href="uploads/<?= $row4['task_file_link'] ?>">Open File</a>
                                                    <br></br>
                                                <?php
                                            }
                                            $p++;
                                        }

                                    }
                                }
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
                                            $sql9 = "select * from registration_complete where st_id=$st_id";
                                            $res9 = mysqli_query($con, $sql9);
                                            $row9 = mysqli_fetch_assoc($res9);
                                            $degree = $row9['st_degree'];
                                            if ($degree == "M.Sc") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row7['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                    <a href="uploads/<?= $row7['task_file_link'] ?>">Open File</a>
                                                    <br></br>
                                                <?php

                                            }
                                            $p++;
                                        }

                                    }
                                }
                            } else if ($id == 3) {
                                $sql4 = "select * from assign_task";
                                $res4 = mysqli_query($con, $sql4);
                                if ($sql4) {
                                    if (mysqli_num_rows($res4) > 0) {
                                        $p = 0;
                                        while ($row4 = mysqli_fetch_assoc($res4)) {
                                            $group_id = $row4['group_id'];
                                            $sql5 = "select * from group$group_id";
                                            $res5 = mysqli_query($con, $sql5);
                                            $row5 = mysqli_fetch_assoc($res5);
                                            $st_id = $row5['st_id'];
                                            $sql6 = "select * from registration_complete where st_id=$st_id";
                                            $res6 = mysqli_query($con, $sql6);
                                            $row6 = mysqli_fetch_assoc($res6);
                                            $degree = $row6['st_degree'];
                                            if ($degree == "PhD") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row4['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                        <a href="uploads/<?= $row4['task_file_link'] ?>">Open File</a>
                                                        <br></br>
                                                <?php
                                            }
                                            $p++;
                                        }

                                    }
                                }
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
                                            $sql9 = "select * from registration_complete where st_id=$st_id";
                                            $res9 = mysqli_query($con, $sql9);
                                            $row9 = mysqli_fetch_assoc($res9);
                                            $degree = $row9['st_degree'];
                                            if ($degree == "PhD") {

                                                echo '<div style="text-align:left;margin-left: 100px ;margin-top : 12px; font-size: 18px">' . "Title : " . $row7['task_title'] . '</div>';
                                                // echo $row4['task_title'];?>
                                                        <a href="uploads/<?= $row7['task_file_link'] ?>">Open File</a>
                                                        <br></br>
                                                <?php

                                            }
                                            $p++;
                                        }

                                    }
                                }
                            }
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
        <div class="text" style="width: 20%;padding: 0 40px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 140px; background-color: #cdcdcd; height: auto; color: black; font-size: 19px;
        ">
            <h2>Uploaded Files in the Research Lab</h2>
            <p style="text-align : left; margin-top: 40px">This web page is a repository of all the files that have been
                uploaded so far by our research lab. Here, you can access all the relevant files that have been shared
                by the lab members. This collection includes research papers, project reports, presentations, and any
                other relevant files. It is a convenient and efficient way to access the files, as all the relevant
                information is available in one place.
            </p>
        </div>
    </div>



    <footer style="margin-top : 150px; height: 110px; padding-top: 60px">
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