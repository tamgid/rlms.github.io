<?php require_once('db-connect.php') ?>

<?php
session_start();
$st_email = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];
    $group_id = $_SESSION['group_id'];
    $sql = "INSERT INTO schedule_request (title,`description`,`start_datetime`,`end_datetime`,`group_id`,`created_by`) VALUES ('$title','$description','$start_datetime','$end_datetime','$group_id','$st_email')";
    $res = mysqli_query($conn, $sql);


    require 'mail.php';
    $s_email = "tamgid311@gmail.com";
    $mail->addAddress($s_email);

    $mail->Subject = "Schedule is set for you !";
    $mail->Body = "Dear sir,\n\nI hope this email finds you well. I am writing to request a meeting with you.If this date and time are not convenient for you, please let me know your availability and I will adjust my schedule accordingly.\n\nThank you for your time and consideration.\n\nBest regards,\n" . $st_email . "\n\n";
    $mail->send();
    $mail->clearAddresses();


    header('location:student_schedule.php');

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: auto;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        header {
            background-color: #333;
            color: rgb(82, 80, 80);
            text-align: center;
            padding: 0px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav li {
            float: right;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            height: 50px;
            margin-right: 0px;
        }

        h3 {
            margin: 0;
        }

        body {
            /* background-image: url("image5.jpg"); */
            background-size: cover;
            background-repeat: no-repeat;
        }

        nav a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
    </style>
</head>

<body style="background:rgb(160, 172, 183);">

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


    <div style="background-color: #404040; height: 120px; margin-left: 0px; padding-top: 80px;margin-bottom: 140px;">
        <div style="background-color: gray; height: 70px; margin-left: 95px; margin-right: 95px;">
            <p
                style="text-align: left; margin-left: 20px; margin-top: 0px; margin-bottom: 0; padding: 22px 7px; color: white; font-size: 20px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Set Schedules
            </p>
        </div>
    </div>


    <div class="container py-5" id="page-container ; " style="margin-left: 70px; width : 80%">
        <div class="row" style="margin-right: 0px;">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light"
                        style="margin-top: 10px; background-color:rgb(160, 172, 183); height: 30px">
                        <h5 class="card-title" style="color: black; font-size: 20px; margin-left: 90px">Schedule Form
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="student_schedule.php" method="post" id="schedule-form" style="width : 350px; height : 500px;
                            border-radius: 10px; margin-top: 20px ;">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label" style="margin-top: 15px;font-family: Times New Roman; 
                                     font-size: 16px;">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title"
                                        style="margin-left: 0px ; margin-top : 5px ; width : 100% ; text-align: left;"
                                        id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label" style="margin-top: 0px;font-family: Times New Roman; 
                                     font-size: 16px;">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description"
                                        style="margin-left: 0px ; margin-top : 5px" id="description"
                                        required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label" style="margin-top: 0px;font-family: Times New Roman; 
                                     font-size: 16px;">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0"
                                        style="margin-left: 0px ; margin-top : 5px" name="start_datetime"
                                        id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label" style="margin-top: 0px;font-family: Times New Roman; 
                                     font-size: 16px;">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0"
                                        style="margin-left: 0px ; margin-top : 5px" name="end_datetime"
                                        id="end_datetime" required>
                                </div>

                                <div class="text-center" style="margin: 35px;">
                                    <button class="btn btn-primary btn-sm rounded-0" type="submit" name="save"
                                        form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                    <button class="btn btn-default border btn-sm rounded-0" type="reset"
                                        style="margin-left: 100px; " form="schedule-form"><i class="fa fa-reset"></i>
                                        Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal" style="margin-top: 100px">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title" style="margin-top: 15px;">Schedule Details</h5>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit"
                            data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete"
                            data-id="">Delete</button>
                        <button onclick="location.href='schedule.php'">close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer style="margin-top : 200px; height: 180px; padding-top: 65px ; ">
        <div class="container">
            <p class="text-center" style="font-size: 16px">
                Contact Us:
                <a href="mailto:info@researchlab.com"><ion-icon name="mail"></ion-icon> info@researchlab.com</a>
                |
                <span><ion-icon name="call"></ion-icon> (123) 456-7890</span>
            </p>
            <p class="text-center" style="font-size: 16px">
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



    <?php
    $schedules = $conn->query("SELECT * FROM schedule_list");
    $sched_res = [];
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[$row['id']] = $row;
    }
    ?>
    <?php
    if (isset($conn))
        $conn->close();
    ?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>