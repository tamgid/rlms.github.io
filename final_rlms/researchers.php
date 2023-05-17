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
    <title>Researchers</title>
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
            width: 210px;
            height: 210px;
            border-radius: 0%;
        }

        .text-container {
            width: 50%;
            padding-left: 20px;
        }
    </style>
</head>

<body style="background: linear-gradient(to bottom, #c6c6c6, #cfcece, #d8d8d8);">
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
                <li style="margin-right: 235px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>

    <div style=" background-color: #404040; height : 50px;margin-left:0px ;padding-top:80px">
        <div style=" background-color: gray; height : 70px;margin-left:120px;margin-right : 120px;">
            <p
                style="text-align : left; margin-left : 15px;margin-top:10px;margin-bottom:0 ; padding:22px 7px ;color:white; font-size: 20px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Our People</p>
        </div>
    </div>


    <div class="container" style=" color: rgb(249, 244, 244); height: auto;display: flex;margin-top:30px">
        <img src="member1.jpg" alt="Image" style="width: 65%;height: 500px; margin-left: 120px;">
        <div class="text" style="width: 30%;padding: 0 40px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 120px; background-color: #cdcdcd; height: auto; color: black; font-size: 19px;
        ">
            <h3 style="margin-top: 40px;">Meet Our Research Lab Members: A Diverse and Dedicated Community</h3>
            <p style="text-align : left; margin-top: 30px">Welcome to our research lab's webpage! Here you can find
                information about all of the members who make up our dynamic research community. From accomplished
                researchers to dedicated students, our members come from diverse backgrounds and work together to
                advance our shared mission. We believe in fostering an environment that encourages collaboration,
                creativity, and innovation, and we're excited to share our work with you. Take a look at our members'
                profiles to learn more about their areas of expertise and their contributions to our lab's research
                projects.
            </p>
        </div>
    </div>



    <div style=" color: rgb(249, 244, 244); height: auto;display: flex; margin-top: 50px;">
        <div style="width: 70%; margin-left: 110px;margin-top:0px;color : black;">
            <?php
            $sql = "select * from registration_complete";
            $res = mysqli_query($con, $sql);
            $i = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <div class="image-and-text-container">
                    <img src="uploads/<?= $row['st_image'] ?>" alt="image description" class="image">

                    <div class="text-container"
                        style="margin-top:0px; margin-left: 35px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; font-size: 14px">
                        <?php echo $row['st_name'] ?>
                        <br></br>

                        <?php echo $row['st_degree'] ?>
                        <?php echo " in Engineering"; ?>
                        <br></br>

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