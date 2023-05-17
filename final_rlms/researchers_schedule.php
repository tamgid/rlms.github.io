<?php
require('functions.inc.php');
$gmail = '';
$ok=1;
require_once('db-connect.php'); 
$ok = 3;


$sql = "SELECT * FROM schedule_request";
$res = mysqli_query($conn, $sql);
?>
<html>

<head>
  <title>Researchers Schedule</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    table,
    th,
    td {
      border: 1px solid white;
      border-collapse: collapse;
    }

    th,
    td {
      background-color: #96D4D4;
    }
  </style>
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

<body style="background: #dad8d8;">


  <header style="padding: 5px; margin-left:0px;font-size: 15px;">
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
        <li style="margin-right: 270px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
      </ul>
    </nav>
  </header>



  <div style="background-color: #404040; height: 120px; margin-left: 0px; padding-top: 80px;margin-bottom: 100px;">
    <div style="background-color: gray; height: 70px; margin-left: 100px; margin-right: 100px;">
      <p
        style="text-align: left; margin-left: 20px; margin-top: 0px; margin-bottom: 0; padding: 22px 7px; color: white; font-size: 20px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
        Schedule Request
      </p>
    </div>
  </div>

  <div style="height: auto; margin-top: 125px;">
    <div style="width: 85%; margin-left: 195px">
      <div class="row">
        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
          <div class="card" style="width: 20rem;margin-right:30px; margin-bottom:30px;background: #e6e6e6;">
            <div class="card-body">
              <h5 class="card-title">
                <?php echo $row['title'] ?>
              </h5>
              <h6 class="card-subtitle mb-2 text-muted">
                <?php echo $row['description'] ?>
              </h6>
              <p class="card-text">Start Time:
                <?php echo $row['start_datetime'] ?>
              </p>
              <p class="card-text">End Time:
                <?php echo $row['end_datetime'] ?>
              </p>
              <p class="card-text">Group ID:
                <?php echo $row['group_id'] ?>
              </p>
              <p class="card-text">Requested By:
                <?php echo $row['created_by'] ?>
              </p>
              <?php

              echo "<span class='badge badge-complete'><a href='approve.php?type=approve&id=" . $row['created_by'] . "'>Task</a></span>";

              ?>

            </div>
          </div>

        <?php } ?>

      </div>
    </div>
  </div>

  




  <footer style="margin-top : 100px; height: 180px; padding-top: 60px">
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