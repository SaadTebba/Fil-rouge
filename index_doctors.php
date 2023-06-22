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

        <div id="hundredVH">

            <header>
                <a href="index_doctors.php" id="logo_container">
                    <img src="images/logo.png" alt="logo">
                    <h2>HealthHub</h2>
                </a>
                <div class="signin-container">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle dropdown_button" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dr. <?php echo $_SESSION['First_name'] . " " . $_SESSION['Last_name']; ?></button>
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

            <div class="container">
                <div class="row">
                    <div class="col-5 h1reg">
                        <h1>Discover, Rate, and Empower Your Health with HealthHub: Your Trusted Guide to Top-rated Doctors in Your Area!</h1>
                    </div>
                </div>
            </div>

        </div>

        <!-- ================================== Section (Page content) ================================== -->

        <section class="container my-4">

            <!-- ================================== Search bar ================================== -->

            <form method="POST">
                <div class="input-group my-5">
                    <input type="search" name="search" id="search" class="form-control" placeholder="Search">
                    <select class="border" name="filter_search">
                        <option value="All">All</option>
                        <option value="Speciality1">Speciality1</option>
                        <option value="Speciality2">Speciality2</option>
                        <option value="Speciality3">Speciality3</option>
                        <option value="Speciality4">Speciality4</option>
                        <option value="Speciality5">Speciality5</option>
                    </select>
                    <button type="submit" class="btn searchbtn border" title="Search"><i class="fas fa-search filtersearch"></i></button>
                </div>
            </form>

            <!-- ================================== H2, Doctors cards ================================== -->

            <h2 class="text-center">Top rated Doctors in Tangier</h2>

            <article class="my-5 card-container d-flex justify-content-center">

                <?php

                $statement = $conn->prepare("SELECT * FROM `doctors` ORDER BY `doctors`.`Rating` DESC LIMIT 4");
                $statement->execute();
                $doctors = $statement->fetchAll();

                foreach ($doctors as $doctor) {

                ?>

                    <div class="card mx-2 mb-2" style="width: 19rem;">
                        <img src="images/Doctors/doctor_male1.jpg" class="card-img-top" alt="doc_pic">
                        <div class="card-body">
                            <h5 class="card-title">Dr. <?php echo $doctor['First_name'] . " " . $doctor['Last_name']; ?></h5>
                            <p class="card-text">
                                <?php

                                $specialty_id = $doctor['Specialty'];

                                $statement = $conn->prepare("SELECT * FROM `specialties` WHERE `Specialty_ID` = :specialty_id");
                                $statement->bindValue(':specialty_id', $specialty_id);
                                $statement->execute();
                                $results = $statement->fetch();

                                echo $results['Specialty'];

                                ?>
                            </p>
                            <p class="card-text"><?php echo $doctor['Hospital'] ?></p>

                            <div class="star-rating">
                                <input type="radio" id="star5" value="5" <?php echo ($doctor['Rating'] >= 5) ? 'checked' : ''; ?> disabled>
                                <label for="star5"></label>
                                <input type="radio" id="star4" value="4" <?php echo ($doctor['Rating'] >= 4 && $doctor['Rating'] < 5) ? 'checked' : ''; ?> disabled>
                                <label for="star4"></label>
                                <input type="radio" id="star3" value="3" <?php echo ($doctor['Rating'] >= 3 && $doctor['Rating'] < 4) ? 'checked' : ''; ?> disabled>
                                <label for="star3"></label>
                                <input type="radio" id="star2" value="2" <?php echo ($doctor['Rating'] >= 2 && $doctor['Rating'] < 3) ? 'checked' : ''; ?> disabled>
                                <label for="star2"></label>
                                <input type="radio" id="star1" value="1" <?php echo ($doctor['Rating'] >= 1 && $doctor['Rating'] < 2) ? 'checked' : ''; ?> disabled>
                                <label for="star1"></label>
                            </div><br>

                            <a href="review_doctor.php?id=<?php echo $doctor['Doctor_ID']; ?>" class="btn review_button">Review</a>
                        </div>
                    </div>

                <?php }; ?>

            </article>

            <div class="discover_container">
                <a href="doctors_memberReg.php" class="btn discover_button">Discover all</a>
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