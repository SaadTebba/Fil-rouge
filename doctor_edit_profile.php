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
    <title>HealthHub - Edit profile</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sofia+Sans+Semi+Condensed:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?<?= time(); ?>">
</head>



<body>


    <main>

        <!-- ================================== First 100vh: Header ================================== -->

        <header>
            <a href="index_doctors.php" id="logo_container">
                <img src="images/logo.png" alt="logo">
                <h2>HealthHub</h2>
            </a>
            <div class="signin-container">

                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dr. <?php echo $_SESSION['First_name'] . " " . $_SESSION['Last_name']; ?></button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Edit profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="index.php">Log out</a></li>
                    </ul>
                </div>

                <img src="images/user.png" alt="user" id="user_image">
            </div>
        </header>

        <!-- ================================== Section (Page content) ================================== -->

        <section class="container my-4">

            <div class="profile-container">

                <div class="profile-left">

                    <img src="images/doctors/doctor_male1.jpg" alt="profile_photo">
                    <h3>Dr. <?php echo $_SESSION['First_name'] . " " . $_SESSION['Last_name']; ?></h3>

                    <div class="star-rating">
                        <input type="radio" id="star5" value="5" <?php echo ($_SESSION['Rating'] >= 5) ? 'checked' : ''; ?> disabled>
                        <label for="star5"></label>
                        <input type="radio" id="star4" value="4" <?php echo ($_SESSION['Rating'] >= 4 && $_SESSION['Rating'] < 5) ? 'checked' : ''; ?> disabled>
                        <label for="star4"></label>
                        <input type="radio" id="star3" value="3" <?php echo ($_SESSION['Rating'] >= 3 && $_SESSION['Rating'] < 4) ? 'checked' : ''; ?> disabled>
                        <label for="star3"></label>
                        <input type="radio" id="star2" value="2" <?php echo ($_SESSION['Rating'] >= 2 && $_SESSION['Rating'] < 3) ? 'checked' : ''; ?> disabled>
                        <label for="star2"></label>
                        <input type="radio" id="star1" value="1" <?php echo ($_SESSION['Rating'] >= 1 && $_SESSION['Rating'] < 2) ? 'checked' : ''; ?> disabled>
                        <label for="star1"></label>
                    </div><br>

                    <form method="POST">
                        <button class="btn edit-button" name="save_changes">Save changes</button>


                </div>

                <div class="profile-right row">

                    <h2>Edit your profile</h2>

                    <div class="col-4">
                        <label for="fname" class="form-label">First name</label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $_SESSION['First_name']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="lname" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $_SESSION['Last_name']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="cin" class="form-label">C.I.N</label>
                        <input type="text" class="form-control" id="cin" name="cin" value="<?php echo $_SESSION['C.I.N']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="education" class="form-label">Education</label>
                        <input type="text" class="form-control" id="education" name="education" value="<?php echo $_SESSION['Education']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="certification" class="form-label">Certification</label>
                        <input type="text" class="form-control" id="certification" name="certification" value="<?php echo $_SESSION['Certification']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="hospital" class="form-label">Current hospital</label>
                        <input type="text" class="form-control" id="hospital" name="hospital" value="<?php echo $_SESSION['Hospital']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="experience" class="form-label">Experience in years</label>
                        <input type="number" class="form-control" id="experience" name="experience" value="<?php echo $_SESSION['Experience']; ?>">
                    </div>

                    <div class="col-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password"">
                    </div>

                    <div class=" col-12">
                        <label for="specialty" class="form-label">Specialty</label>
                        <select class="form-control" id="specialty" name="specialty" required>
                            <option selected><?php echo $_SESSION['Specialty']; ?></option>
                            <?php

                            $statement = $conn->prepare("SELECT * FROM `specialties`");
                            $statement->execute();

                            $specialties = $statement->fetchAll();

                            foreach ($specialties as $specialty) {
                                echo "<option>" . $specialty['Specialty'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="languages" class="form-label">Languages</label>
                        <select class="form-control" multiple id="languages" name="languages">
                            <option selected disabled>Select languages</option>
                            <?php

                            $statement = $conn->prepare("SELECT * FROM `Languages`");
                            $statement->execute();

                            $languages = $statement->fetchAll();

                            foreach ($languages as $language) {
                                echo "<option>" . $language['Language'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>

                    </form>

                    <?php

                    if (isset($_POST['save_changes'])) {
                        $doctor_id = $_SESSION['Doctor_ID'];

                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $cin = $_POST['cin'];
                        $education = $_POST['education'];
                        $certification = $_POST['certification'];
                        $hospital = $_POST['hospital'];
                        $experience = $_POST['experience'];
                        $specialty = $_POST['specialty'];
                        $password = $_POST['password'];

                        if (empty($password)) {

                            $statement = $conn->prepare("UPDATE `doctors` SET `First_name`=:fname, `Last_name`=:lname, `Email`=:email, `Password`=:original_password, `C.I.N`=:cin, `Education`=:education, `Certification`=:certification, `Experience`=:experience, `Hospital`=:hospital, `Specialty`=:specialty WHERE `Doctor_ID` = :doctor_id");
                            
                        } else {

                            $statement = $conn->prepare("UPDATE `doctors` SET `First_name`=:fname, `Last_name`=:lname, `Email`=:email, `Password`=:passwordo, `C.I.N`=:cin, `Education`=:education, `Certification`=:certification, `Experience`=:experience, `Hospital`=:hospital, `Specialty`=:specialty WHERE `Doctor_ID` = :doctor_id");
                            $statement->bindParam(':passwordo', $password);
                            $_SESSION['password'] = $password;
                        }

                        $statement->bindParam(':fname', $fname);
                        $statement->bindParam(':lname', $lname);
                        $statement->bindParam(':email', $email);
                        $statement->bindParam(':original_password', $original_password);
                        $statement->bindParam(':cin', $cin);
                        $statement->bindParam(':education', $education);
                        $statement->bindParam(':certification', $certification);
                        $statement->bindParam(':experience', $experience);
                        $statement->bindParam(':hospital', $hospital);
                        $statement->bindParam(':specialty', $specialty);
                        $statement->bindParam(':doctor_id', $doctor_id);

                        $statement->execute();

                        $_SESSION['First_name'] = $fname;
                        $_SESSION['Last_name'] = $lname;
                        $_SESSION['Email'] = $email;
                        $_SESSION['C.I.N'] = $cin;
                        $_SESSION['Education'] = $education;
                        $_SESSION['Certification'] = $certification;
                        $_SESSION['Experience'] = $experience;
                        $_SESSION['Hospital'] = $hospital;
                        $_SESSION['Specialty'] = $specialty;

                        ob_end_flush();
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit();
                    }
                    ?>


                </div>

            </div>


        </section>

        <!-- ================================== Footer ================================== -->

        <footer>
            <div class="text-center text-dark p-3">
                Get in touch with us!
            </div>

            <div class="container">
                <div class="d-flex justify-content-center">
                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"><i class="fa-solid fa-envelope footer_icons icons"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram footer_icons icons"></i></a>
                    <a href="https://twitter.com/?lang=en" target="_blank"><i class="fa-brands fa-twitter footer_icons icons"></i></a>
                    <a href="https://web.facebook.com" target="_blank"><i class="fa-brands fa-facebook footer_icons icons"></i></a>
                </div>
            </div>

            <div class="text-center text-dark p-2">
                © All right reserved. Solicode Tanger 2022/2023.
            </div>

        </footer>

    </main>




    <!-- ================================== Scripts ================================== -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/165265fe22.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="script.js"></script>

</body>



</html>