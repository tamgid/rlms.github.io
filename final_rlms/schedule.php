<?php require_once('db-connect.php') 
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];
    $group_id = $_POST['group_id'];
    $sql = "INSERT INTO schedule_list (title,`description`,`start_datetime`,`end_datetime`,`group_id`,`created_by`) VALUES ('$title','$description','$start_datetime','$end_datetime','$group_id','supervisor')";
    $res = mysqli_query($conn, $sql);
    $sql9 = "select * from group$group_id";
    $res9 = mysqli_query($conn, $sql9);
    require 'mail.php';
    while ($row9 = mysqli_fetch_assoc($res9)) {
        $st_id = $row9['st_id'];
        $sql8 = "select * from registration_complete where st_id=$st_id";
        $res8 = mysqli_query($conn, $sql8);
        $row8 = mysqli_fetch_assoc($res8);
        $st_name = $row8['st_name'];
        $st_email = $row8['st_email'];


        $mail->addAddress($st_email);

        $mail->Subject = "Schedule is set for you !";
        $mail->Body = "Hi " . $st_name . ",\n\nI wanted to let you know that a schedule has been set for you! Please confirm your availability for this meeting.Let me know if you have any questions or concerns.  Thank you for your attention. \n\nBest regards,\nResearch Lab Management Systems Team.\n\n";
        $mail->send();
        $mail->clearAddresses();

    }
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

<body style="background:rgb(188, 200, 211);">

    <header style="padding: 5px; margin-left:0px; font-size: 15px; ">
        <img style="height : 55px ;" src="culogo.png" alt="">
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
                <li style="margin-right: 250px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
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
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light"
                        style="margin-top: 10px; background-color:rgb(188, 200, 211); height: 30px">
                        <h5 class="card-title" style="color: black; font-size: 20px; margin-left: 90px">Schedule Form
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="schedule.php" method="post" id="schedule-form" style="width : 350px; height : 550px;
                            border-radius: 10px; margin-top: 20px ;">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label" style="margin-top: 10px;font-family: Times New Roman; 
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
                                <div class="form-group mb-2">
                                    <label for="group_id" class="control-label" style="margin-top: 0px;font-family: Times New Roman; 
                                     font-size: 16px;">Group id</label>
                                    <input type="text" class="form-control form-control-sm rounded-0"
                                        style="margin-left: 0px ; margin-top : 5px;width : 100%;text-align: left;"
                                        name="group_id" id="group_id" required>
                                </div>
                                <div class="text-center" style="margin: 25px;">
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



    <!-- Event Details Modal -->
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