<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</head>

<body>
    <header style="padding: 5px; margin-left:0px">
        <img style="height : 55px" src="culogo.png" alt="">
        <nav>
            <ul>
                <li><a href="home.php">Research home <ion-icon name="home"></ion-icon></a></li>
                <!-- <li><a href="about_developer.php">About developer</a></li> -->
                <li><a href="researchers_home.php">About researchers</a></li>
                <li><a href="about_research.php">About Publications</a></li>
                <li style="margin-right: 620px"><a href="https://cu.ac.bd/">University of Chittagong</a></li>
            </ul>
        </nav>
    </header>

    <div class="container" style="background: #404040; color: rgb(249, 244, 244); height: 500px;display: flex;">
        <img src="home5.jpg" alt="Image" style="width: 70%;height: 470px; margin-left: 130px;margin-top:110px">
        <div class="text" style="width: 30%;padding: 0 20px; font-family: myriad-pro-n6,myriad-pro,myriad,verdana,arial,sans-serif; 
        margin-right: 130px; background-color: #f3f0f0; height: auto; color: black; font-size: 18px; margin-top: 110px;
        ">
            <h3 style="margin-top: 40px;text-align : center;margin-left: 2px">Research Lab Management System</h3>
            <p style="text-align : left; margin-top: 30px;margin-left: 15px ">Our Research Lab Management System project is more than just a tool - it's a
                philosophy, designed to revolutionize the way research is conducted and managed. Our project is built on
                a commitment to making the research process more efficient and effective, providing researchers with the
                tools they need to accelerate their work and make breakthrough discoveries. By providing a centralized
                platform for managing data, communicating with team members, and monitoring progress, our Research Lab
                Management System project enables researchers to work more effectively and efficiently than ever before.
                It is about empowering researchers to achieve their goals and make a real impact on the world.
            </p>
        </div>
    </div>


    <div class="cta" style="background: #f3f0f0; height : 350px;">
        <div class="cta-content" style="margin-top; 750px; margin-right: 575px;margin-left: 150px">
            <h3 style="margin-top : 100px; text-align:center">We seek to provide a creative and
                supportive environment in which ideas are generated and can flourish. Do you ready to enhance your
                research lab experience?</h3>
            <p style="margin-top : 50px; text-align:center">Sign up now to access the best lab management tools and collaborate with your peers on research projects.
            </p>
            <div class="dropdown">
                <a href="#" class="cta-btn cta-btn-signup" style="padding: 13px 25px;background-color: #333;">Sign
                    Up</a>
                <div class="dropdown-content"
                    style="background-color: rgb(107, 104, 104); color : white; border-radius: 0px;">
                    <a href="signup_for_supervisor.php">As a Supervisor</a>
                    <a href="signup_for_student.php">As a Student</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="cta-btn cta-btn-signup" style="background-color: #333;padding: 13px 25px;">Login</a>
                <div class="dropdown-content"
                    style="background-color: rgb(107, 104, 104); color : white; border-radius: 0px; ">
                    <a href="login_for_supervisor.php">As a Supervisor</a>
                    <a href="login_for_student.php">As a Student</a>
                </div>
            </div>
        </div>
    </div>

    <footer style="margin-top : 100px; height: 110px; padding-top: 50px">
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