<?php
session_start();
include 'config.php';

if (!isset($_SESSION['idu'])){
	header("Location: login.php");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <link rel="stylesheet" href="./Resource/css/style.css">
    <link rel="stylesheet" href="./Resource/css/stylebar.css">
    <link rel="stylesheet" href="./Resource/css/sidebars.css">
    <link rel="stylesheet" href="./Resource/Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./Resource/font-awesome/css/font-awesome.min.css">
    <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }
    </style>
    <style>
        .wrapper {
            width: 700px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }

        .nav-link:hover {
            background-color: rgb(33, 134, 216);
        }
    </style>

</head>

<?php
		include './template/navbar.php';
        include './template/sidebar.php';
	 ?>

<body class="pt-5">
    <main>
        <div class="container">
            <h2 class="mt-3">Tableau de bord</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">tableau de bord</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gray text-black mb-4">

                        <div class="icon">
                            <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div class="card-body">Nombre des professeurs
                            <?php $record = mysqli_num_rows(mysqli_query($link, "SELECT * FROM professeur")); 
                     echo "<h1 class='card-text'> $record </h1>";
					  ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="big text-black" href="index.php">View Details</a>
                            <div class="big text-black"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gray text-black mb-4">
                        <div class="icon">
                            <i class="fa fa-fw fa-graduation-cap"></i>
                        </div>
                        <div class="card-body">Nombre des classe
                            <?php $record = mysqli_num_rows(mysqli_query($link, "SELECT * FROM classe")); 
                     echo "<h1 class='card-text'> $record</h1>";
					  ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="big text-black" href="indexclasse.php">View Details</a>
                            <div class="big text-black"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gray text-black mb-4">
                        <div class="icon">
                            <i class="fa fa-fw fa-building"></i>
                        </div>
                        <div class="card-body">Nombre des salle
                            <?php $record = mysqli_num_rows(mysqli_query($link, "SELECT * FROM salle")); 
                     echo "<h1 class='card-text'> $record</h1>";
					  ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="big text-black" href="indexsalle.php">View Details</a>
                            <div class="big text-black"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gray text-black mb-4">
                        <div class="icon">
                            <i class="fa fa-fw fa-calendar"></i>
                        </div>
                        <div class="card-body">Emploi du temps
                            <?php $record = mysqli_num_rows(mysqli_query($link, "SELECT * FROM emploi_du_temps")); 
                     echo "<h1 class='card-text'> $record</h1>";
					  ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="big text-black" href="indexemploi.php">View Details</a>
                            <div class="big text-black"><i class="fa fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    </div>
    </div>
    <script src="./Resource/Bootstrap/bootstrap.min.js"></script>
    <script src="./Resource/jquery/js/jquery-1.12.4.min.js"></script>
</body>

</html>