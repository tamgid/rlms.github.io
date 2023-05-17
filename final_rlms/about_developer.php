<!DOCTYPE html>
<html>

<head>
    <title>About Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
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
            width: 180px;
            height: 180px;
            border-radius: 0%;
        }

        .text-container {
            width: 50%;
            padding-left: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            line-height: 1.5;
        }
    </style>

</head>

<body style="background: linear-gradient(to bottom, #c6c6c6, #d0d0d1, #ffffff);">
    <header style="padding: 5px; margin-left:0px">
        <img style="height : 55px" src="culogo.png" alt="">
        <nav>
            <ul>
                <li><a href="home.php">Research home <ion-icon name="home"></ion-icon></a></li>
                <li><a href="about_developer.php">About developer</a></li>
                <li><a href="about_research.php">About Research</a></li>
                <li style="margin-right: 790px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>


    <div style=" background-color: #404040; height : 40px;margin-left:0px ;padding-top:85px">
        <div style=" background-color: gray; height : 90px;margin-left:150px;margin-right : 150px;">
            <p
                style="text-align : left; margin-left : 20px;margin-top:0px;margin-bottom:0 ; padding:25px 18px ; color:white; font-size: 27px;font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif">
                Our developer</p>
        </div>
    </div>







    <div style=" color: rgb(249, 244, 244); height: 1000px;display: flex; margin-top: 50px;">
        <div style="width: 70%; margin-left: 155px;margin-top:30px;color : black;">
            <div class="image-and-text-container">
                <img src="person1.jpg" alt="image description" class="image">
                <div class="text-container" style="margin-top:10px; margin-left: 20px">
                    <h3 style="text-align : left">Shadakur Rahman Tamgid</h3>
                    <p>B.Sc in Engineering</p>
                    <p>Department of Computer Science & Engineering</p>
                    <p>University of Chittagong</p>
                    <p><ion-icon name="mail"></ion-icon> tamgid311@gmail.com</p>
                </div>
            </div>
            <div class="image-and-text-container" style="margin-top: 10px;">
                <img src="person3.jpg" alt="image description" class="image">
                <div class="text-container" style="margin-top:10px; margin-left: 20px">
                    <h3 style="text-align : left">Md.Shahin</h3>
                    <p>B.Sc in Engineering</p>
                    <p>Department of Computer Science & Engineering</p>
                    <p>University of Chittagong</p>
                    <p><ion-icon name="mail"></ion-icon> mdsohan1057@gmail.com</p>
                </div>
            </div>
            <div class="image-and-text-container" style="margin-top: 10px;">
                <img src="person2.jpg" alt="image description" class="image">
                <div class="text-container" style="margin-top:10px; margin-left: 20px">
                    <h3 style="text-align : left">H M Imtiaz Uddin</h3>
                    <p>B.Sc in Engineering</p>
                    <p>Department of Computer Science & Engineering</p>
                    <p>University of Chittagong</p>
                    <p><ion-icon name="mail"></ion-icon> hmimtiaz2@gmail.com</p>
                </div>
            </div>
            <div class="image-and-text-container" style="margin-top: 10px;">
                <img src="opi.jpg" alt="image description" class="image">
                <div class="text-container" style="margin-top:10px; margin-left: 20px">
                    <h3 style="text-align : left">Opi Biswas</h3>
                    <p>B.Sc in Engineering</p>
                    <p>Department of Computer Science & Engineering</p>
                    <p>University of Chittagong</p>
                    <p><ion-icon name="mail"></ion-icon> opi311@gmail.com</p>
                </div>
            </div>
            <!-- Add more members as needed -->
        </div>
        <div style="width: 30%;padding: 0 20px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif;background-color:rgba(245, 243, 243, 0.696); margin-right: 150px; color: black; font-size: 40px; margin-top: 0px;
        ">
            <h2>Our Mission</h2>
            <p style="text-align : left; font-size: 20px">At Research Lab Management System, our mission is to
                provide a comprehensive
                solution for managing and
                conducting research in a collaborative and efficient manner. We aim to streamline the process of
                managing
                research projects, handling data, and communicating with team members and stakeholders. Our goal is to
                empower researchers and laboratory staff to focus on what they do best: making ground-breaking
                discoveries
                and advancing science and technology.
            </p>
        </div>
    </div>





    <footer style="margin-top : 100px; height: 110px; padding-top: 60px">
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