<?php
require_once('db-connect.php');
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if (empty($id)) {
    $sql = "INSERT INTO schedule_list (title,`description`,`start_datetime`,`end_datetime`,`group_id`) VALUES ('$title','$description','$start_datetime','$end_datetime','$group_id')";
} else {
    $sql = "UPDATE schedule_list set title = '{$title}', description = '{$description}', start_datetime = '{$start_datetime}', end_datetime = '{$end_datetime}', group_id = '{$group_id}' where id = '{$id}'";
}
$save = $conn->query($sql);
if ($save) {
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
} else {
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}
$conn->close();


require('functions.inc.php');
$group_id = '';
$start_datetime = '';

if(isset($_POST['group_id'])){
    $group_id=$_POST['group_id'];
    $sql9 = "select * from group$group_id";
    $res9 = mysqli_query($conn, $sql9);
    require 'mail.php';
    $i=0;
    while ($row9 = mysqli_fetch_assoc($res9)) {
        $st_id = $row9['st_id'];
        $sql8 = "select * from registration_complete where st_id=$st_id";
        $res8 = mysqli_query($conn, $sql8);
        $row8 = mysqli_fetch_assoc($res8);
        $st_name = $row8['st_name'];
        $st_email = $row8['st_email'];

        
        $mail->addAddress($st_email);

        $mail->Subject = "SignUp Successful";
        $mail->Body = "Dear " . $st_name . ",\n\nWe are delighted to welcome you to our Research Lab! Congratulations on successfully signing up for our platform. Your participation is valuable to us, and we look forward to working with you to achieve your research goals. Our team is always available to support and guide you throughout your journey with us. Don't hesitate to contact us if you have any questions or concerns.\n\nThank you for choosing our platform, and once again, congratulations on joining our community!\n\nBest regards,\nResearch Lab Management Systems Team.\n\n";
        $mail->send();
        $mail->clearAddresses();
        $i++;

    }
}


header('location:schedule.php');
?>