<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Data Mahasiswa</h1>
        <div class="mb-3 d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary" id="addStudentBtn">Add Student</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th class="text-center">Registration Number</th>
                        <th class="text-center">NIM Number</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Full Name</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $conn = mysqli_connect('localhost','root','130110Ov-', 'db_unklab');

                        if(!$conn){
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM tbl_students";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "<td>" . $row['reg_number'] . "</td>";
                                echo "<td>" . $row['nim_number'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['fullname'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "</tr>";
                            }
                        } else{
                            echo "<tr><td colspan='6'>Tidak ada data mahasiswa.</td></tr>";
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="addStudentModalLabel">Add Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="d-flex flex-column row-gap-3" id="addStudentForm">
                        <div>
                            <label for="reg_number" class="form-label">Registration Number</label>
                            <input type="text" class="form-control" id="reg_number" name="reg_number" required>
                        </div>
                        <div>
                            <label for="nim_number" class="form-label">NIM Number</label>
                            <input type="text" class="form-control" id="nim_number" name="nim_number" required>
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div>
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
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
            $("#addStudentBtn").click(function(){
                $("#addStudentModal").modal("show");
            });
        });

        $("#submitBtn").click(function(event){
            event.preventDefault();

            var formData = $("#addStudentForm").serialize();
            console.log('formdataa', formData);
        })
    </script>
</body>
</html>
