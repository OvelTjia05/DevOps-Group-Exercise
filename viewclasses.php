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
                require "./database/index.php";

                $sql = "SELECT * FROM tbl_classes";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
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
                } else {
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
    $(document).ready(function() {
        //Trigger modal show
        $("#addClassBtn").click(function() {
            $("#addClassModal").modal("show");
        });

        //date picker and map function
        $('#addClassModal').on('shown.bs.modal', function() {
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

        $("#submitBtn").click(function(event) {
            event.preventDefault();


            const code_class = $("#code_class").val();
            const name_subject = $("#name_subject").val();
            const email_lecturer = $("#email_lecturer").val();
            const name_lecturer = $("#name_lecturer").val();
            const fakultas = $("#fakultas").val();
            const prodi = $("#prodi").val();
            const sks = $("#sks").val();
            const building_room = $("#building_room").val();
            const room_latitude = $("#room_latitude").val();
            const room_longitude = $("#room_longitude").val();
            const jadwal_class_day_time = $("#jadwal_class_day_time").val();
            const daftar_email_student = $("#daftar_email_student").val();

            console.log("ini sks: ", sks)

            $.ajax({
                type: "POST",
                url: "service/class_service.php",
                data: {
                    insert_class: true,
                    code_class,
                    name_subject,
                    email_lecturer,
                    name_lecturer,
                    fakultas,
                    prodi,
                    sks,
                    building_room,
                    room_latitude,
                    room_longitude,
                    jadwal_class_day_time,
                    daftar_email_student
                },

                success: function(response) {
                    const response_parse = jQuery.parseJSON(response);
                    $("#addClassModal").modal('hide');
                    loadContent("viewclasses.php");
                    alert(response_parse.message);
                }
            })
        })
    });
</script>