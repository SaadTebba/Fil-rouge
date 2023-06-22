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
            <a href="index_members.php" id="logo_container">
                <img src="images/logo.png" alt="logo">
                <h2>HealthHub</h2>
            </a>
            <div class="signin-container">

                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['First_name'] . " " . $_SESSION['Last_name']; ?></button>
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

                    <img src="images/user.png" alt="profile_photo">
                    <h3><?php echo $_SESSION['First_name'] . " " . $_SESSION['Last_name']; ?></h3>

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

                    <div class="col-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                    </div>

                    <div class="col-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    </form>

                    <?php

                    if (isset($_POST['save_changes'])) {

                        $member_id = $_SESSION['Member_ID'];

                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $cin = $_POST['cin'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $original_password = $_SESSION['password'];

                        if (empty($password)) {

                            $statement = $conn->prepare("UPDATE `members` SET `First_name`='$fname',`Last_name`='$lname',`Email`='$email',`Password`='$original_password',`C.I.N`='$cin' WHERE `Member_ID` = $member_id");

                        } else {

                            $statement = $conn->prepare("UPDATE `members` SET `First_name`='$fname',`Last_name`='$lname',`Email`='$email',`Password`='$password',`C.I.N`='$cin' WHERE `Member_ID` = $member_id");

                            $_SESSION['password'] = $password;

                        }

                        $statement->execute();

                        $_SESSION['First_name'] = $fname;
                        $_SESSION['Last_name'] = $lname;
                        $_SESSION['Email'] = $email;
                        $_SESSION['C.I.N'] = $cin;

                        header("Location: ".$_SERVER['PHP_SELF']);
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