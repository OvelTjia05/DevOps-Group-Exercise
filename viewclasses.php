<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Class</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Data Class</h1>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Code Class</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Email Lecturer</th>
                    <th class="text-center">Name Lecturer</th>
                    <th class="text-center">Fakultas</th>
                    <th class="text-center">Prodi</th>
                    <th class="text-center">SKS</th>
                    <th class="text-center">Building Room</th>
                    <th class="text-center">Room Latitude</th>
                    <th class="text-center">Room Longitude</th>
                    <th class="text-center">Jadwal Class</th>
                    <th class="text-center">Daftar Email Student</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Status Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = mysqli_connect('localhost','root','130110Ov-', 'db_unklab');

                    if(!$conn){
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM tbl_classes";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['code_class'] . "</td>";
                            echo "<td>" . $row['name_subject'] . "</td>";
                            echo "<td>" . $row['email_lecturer'] . "</td>";
                            echo "<td>" . $row['name_lecturer'] . "</td>";
                            echo "<td>" . $row['fakultas'] . "</td>";
                            echo "<td>" . $row['prodi'] . "</td>";
                            echo "<td>" . $row['sks'] . "</td>";
                            echo "<td>" . $row['building_room'] . "</td>";
                            echo "<td>" . $row['room_latitude'] . "</td>";
                            echo "<td>" . $row['room_longitude'] . "</td>";
                            echo "<td>" . $row['jadwal_class_day_time'] . "</td>";
                            echo "<td>" . $row['daftar_email_student'] . "</td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['status_class'] . "</td>";
                            echo "</tr>";
                        }
                    } else{
                        echo "<tr><td colspan='6'>Tidak ada data class.</td></tr>";
                    }

                    mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>