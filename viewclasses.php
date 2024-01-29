<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Class</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <div class="container">
        <h1>Data Class</h1>
        <div class="mb-3 d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary" id="addClassBtn">Add Class</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
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
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="addClassModalLabel">Add Class</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column row-gap-3" id="addClassForm">
                        <div>
                            <label for="code_class" class="form-label">Code Class</label>
                            <input type="text" class="form-control" id="code_class" name="code_class" required>
                        </div>
                        <div>
                            <label for="name_subject" class="form-label">Name Subject</label>
                            <input type="text" class="form-control" id="name_subject" name="name_subject" required>
                        </div>
                        <div>
                            <label for="email_lecturer" class="form-label">Email Lecturer</label>
                            <input type="email" class="form-control" id="email_lecturer" name="email_lecturer" required>
                        </div>
                        <div>
                            <label for="name_lecturer" class="form-label">Name Lecturer</label>
                            <input type="text" class="form-control" id="name_lecturer" name="name_lecturer" required>
                        </div>
                        <div>
                            <label for="fakultas" class="form-label">Fakultas</label>
                            <input type="text" class="form-control" id="fakultas" name="fakultas" required>
                        </div>
                        <div>
                            <label for="prodi" class="form-label">Prodi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" required>
                        </div>
                        <div>
                            <label for="sks" class="form-label">SKS</label>
                            <input type="number" class="form-control" id="sks" name="sks" required>
                        </div>
                        <div>
                            <label for="building_room" class="form-label">Building Room</label>
                            <input type="text" class="form-control" id="building_room" name="building_room" required>
                        </div>
                        <div>
                            <label for="room_latitude" class="form-label">Room Latitude</label>
                            <input type="text" class="form-control" id="room_latitude" name="room_latitude" readonly required>
                        </div>
                        <div>
                            <label for="room_longitude" class="form-label">Room Longitude</label>
                            <input type="text" class="form-control" id="room_longitude" name="room_longitude" readonly required>
                        </div>
                        <div id="mapid" style="height: 300px;"></div>
                        <div>
                            <label for="jadwal_class_day_time" class="form-label">Jadwal Class</label>
                            <input type="text" class="form-control" id="jadwal_class_day_time" name="jadwal_class_day_time" required>
                        </div>
                        <div>
                            <label for="daftar_email_student" class="form-label">Daftar Email Student</label>
                            <input type="email" class="form-control" id="daftar_email_student" name="daftar_email_student" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            //Trigger modal show
            $("#addClassBtn").click(function(){
                $("#addClassModal").modal("show");
            });

            //date picker and map function
            $('#addClassModal').on('shown.bs.modal', function () {
                var map = L.map('mapid').setView([1.4175187,124.9840248], 16);
                
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                var marker = L.marker([1.4175187,124.9840248]).addTo(map);

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    $('#room_latitude').val(e.latlng.lat);
                    $('#room_longitude').val(e.latlng.lng);
                });
            });
        });

        //Submit action
        $("#submitBtn").click(function(event){
            event.preventDefault();

            var formData = $("#addClassForm").serializeArray();
            console.log('formdataa', formData);
        })
    </script>
</body>
</html>