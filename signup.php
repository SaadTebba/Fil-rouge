<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<!-- ================================== Head ================================== -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthHub - Sign up</title>
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
                        <h1 class="text-center">Sign up</h1>

                        <form method="POST" class="row g-3 needs-validation px-5 mt-1">

                            <div class="col-md-6">
                                <label for="FirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="LastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="LastName" name="LastName" required>
                            </div>


                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword" class="form-label">Confirm password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            </div>

                            <div class="col-12">
                                <label for="CIN" class="form-label">C.I.N</label>
                                <input type="text" class="form-control" id="CIN" name="CIN" required>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">By checking the box, I acknowledge that I have read and agree to the <a type="button" class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#exampleModal">rules</a>.</label>
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rules</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul>
                                                <li>By checking this box, I acknowledge that I have read and understood the terms and conditions of using this website.</li>
                                                <li>I agree to abide by the community guidelines and policies set forth by the website.</li>
                                                <li>I understand that any comments or ratings I provide on a doctor's profile should be honest, fair, and respectful.</li>
                                                <li>I acknowledge that the comments and ratings I provide may be publicly displayed on the doctor's profile for other members to view.</li>
                                                <li>I understand that any inappropriate or offensive content in my comments or ratings may be removed by the website administrators.</li>
                                                <li>I agree not to use the comments section for any form of advertising, solicitation, or spamming.</li>
                                                <li>I acknowledge that the website reserves the right to moderate, edit, or delete any comments or ratings that violate the website's policies.</li>
                                                <li>I understand that the website does not endorse or guarantee the accuracy of the comments or ratings provided by other members.</li>
                                                <li>I agree to take full responsibility for the comments and ratings I provide, and I will not hold the website or its administrators liable for any consequences arising from my actions.</li>
                                                <li>I acknowledge that the website may use my comments and ratings for statistical analysis or promotional purposes while maintaining my anonymity.</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn col-12 submit_button" type="submit" name="submit">Submit</button>
                                <p class="text-decoration-none text-dark text-center mt-3">Already have an account? <a href="signin.php" class="link-primary text-decoration-underline pe-auto signinhere fw-bolder">Sign in</a>.</p>
                            </div>

                        </form>

                        <?php

                        if (isset($_POST["submit"])) {

                            $FirstName = $_POST["FirstName"];
                            $LastName = $_POST["LastName"];
                            $Email = $_POST["email"];
                            $CIN = $_POST["CIN"];

                            $Password = $_POST["password"];
                            $Confirm_password = $_POST["confirmPassword"];

                            if ($Password === $Confirm_password) {
                                $statement = $conn->prepare("INSERT INTO `members` (`First_name`, `Last_name`, `Email`, `Password`, `C.I.N`, `Admin`) VALUES (?, ?, ?, ?, ?, 0)");
                                $statement->execute([$FirstName, $LastName, $Email, $Password, $CIN]);
                            } else {
                                echo "<p class='text-center link-danger fw-bolder h4 text-decoration-underline'>Passwords doesn't match.</p>";
                            }
                        }

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