<?php
include "connection.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<!-- ================================== Head ================================== -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthHub</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?<?= time(); ?>">
</head>



<body>


    <main>

        <!-- ================================== First 100vh: Header, H1, Register button, Nurse ================================== -->




        <!-- ================================== Section (Page content) ================================== -->

        <div class="container-fluid">

            <div class="row">

                <div class="col-3 sidebar">

                    <a href="#" id="logo_container">
                        <!-- <img src="images/logo.png" alt="logo" id="logo_dashboard"> -->
                        <h2 id="h2_dashboard">HealthHub</h2>
                    </a>

                    <ul class="nav flex-column">
                        <li class="dashboard_option_container">
                            <a class="dashboard_options" href="#">Dashboard</a>
                        </li>
                        <li class="dashboard_option_container">
                            <a class="dashboard_options" href="#">Manage Doctors</a>
                        </li>
                        <li class="dashboard_option_container">
                            <a class="dashboard_options" href="#">Manage Admins</a>
                        </li>
                        <li class="dashboard_option_container">
                            <a class="dashboard_options" href="#">Ratings and Reviews</a>
                        </li>
                        <li class="dashboard_option_container">
                            <a class="dashboard_options" href="index.php">Log out</a>
                        </li>
                    </ul>

                </div>

                <div class="col-9 content">

                    <div id="dashboard_main" class="dashboard_content">

                        <h2 class="my-3">Administrator dashboard</h2>

                        <div class="card-container">

                            <div class="card d-flex me-3 mb-2" style="width: 15rem;">
                                <div class="card-body">
                                    <h3 class="card-title">+500 Members</h3>
                                    <p class="card-text">Total Members</p>
                                </div>
                            </div>
                            <div class="card d-flex me-3 mb-2" style="width: 15rem;">
                                <div class="card-body">
                                    <h3 class="card-title">+100 Doctors</h3>
                                    <p class="card-text">Total Doctors</p>
                                </div>
                            </div>
                            <div class="card d-flex me-3 mb-2" style="width: 15rem;">
                                <div class="card-body">
                                    <h3 class="card-title">+20 Specialties</h3>
                                    <p class="card-text">Total Specialties</p>
                                </div>
                            </div>

                        </div>

                        <div id="line_top_x"></div>

                    </div>

                    <div id="manage_doctors" class="dashboard_content">

                        <h2 class="my-3">Manage doctors</h2>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">C.I.N</th>
                                    <th scope="col">Education</th>
                                    <th scope="col">Certification</th>
                                    <th scope="col">Experience (years)</th>
                                    <th scope="col">Hospital</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Specialty</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $statement = $conn->prepare("SELECT * FROM `Doctors`");
                                $statement->execute();
                                $doctors = $statement->fetchAll();

                                foreach ($doctors as $doctor) {

                                ?>

                                    <tr>
                                        <td><?php echo $doctor['First_name']; ?></td>
                                        <td><?php echo $doctor['Last_name']; ?></td>
                                        <td><?php echo $doctor['Email']; ?></td>
                                        <td><?php echo $doctor['Password']; ?></td>
                                        <td><?php echo $doctor['C.I.N']; ?></td>
                                        <td><?php echo $doctor['Education']; ?></td>
                                        <td><?php echo $doctor['Certification']; ?></td>
                                        <td><?php echo $doctor['Experience']; ?></td>
                                        <td><?php echo $doctor['Hospital']; ?></td>
                                        <td><?php echo $doctor['Rating']; ?></td>
                                        <td>
                                            <?php

                                            $specialty_id = $doctor['Specialty'];

                                            $statement = $conn->prepare("SELECT * FROM `specialties` WHERE `Specialty_ID` = :specialty_id");
                                            $statement->bindValue(':specialty_id', $specialty_id);
                                            $statement->execute();
                                            $results = $statement->fetch();

                                            echo $results['Specialty'];

                                            ?>
                                        </td>
                                        <td>

                                            <!-- Button trigger modal -->

                                            <div class="d-flex gap-1">

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal<?php echo $doctor['Doctor_ID']; ?>"><i class="fa-solid fa-pen-to-square"></i></button>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_confirmation<?php echo $doctor['Doctor_ID']; ?>"><i class="fa-solid fa-trash"></i></button>

                                            </div>

                                            <!-- Modals -->

                                            <div class="modal fade" id="delete_confirmation<?php echo $doctor['Doctor_ID']; ?>" tabindex="-1" aria-labelledby="delete_confirmation_label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete_confirmation_label">This action can not be un-done</h5>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center">Are you sure you want to delete "Dr. <?php echo $doctor['First_name'] . " " . $doctor['Last_name']; ?>" account?</div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <form method="POST">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="delete_button">Delete</button>
                                                                <input type='hidden' name='doctor_id_to_delete' value='<?php echo $doctor['Doctor_ID']; ?>'>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="edit_modal<?php echo $doctor['Doctor_ID']; ?>" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="edit_modal_label">Edit "Dr. <?php echo $doctor['First_name'] . " " . $doctor['Last_name']; ?>" profile</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form method="POST">

                                                            <div class="modal-body row">

                                                                <div class="col-6">
                                                                    <label for="fname" class="form-label">First name</label>
                                                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : $doctor['First_name']; ?>">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="lname" class="form-label">Last name</label>
                                                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : $doctor['Last_name']; ?>">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="education" class="form-label">Education</label>
                                                                    <input type="text" class="form-control" id="education" name="education" value="<?php echo isset($_POST['education']) ? $_POST['education'] : $doctor['Education']; ?>">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="certification" class="form-label">Certification</label>
                                                                    <input type="text" class="form-control" id="certification" name="certification" value="<?php echo isset($_POST['certification']) ? $_POST['certification'] : $doctor['Certification']; ?>">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="hospital" class="form-label">Current hospital</label>
                                                                    <input type="text" class="form-control" id="hospital" name="hospital" value="<?php echo isset($_POST['hospital']) ? $_POST['hospital'] : $doctor['Hospital']; ?>">
                                                                </div>

                                                                <div class="col-6">
                                                                    <label for="experience" class="form-label">Experience in years</label>
                                                                    <input type="number" class="form-control" id="experience" name="experience" value="<?php echo isset($_POST['experience']) ? $_POST['experience'] : $doctor['Experience']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="edit_button">Save changes</button>
                                                                <input type='hidden' name='doctor_id_to_edit' value='<?php echo $doctor['Doctor_ID']; ?>'>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>

                                <?php

                                };


                                if (isset($_POST['delete_button'])) {

                                    $doctor_id_to_delete = $_POST['doctor_id_to_delete'];

                                    $statement = $conn->prepare("DELETE FROM `comments` WHERE `Doctor_ID` = ?");
                                    $statement->execute([$doctor_id_to_delete]);

                                    $statement = $conn->prepare("DELETE FROM `doctor_speaks_language` WHERE `Doctor_ID` = ?");
                                    $statement->execute([$doctor_id_to_delete]);

                                    $statement = $conn->prepare("DELETE FROM `Doctors` WHERE `Doctor_ID` = ?");
                                    $statement->execute([$doctor_id_to_delete]);
                                }



                                if (isset($_POST['edit_button'])) {

                                    $doctor_id_to_edit = $_POST['doctor_id_to_edit'];

                                    $statement = $conn->prepare("SELECT * FROM `Doctors` WHERE `Doctor_ID` = :doctor_id");
                                    $statement->bindValue(':doctor_id', $doctor_id_to_edit);
                                    $statement->execute();
                                    $existingDoctor = $statement->fetch();

                                    $fname = $_POST['fname'] ? $_POST['fname'] : $existingDoctor['First_name'];
                                    $lname = $_POST['lname'] ? $_POST['lname'] : $existingDoctor['Last_name'];
                                    $education = $_POST['education'] ? $_POST['education'] : $existingDoctor['Education'];
                                    $certification = $_POST['certification'] ? $_POST['certification'] : $existingDoctor['Certification'];
                                    $hospital = $_POST['hospital'] ? $_POST['hospital'] : $existingDoctor['Hospital'];
                                    $experience = $_POST['experience'] ? $_POST['experience'] : $existingDoctor['Experience'];

                                    $query = "UPDATE `doctors` SET ";
                                    $values = array();

                                    if (!empty($fname)) {
                                        $values[] = "`First_name`='$fname'";
                                    }
                                    if (!empty($lname)) {
                                        $values[] = "`Last_name`='$lname'";
                                    }
                                    if (!empty($education)) {
                                        $values[] = "`Education`='$education'";
                                    }
                                    if (!empty($certification)) {
                                        $values[] = "`Certification`='$certification'";
                                    }
                                    if (!empty($hospital)) {
                                        $values[] = "`Hospital`='$hospital'";
                                    }
                                    if (!empty($experience)) {
                                        $values[] = "`Experience`='$experience'";
                                    }

                                    if (!empty($values)) {
                                        $query .= implode(", ", $values);
                                        $query .= " WHERE `Doctor_ID` = $doctor_id_to_edit";

                                        $statement = $conn->prepare($query);
                                        $statement->execute();
                                    }
                                }

                                ?>

                            </tbody>

                        </table>

                    </div>

                    <div id="curd_admin" class="dashboard_content">

                        <div class="row">

                            <div class="col-6">

                                <h2 class="my-3">Add doctors as admins</h2>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Doctors</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">C.I.N</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                        $statement = $conn->prepare("SELECT * FROM `Doctors` WHERE `Admin` = 0");
                                        $statement->execute();
                                        $doctors_not_admins = $statement->fetchAll();

                                        foreach ($doctors_not_admins as $doctor_not_admin) { ?>

                                            <tr>
                                                <td>Dr. <?php echo $doctor_not_admin['First_name'] . " " . $doctor_not_admin['Last_name']; ?></td>
                                                <td><?php echo $doctor_not_admin['Email']; ?></td>
                                                <td><?php echo $doctor_not_admin['C.I.N']; ?></td>
                                                <td>

                                                    <!-- Button trigger modal -->

                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_doc_not_admin_<?php echo $doctor_not_admin['Doctor_ID']; ?>"><i class="fa-solid fa-plus"></i></button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="edit_modal_doc_not_admin_<?php echo $doctor_not_admin['Doctor_ID']; ?>" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="edit_modal_label">Confirmation</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to add "Dr. <?php echo $doctor_not_admin['First_name'] . " " . $doctor_not_admin['Last_name']; ?>" as an admin?
                                                                </div>
                                                                <form method="POST">
                                                                    <div class="modal-footer d-flex justify-content-center">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="edit_button">Save changes</button>
                                                                        <input type='hidden' name='doctor_id_to_edit' value='<?php echo $doctor_not_admin['Doctor_ID']; ?>'>
                                                                    </div>

                                                                </form>

                                                                <?php

                                                                if (isset($_POST['doctor_id_to_edit'])) {

                                                                    $doctor_id_to_edit = $_POST['doctor_id_to_edit'];

                                                                    $statement = $conn->prepare("UPDATE `Doctors` SET `Admin` = 1 WHERE `Doctor_ID` = $doctor_id_to_edit");
                                                                    $statement->execute();
                                                                }

                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                        <?php }; ?>

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-6">

                                <h2 class="my-3">Delete admins</h2>

                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th scope="col">Administrators</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">C.I.N</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                        $statement = $conn->prepare("SELECT `First_name`, `Last_name`, `Email`, `C.I.N` FROM `Doctors` WHERE `Admin` = 1 UNION SELECT `First_name`, `Last_name`, `Email`, `C.I.N` FROM `Members` WHERE `Admin` = 1");
                                        $statement->execute();
                                        $admins = $statement->fetchAll();

                                        foreach ($admins as $admin) { ?>

                                            <tr>
                                                <td><?php echo $admin['First_name'] . " " . $admin['Last_name']; ?></td>
                                                <td><?php echo $admin['Email']; ?></td>
                                                <td><?php echo $admin['C.I.N']; ?></td>
                                                <td>


                                                    <!-- Button triger modal -->

                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_confirmation<?php echo $admin['C.I.N']; ?>"><i class="fa-solid fa-trash"></i></button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="delete_confirmation<?php echo $admin['C.I.N']; ?>" tabindex="-1" aria-labelledby="delete_confirmation_label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="delete_confirmation_label">This action can not be un-done</h5>
                                                                </div>
                                                                <div class="modal-body d-flex justify-content-center">Are you sure you want to remove this admin?</div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <form method="POST">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="delete_button_admin">Delete</button>
                                                                        <input type='hidden' name='admin_to_delete' value='<?php echo $admin['Email']; ?>'>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                        <?php

                                        };

                                        if (isset($_POST['delete_button_admin'])) {

                                            $admin_to_delete = $_POST['admin_to_delete'];

                                            $statement = $conn->prepare("SELECT 1 FROM `Doctors` WHERE `Email` = :admin_to_delete");
                                            $statement->bindParam(':admin_to_delete', $admin_to_delete);
                                            $statement->execute();
                                            $is_doctor_admin = $statement->fetchColumn();
                                        
                                            if ($is_doctor_admin) {
                                                $query = "UPDATE `Doctors` SET `Admin` = 0 WHERE `Email` = :admin_to_delete";
                                            } else {
                                                $query = "UPDATE `Members` SET `Admin` = 0 WHERE `Email` = :admin_to_delete";
                                            }

                                            $statement = $conn->prepare($query);
                                            $statement->bindParam(':admin_to_delete', $admin_to_delete);
                                            $statement->execute();
                                            
                                        }

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-6">

                                <h2 class="my-3">Add members as admins</h2>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Members</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">C.I.N</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                        $statement = $conn->prepare("SELECT * FROM `Members` WHERE `Admin` = 0");
                                        $statement->execute();
                                        $members_not_admins = $statement->fetchAll();

                                        foreach ($members_not_admins as $member_not_admin) { ?>

                                            <tr>
                                                <td><?php echo $member_not_admin['First_name'] . " " . $member_not_admin['Last_name']; ?></td>
                                                <td><?php echo $member_not_admin['Email']; ?></td>
                                                <td><?php echo $member_not_admin['C.I.N']; ?></td>
                                                <td>

                                                    <!-- Button trigger modal -->

                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_mem_not_admin_<?php echo $member_not_admin['Member_ID']; ?>"><i class="fa-solid fa-plus"></i></button>

                                                    <!-- Modal -->

                                                    <div class="modal fade" id="edit_modal_mem_not_admin_<?php echo $member_not_admin['Member_ID']; ?>" tabindex="-1" aria-labelledby="edit_modal_label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="edit_modal_label">Confirmation</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to add "<?php echo $member_not_admin['First_name'] . " " . $member_not_admin['Last_name']; ?>" as an admin?

                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-center">
                                                                    <form method="POST">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        <input type='hidden' name='member_id_to_edit' value='<?php echo $member_not_admin['Member_ID']; ?>'>
                                                                    </form>

                                                                    <?php

                                                                    if (isset($_POST['member_id_to_edit'])) {

                                                                    $member_id_to_edit = $_POST['member_id_to_edit'];

                                                                    $statement = $conn->prepare("UPDATE `Members` SET `Admin` = 1 WHERE `Member_ID` = $member_id_to_edit");
                                                                    $statement->execute();
                                                                    
                                                                    }

                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>

                                        <?php }; ?>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <div id="ratings_reviews" class="dashboard_content">

                        <h2 class="my-3">Ratings and Reviews</h2>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Member</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Appointment Code</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $statement = $conn->prepare("SELECT * FROM `comments`");
                                $statement->execute();
                                $comments = $statement->fetchAll();

                                foreach ($comments as $comment) {

                                ?>
                                    <tr>
                                        <td><?php echo $comment['Member_ID'] ?></td>
                                        <td><?php echo $comment['Doctor_ID'] ?></td>
                                        <td><?php echo $comment['Comment'] ?></td>
                                        <td><?php echo $comment['Appointment_code'] ?></td>

                                        <td>

                                            <!-- Button trigger modal -->

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_confirmation_comment_<?php echo $comment['Member_ID']; ?>"><i class="fa-solid fa-trash"></i></button>

                                            <!-- Modal -->

                                            <div class="modal fade" id="delete_confirmation_comment_<?php echo $comment['Member_ID']; ?>" tabindex="-1" aria-labelledby="delete_confirmation_label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete_confirmation_label">This action can not be un-done</h5>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center">Are you sure you want to delete this comment?</div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <form method="POST">
                                                                
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="delete_button">Delete</button>
                                                                <input type='hidden' name='Appointment_code' value='<?php echo $comment['Appointment_code']; ?>'>

                                                            </form>

                                                            <?php
                                                            if (isset($_POST['delete_button'])) {

                                                            $Appointment_code = $_POST['Appointment_code'];

                                                            $statement = $conn->prepare("DELETE FROM `comments` WHERE `appointment_code` = :Appointment_code");
                                                            $statement->bindValue(':Appointment_code', $Appointment_code);
                                                            $statement->execute();

                                                            }
                                                            
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                <?php }; ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>

    </main>




    <!-- ================================== Scripts ================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['line']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Days');
            data.addColumn('number', 'Visitors');
            data.addColumn('number', 'Members');
            data.addColumn('number', 'Doctors');

            data.addRows([
                [1, 37.8, 80.8, 41.8],
                [2, 30.9, 69.5, 32.4],
                [3, 25.4, 57, 25.7],
                [4, 11.7, 18.8, 10.5],
                [5, 11.9, 17.6, 10.4],
                [6, 8.8, 13.6, 7.7],
                [7, 7.6, 12.3, 9.6],
                [8, 12.3, 29.2, 10.6],
                [9, 16.9, 42.9, 14.8],
                [10, 12.8, 30.9, 11.6],
                [11, 5.3, 7.9, 4.7],
                [12, 6.6, 8.4, 5.2],
                [13, 4.8, 6.3, 3.6],
                [14, 4.2, 6.2, 3.4]
            ]);

            var options = {
                chart: {
                    title: 'Comprehensive statistical charts showcasing visitor, member, and doctor activity for effective monitoring and analysis'
                },
                width: 1180,
                height: 500,
                axes: {
                    x: {
                        0: {
                            side: 'top'
                        }
                    }
                }
            };

            var chart = new google.charts.Line(document.getElementById('line_top_x'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>

</body>



</html>