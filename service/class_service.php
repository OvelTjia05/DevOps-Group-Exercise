<?php
require "../database/index.php";

if (isset($_POST["insert_class"])) {
    $id_class = uniqid();
    $code_class = $_POST["code_class"];
    $name_subject = $_POST["name_subject"];
    $email_lecturer = $_POST["email_lecturer"];
    $name_lecturer = $_POST["name_lecturer"];
    $fakultas = $_POST["fakultas"];
    $prodi = $_POST["prodi"];
    $sks = $_POST["sks"];
    $building_room = $_POST["building_room"];
    $room_latitude = $_POST["room_latitude"];
    $room_longitude = $_POST["room_longitude"];
    $jadwal_class_day_time = $_POST["jadwal_class_day_time"];
    $daftar_email_student = $_POST["daftar_email_student"];
    $status_class = "Active";
    $date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO tbl_classes (id_class, code_class, name_subject, email_lecturer, name_lecturer, fakultas, prodi, sks, building_room, room_latitude, room_longitude, jadwal_class_day_time, daftar_email_student, status_class, created_at) VALUES ('$id_class', '$code_class', '$name_subject', '$email_lecturer', '$name_lecturer', '$fakultas', '$prodi', '$sks', '$building_room', '$room_latitude', '$room_longitude', '$jadwal_class_day_time', '$daftar_email_student', '$status_class', '$date')";

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
