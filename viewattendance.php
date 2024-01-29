    <div class="container">
        <h1>Data Kehadiran</h1>
        <div class="mb-3 d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary" id="addAttendanceBtn">Add Attendance</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
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
                    require "./database/index.php";

                    $sql = "SELECT * FROM tbl_attendance_list";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
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
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada data kehadiran.</td></tr>";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAttendanceModal" tabindex="-1" aria-labelledby="addAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="addAttendanceModalLabel">Add Attendance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column row-gap-3" id="addAttendanceForm">
                        <div>
                            <label for="title_short" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title_short" name="title_short" required>
                        </div>
                        <div>
                            <label for="date_attendance" class="form-label">Date Attendance</label>
                            <input type="text" class="form-control" id="date_attendance" name="date_attendance" required>
                        </div>
                        <div>
                            <label for="time_attendance" class="form-label">Time Attendance</label>
                            <div class="d-flex flex-row gap-2">
                                <input type="time" class="form-control" id="time_start" name="time_start" required>
                                -
                                <input type="time" class="form-control" id="time_end" name="time_end" required>
                            </div>
                        </div>
                        <div class="dropdown">
                            <label for="name_subject" class="form-label">Name Subject</label>
                            <div class="d-flex flex-row gap-2">
                                <input type="text" class="form-control" id="name_subject" name="name_subject" readonly required>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <?php
                                    renderDropdown("name_subject", "tbl_classes", "Subject")
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="dropdown">
                            <label for="name_lecturer" class="form-label">Name Lecturer</label>
                            <div class="d-flex flex-row gap-2">
                                <input type="text" class="form-control" id="name_lecturer" name="name_lecturer" readonly required>
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <?php
                                    renderDropdown("name_lecturer", "tbl_classes", "Lecturer");
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <label for="email_lecturer" class="form-label">Email Lecturer</label>
                            <input type="text" class="form-control" id="email_lecturer" name="email_lecturer" readonly required>
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
                            <label for="max_radius" class="form-label">Max Radius</label>
                            <input type="number" class="form-control" id="max_radius" name="max_radius" required>
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

    <?php
    function renderDropdown($columnName, $tableName, $name)
    {
        require "./database/index.php";

        $sql = "SELECT DISTINCT $columnName";
        if ($name === "Lecturer") {
            $sql .= ", email_lecturer";
        }
        $sql .= " FROM $tableName";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li><a class='dropdown-item' onclick='setSelected$name(\"" . $row[$columnName] . "\"" . (($name === "Lecturer") ? ", \"" . $row['email_lecturer'] . "\"" : "") . ")'>" . $row[$columnName] . "</a></li>";
            }
        } else {
            echo "<li><a class='dropdown-item'>Tidak ada data</a></li>";
        }

        mysqli_close($conn);
    }
    ?>

    <script>
        $(document).ready(function() {
            //Trigger modal show
            $("#addAttendanceBtn").click(function() {
                $("#addAttendanceModal").modal("show");
            });

            //date picker and map function
            $('#addAttendanceModal').on('shown.bs.modal', function() {
                $('#date_attendance').datepicker({
                    format: 'dd MM yyyy',
                    autoclose: true
                });

                var map = L.map('mapid').setView([1.4175187, 124.9840248], 16);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                var marker = L.marker([1.4175187, 124.9840248]).addTo(map);

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    $('#room_latitude').val(e.latlng.lat);
                    $('#room_longitude').val(e.latlng.lng);
                });
            });

            //Time concat
            $("#time_start").on("input", function() {
                updateAttendanceTime();
            });

            $("#time_end").on("input", function() {
                updateAttendanceTime();
            });

            function updateAttendanceTime() {
                var timeStart = $("#time_start").val();
                var timeEnd = $("#time_end").val();
                var timeAttendance = timeStart + "-" + timeEnd;
                $("#time_attendance").text(timeAttendance);
            }

            //Submit action
            $("#submitBtn").click(function(event) {
                event.preventDefault();

                var formData = $("#addAttendanceForm").serializeArray();

                formData = formData.filter(function(item) {
                    return item.name !== "time_start" && item.name !== "time_end";
                });

                var timeStart = $("#time_start").val().replace(":", ".");
                var timeEnd = $("#time_end").val().replace(":", ".");
                var timeAttendance = timeStart + " - " + timeEnd;

                formData.push({
                    name: "time_attendance",
                    value: timeAttendance
                });

                formData.push({
                    name: "insert_attendance",
                    value: true
                });

                let dataSubmit = {}
                formData.forEach(item => {
                    dataSubmit[item.name] = item.value;
                })

                $.ajax({
                    type: "POST",
                    url: "service/attendance_service.php",
                    data: dataSubmit,
                    success: function(response) {
                        const response_parse = jQuery.parseJSON(response);
                        $("#addAttendanceModal").modal('hide');
                        $("#addAttendanceModal").on('hidden.bs.modal', function() {
                            $(this).removeData('bs.modal');
                        });
                        loadContent("viewattendance.php");
                        alert(response_parse.message);
                    }
                })
            })
        });

        //Select name_subject
        function setSelectedSubject(value) {
            document.getElementById('name_subject').value = value;
        }

        function setSelectedLecturer(name, email) {
            document.getElementById('name_lecturer').value = name;
            document.getElementById('email_lecturer').value = email;
        }
    </script>
    </body>

    </html>