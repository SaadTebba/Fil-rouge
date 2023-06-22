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
                <a href="signin.php" id="sign_in_text">Sign in</a>
                <img src="images/user.png" alt="user" id="user_image">
            </div>
        </header>

        <!-- ================================== Section (Page content) ================================== -->

        <section class="container my-4">

            <div class="profile-container row">

                <div class="profile-left col-4">
                    <img src="images/doctors/doctor_male1.jpg" alt="profile_photo">
                    <h3>Dr.
                        <?php

                        $doctor_id = $_GET['id'];
                        $statement = $conn->prepare("SELECT doctors.*, specialties.specialty FROM doctors JOIN specialties ON doctors.Specialty = specialties.Specialty_ID WHERE doctors.Doctor_ID = :doctor_id");
                        $statement->bindParam(':doctor_id', $doctor_id);
                        $statement->execute();

                        $results = $statement->fetch();
                        echo $results['First_name'] . " " . $results['Last_name'];

                        ?>
                    </h3>
                    <?php

                    $statement = $conn->prepare("SELECT * FROM `Doctors` WHERE `Doctor_ID` = :doctor_id");
                    $statement->bindValue(':doctor_id', $doctor_id);
                    $statement->execute();

                    $row = $statement->fetch();

                    ?>

                    <div class="star-rating">
                        <input type="radio" id="star5" name="rating" value="5" <?php echo ($row['Rating'] >= 5) ? 'checked' : ''; ?> disabled>
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4" <?php echo ($row['Rating'] <= 5 && $row['Rating'] > 4) ? 'checked' : ''; ?> disabled>
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3" <?php echo ($row['Rating'] <= 4 && $row['Rating'] > 3) ? 'checked' : ''; ?> disabled>
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2" <?php echo ($row['Rating'] <= 3 && $row['Rating'] > 2) ? 'checked' : ''; ?> disabled>
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1" <?php echo ($row['Rating'] <= 2 && $row['Rating'] >= 1) ? 'checked' : ''; ?> disabled>
                        <label for="star1"></label>
                    </div>

                </div>

                <div class="profile-right col-4">
                    <h2>Doctor Overview</h2>
                    <p>Education: <?php echo $results['Education']; ?></p>
                    <p>Specialization: <?php echo $results['specialty']; ?></p>
                    <p>Experience: <?php echo $results['Experience']; ?> years</p>
                    <p>Current Hospital Affiliations: <?php echo $results['Hospital']; ?> Hospital</p>
                    <p>Languages Spoken:
                        <?php

                        $statement = $conn->prepare("SELECT languages.Language, doctor_speaks_language.Level FROM languages JOIN doctor_speaks_language ON languages.Language_ID = doctor_speaks_language.Language_ID WHERE doctor_speaks_language.Doctor_ID = :doctor_id");
                        $statement->bindParam(':doctor_id', $doctor_id);
                        $statement->execute();
                        $languages_spoken = $statement->fetchAll();

                        echo "<ul>";

                        foreach ($languages_spoken as $language) {
                            echo "<li>" . $language['Language'] . ': ' . $language['Level'] . "</li>";
                        }

                        echo "</ul>";

                        ?>
                    </p>
                </div>

                <div class="col-3">

                    <h2>Comments</h2>

                    <?php

                    $doc_id_parameter = $_GET['id'];

                    $statement = $conn->prepare("SELECT * FROM `comments` WHERE `Doctor_ID` = ?");
                    $statement->execute([$doc_id_parameter]);
                    $comments = $statement->fetchAll();

                    foreach ($comments as $comment) {
                    ?>

                        <div class="card my-2">
                            <div class="card-body">
                                <h3 class="card-title">
                                    <?php
                                    $member_id = $comment['Member_ID'];

                                    $statement_member = $conn->prepare("SELECT * FROM `Members` WHERE `Member_ID` = ?");
                                    $statement_member->execute([$member_id]);
                                    $member = $statement_member->fetch();

                                    echo $member['First_name'] . " " . $member['Last_name'];
                                    ?>
                                </h3>
                                <p class="card-text"><?php echo $comment['Comment']; ?></p>
                            </div>
                        </div>

                    <?php }; ?>

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