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
    <title>HealthHub - Sign in</title>
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

        <div id="hundredVH">

            <header>
                <a href="index.php" id="logo_container">
                    <img src="images/logo.png" alt="logo">
                    <h2>HealthHub</h2>
                </a>
                <div class="signin-container">
                    <a href="signin.php" id="sign_in_text">Sign in</a>
                    <img src="images/user.png" alt="user" id="user_image">
                </div>
            </header>

            <div class="container">
                <div class="row">
                    <div class="col-5 mt-5">
                        <h1 class="text-center">Sign in</h1>

                        <form method="POST" class="row g-3 needs-validation px-5 mt-1">

                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="col-12">
                                <button class="btn col-12 submit_button" type="submit" name="submit">Submit</button>
                                <p class="text-decoration-none text-dark text-center mt-3">Don't have an account yet? <a href="signup.php" class="link-primary text-decoration-underline pe-auto signinhere fw-bolder">Sign up</a>.</p>
                            </div>

                        </form>

                        <?php


                        if (isset($_POST["submit"])) {

                            $email = $_POST["email"];
                            $password = $_POST["password"];

                            $queryMember = "SELECT * FROM `members` WHERE '$email' LIKE `Email` AND '$password' LIKE `Password`";
                            $queryDoctor = "SELECT * FROM `doctors` WHERE '$email' LIKE `Email` AND '$password' LIKE `Password`";

                            $statementMember = $conn->prepare($queryMember);
                            $statementDoctor = $conn->prepare($queryDoctor);

                            $statementMember->execute();
                            $statementDoctor->execute();

                            $rowCountMember = $statementMember->rowCount();
                            $rowCountDoctor = $statementDoctor->rowCount();

                            if ($rowCountMember > 0) {

                                $result = $statementMember->fetch();

                                $_SESSION['Member_ID'] = $result['Member_ID'];
                                $_SESSION['First_name'] = $result['First_name'];
                                $_SESSION['Last_name'] = $result['Last_name'];
                                $_SESSION['C.I.N'] = $result['C.I.N'];
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;

                                if ($result["Admin"] == 1) {
                                    header("Location: index_admin_dashboard.php");
                                } else {
                                    header("Location: index_members.php");
                                }

                                die;

                            } elseif ($rowCountDoctor > 0) {

                                $result = $statementDoctor->fetch();

                                $_SESSION['Doctor_ID'] = $result['Doctor_ID'];
                                $_SESSION['First_name'] = $result['First_name'];
                                $_SESSION['Last_name'] = $result['Last_name'];
                                $_SESSION['C.I.N'] = $result['C.I.N'];
                                $_SESSION['Education'] = $result['Education'];
                                $_SESSION['Certification'] = $result['Certification'];
                                $_SESSION['Experience'] = $result['Experience'];
                                $_SESSION['Hospital'] = $result['Hospital'];
                                $_SESSION['Rating'] = $result['Rating'];

                                $doctor_id_for_specialty = $result['Doctor_ID'];

                                $statementSpecialty = $conn->prepare("SELECT * FROM `specialties` WHERE `Specialty_ID` = $doctor_id_for_specialty");
                                $statementSpecialty->execute();
                                $results = $statementSpecialty->fetch();
                                
                                $_SESSION['Specialty'] = $results['Specialty'];           

                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;

                                if ($result["Admin"] == 1) {
                                    header("Location: index_admin_dashboard.php");
                                } else {
                                    header("Location: index_doctors.php");
                                }
                                die;

                            } else {
                                echo '<p class="text-center link-danger fw-bolder h4 text-decoration-underline">Access denied due to incorrect login details.</p>';
                            }

                            ob_end_flush();
                            exit();
                        };

                        ?>

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

</body>



</html>