<?php
require "../database/index.php";

if (isset($_POST["insert_operator"])) {
    $nip = $_POST["nip"];
    $email = $_POST["email"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
    $role = $_POST["role"];
    $date = date('Y-m-d H:i:s');


    $sql = "INSERT INTO tbl_operator (nip, email, fullname, password, phone_number, role, created_at, updated_at) VALUES ('$nip', '$email', '$email', '$fullname', '$password', '$phone_number','$date', '$date')";

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
