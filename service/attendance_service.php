<?php
require "../database/index.php";

if (isset($_POST["insert_attendance"])) {
    $id_attendance = uniqid();
    $title_short = $_POST["title_short"];
    $date_attendance = $_POST["date_attendance"];
    $time_attendance = $_POST["time_attendance"];
    $name_subject = $_POST["name_subject"];
    $name_lecturer = $_POST["name_lecturer"];
    $email_lecturer = $_POST["email_lecturer"];
    $room_latitude = $_POST["room_latitude"];
    $room_longitude = $_POST["room_longitude"];
    $max_radius = $_POST["max_radius"];
    $date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO tbl_attendance_list (id_attendance, title_short, date_attendance, time_attendance, name_subject, name_lecturer, email_lecturer, room_latitude, room_longitude, max_radius, created_at) VALUES ('$id_attendance','$title_short', '$date_attendance', '$time_attendance', '$name_subject', '$name_lecturer', '$email_lecturer','$room_latitude','$room_longitude','$max_radius','$date')";

    if ($conn->query($sql)) {
        mysqli_close($conn);
        $res = [
            'status' => 200,
            'message' => "Data inserted successfuly!!"
        ];
        echo json_encode($res);
        return;
    } else {
        $error_message = $conn->error;
        mysqli_close($conn);
        $res = [
            'status' => 500,
            'message' => "$error_message"
        ];
        echo json_encode($res);
        return;
    }
}
