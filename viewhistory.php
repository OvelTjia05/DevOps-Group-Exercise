<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Data History</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Email Student</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Email Lecturer</th>
                    <th class="text-center">Student Latitude</th>
                    <th class="text-center">Student Longitude</th>
                    <th class="text-center">Distance</th>
                    <th class="text-center">Time Take Attendance</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect('localhost','root','130110Ov-', 'db_unklab');

                    if(!$conn){
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM tbl_attendance_history";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['email_student'] . "</td>";
                            echo "<td>" . $row['name_subject'] . "</td>";
                            echo "<td>" . $row['email_lecturer'] . "</td>";
                            echo "<td>" . $row['student_lat'] . "</td>";
                            echo "<td>" . $row['student_long'] . "</td>";
                            echo "<td>" . $row['distance'] . "</td>";
                            echo "<td>" . $row['time_take_attendance'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['note'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else{
                        echo "<tr><td colspan='6'>Tidak ada data History.</td></tr>";
                    }

                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>