<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kehadiran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Data Kehadiran</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Title</th>
                    <th class="text-center">Date Attendance</th>
                    <th class="text-center">Time Attendance</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Name Lecturer</th>
                    <th class="text-center">Email Lecturer</th>
                    <th class="text-center">Room Latitude</th>
                    <th class="text-center">Room Longitude</th>
                    <th class="text-center">Max Radius</th>
                    <th class="text-center">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect('localhost','root','130110Ov-', 'db_unklab');

                    if(!$conn){
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM tbl_attendance_list";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['title_short'] . "</td>";
                            echo "<td>" . $row['date_attendance'] . "</td>";
                            echo "<td>" . $row['time_attendance'] . "</td>";
                            echo "<td>" . $row['name_subject'] . "</td>";
                            echo "<td>" . $row['name_lecturer'] . "</td>";
                            echo "<td>" . $row['email_lecturer'] . "</td>";
                            echo "<td>" . $row['room_latitude'] . "</td>";
                            echo "<td>" . $row['room_longitude'] . "</td>";
                            echo "<td>" . $row['max_radius'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "</tr>";
                        }
                    } else{
                        echo "<tr><td colspan='6'>Tidak ada data kehadiran.</td></tr>";
                    }

                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>