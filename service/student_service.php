<?php
require "../database/index.php";

if(isset($_POST["insert_student"])){
    $reg_number = $_POST["reg_number"];
    $nim_number = $_POST["nim_number"];
    $email = $_POST["email"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $date = date('Y-m-d H:i:s');
    

    $sql = "INSERT INTO tbl_students (reg_number, nim_number, email, fullname, password, created_at, updated_at) VALUES ('$reg_number', '$nim_number', '$email', '$fullname', '$password', '$date', '$date')";

    if($conn->query($sql)){
        mysqli_close($conn);
        $res = [
            'status' => 200,
            'message' => "Data inserted successfuly!!"
        ];
        echo json_encode($res);
        return;
    } else {
        mysqli_close($conn);
        $res = [
            'status' => 500,
            'message' => "Something wrong!!"
        ];
        echo json_encode($res);
        return;
    }
}
?>