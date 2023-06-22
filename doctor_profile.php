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

        <!-- ================================== First 100vh: Header ================================== -->

        <header>
            <a href="index.php" id="logo_container">
                <img src="images/logo.png" alt="logo">
                <h2>HealthHub</h2>
            </a>
            <div class="signin-container">

                <div class="dropdown">
                    <button class="btn dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dr. Fname Lname</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="doctor_edit_profile.php">Edit profile</a></li>
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

        <section class="container my-4 profile-container">

            <div class="profile-left">
                <img src="images/doctors/doctor_male1.jpg" alt="profile_photo">
                <h3>Dr. Benjamin Thompson</h3>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                </div>
                <a href="doctor_edit_profile.php" class="btn edit-button">Edit Profile</a>
            </div>

            <div class="profile-right">
                <h2>Doctor Overview</h2>
                <p>Education: University of Medical Sciences</p>
                <p>Specialization: Cardiology</p>
                <p>Experience: 15+ years</p>
                <p>Hospital Affiliations:</p>
                <ul>
                    <li>Cardio Care Hospital</li>
                    <li>Heart Center Medical</li>
                    <li>MediLife Hospital</li>
                </ul>
                <p>Languages Spoken:</p>
                <ul>
                    <li>English</li>
                    <li>Spanish</li>
                    <li>French</li>
                </ul>
                <p>Board Certification: American Board of Cardiology</p>
                <p>Professional Memberships:</p>
                <ul>
                    <li>American Heart Association</li>
                    <li>Cardiology Society of XYZ</li>
                </ul>
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