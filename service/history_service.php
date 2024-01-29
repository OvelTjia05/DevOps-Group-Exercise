<?php
require "../database/index.php";

if (isset($_POST["insert_history"])) {
    $id_class = uniqid();
    $id_attendance = uniqid();
    $email_student = $_POST["email_student"];
    $name_subject = $_POST["name_subject"];
    $email_lecturer = $_POST["email_lecturer"];
    $student_lat = $_POST["student_lat"];
    $student_long = $_POST["student_long"];
    $distance = $_POST["distance"];
    $time_take_attendance = $_POST["time_take_attendance"];
    $status = $_POST["status"];
    $note = $_POST["note"];
    $date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO tbl_attendance_history (id_class, id_attendance, email_student, name_subject, email_lecturer, student_lat, student_long, distance, time_take_attendance, status, note, created_at) VALUES ('$id_class','$id_attendance','$email_student','$name_subject', '$email_lecturer', '$student_lat', '$student_long', '$distance', '$time_take_attendance','$status','$note','$date')";

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
