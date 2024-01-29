<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data History</title>
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
        <h1>Data History</h1>
        <div class="mb-3 d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary" id="addHistoryBtn">Add History</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
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
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="addHistoryModal" tabindex="-1" aria-labelledby="addHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="addHistoryModalLabel">Add History</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column row-gap-3" id="addHistoryForm">
                        <div>
                            <label for="email_student" class="form-label">Email Student</label>
                            <input type="email" class="form-control" id="email_student" name="email_student" required>
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
                            <label for="student_lat" class="form-label">student Latitude</label>
                            <input type="text" class="form-control" id="student_lat" name="student_lat" readonly required>
                        </div>
                        <div>
                            <label for="student_long" class="form-label">student Longitude</label>
                            <input type="text" class="form-control" id="student_long" name="student_long" readonly required>
                        </div>
                        <div id="mapid" style="height: 300px;"></div>
                        <div>
                            <label for="distance" class="form-label">Distance</label>
                            <input type="number" class="form-control" id="distance" name="distance" required>
                        </div>
                        <div>
                            <label for="time_take_attendance" class="form-label">Time Take Attendance</label>
                            <input type="time" class="form-control" id="time_take_attendance" name="time_take_attendance" required>
                        </div>
                        <div>
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <div>
                            <label for="note" class="form-label">Note</label>
                            <input type="text" class="form-control" id="note" name="note" required>
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
            $("#addHistoryBtn").click(function(){
                $("#addHistoryModal").modal("show");
            });

            //date picker and map function
            $('#addHistoryModal').on('shown.bs.modal', function () {
                var map = L.map('mapid').setView([1.4175187,124.9840248], 16);
                
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                var marker = L.marker([1.4175187,124.9840248]).addTo(map);

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    $('#student_lat').val(e.latlng.lat);
                    $('#student_long').val(e.latlng.lng);
                });
            });
        });

        //Submit action
        $("#submitBtn").click(function(event){
            event.preventDefault();

            var formData = $("#addHistoryForm").serializeArray();
            console.log('formdataa', formData);
        })
    </script>
</body>
</html>