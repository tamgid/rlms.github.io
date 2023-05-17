<?php
require('connection.inc.php');
require('functions.inc.php');
// $id = '';
// $rows = '';

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'approve') {
        $email = get_safe_value($con, $_GET['id']);
        echo $email;
        $sql11 = "select * from schedule_request";
        $res11 = mysqli_query($con, $sql11);
        $p = 1;
        while ($row11 = mysqli_fetch_assoc($res11)) {
            $email_st = $row11['created_by'];
            if ($email == $email_st) {
                $id = $row11['id'];
                echo $id;
                $title = $row11['title'];
                echo $title;
                $description = $row11['description'];
                $start_datetime = $row11['start_datetime'];
                $end_datetime = $row11['end_datetime'];
                $group_id = $row11['group_id'];
                $sql12 = "INSERT INTO schedule_list (title,`description`,`start_datetime`,`end_datetime`,`group_id`,`created_by`) VALUES ('$title','$description','$start_datetime','$end_datetime','$group_id','supervisor')";
                $res12 = mysqli_query($con, $sql12);
                $sql4 = "DELETE FROM `schedule_request` WHERE `id` = $id";
                $res = mysqli_query($con, $sql4);
                header('location:researchers_schedule.php');
            }
        }
    }

}

// $sql="select * from supervisor";
// $res=mysqli_query($con,$sql);
?>