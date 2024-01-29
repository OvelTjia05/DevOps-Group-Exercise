        <div class="container">
            <h1>Data Operator</h1>
            <div class="mb-3 d-flex flex-row-reverse">
                <button type="button" class="btn btn-primary" id="addOperatorBtn">Add Operator</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="table-primary">
                            <th class="text-center">NIP</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Phone Number</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "./database/index.php";

                        $sql = "SELECT * FROM tbl_operator";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['nip'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['fullname'] . "</td>";
                                echo "<td>" . $row['phone_number'] . "</td>";
                                echo "<td>" . $row['role'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada data mahasiswa.</td></tr>";
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addOperatorModal" tabindex="-1" aria-labelledby="addOperatorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h1 class="modal-title fs-5 text-white" id="addOperatorModalLabel">Add Operator</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="d-flex flex-column row-gap-3" id="addOperatorForm">
                            <div>
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div>
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" required>
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div>
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                            </div>
                            <div>
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role" name="role" required>
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
                $("#addOperatorBtn").click(function() {
                    $("#addOperatorModal").modal("show");
                });

                $("#submitBtn").click(function(event) {
                    event.preventDefault();


                    const nip = $("#nip").val();
                    const email = $("#email").val();
                    const fullname = $("#fullname").val();
                    const password = $("#password").val();
                    const phone_number = $("#phone_number").val();
                    const role = $("#role").val();

                    $.ajax({
                        type: "POST",
                        url: "service/operator_service.php",
                        data: {
                            insert_operator: true,
                            nip,
                            email,
                            fullname,
                            password,
                            phone_number,
                            role
                        },

                        success: function(response) {
                            const response_parse = jQuery.parseJSON(response);
                            $("#addOperatorModal").modal('hide');
                            $("#addOperatorModal").on('hidden.bs.modal', function() {
                                $(this).removeData('bs.modal');
                            });
                            console.log("halo")
                            loadContent("viewoperator.php");
                            alert(response_parse.message);
                        }
                    })
                })
            });
        </script>