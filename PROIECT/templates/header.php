<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>playVersity</title>

  <!-- Custom fonts for this theme -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="css/freelancer.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <!-- Name & Logo -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">

        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="index.php">playVersity</a>
        </div>

        <!--formular login-->
        <div class="container">
            <form method = "post"> 

                <div class="form-row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="username" name="username" placeholder="username"
                            <?php
                                if (isset($_GET['error'])) {
                                    echo 'style="border: 2px solid red;"';
                                }
                            ?>
                        >
                    </div>

                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password"
                            <?php
                                if (isset($_GET['error'])) {
                                    echo 'style="border: 2px solid red;"';
                                }
                            ?>
                        > 
                    </div> 
                </div>

                <div class="form-row">
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-info btn-block" name = "access"><?php echo isLoggedIn() ? 'Log Out' : 'Log In'?></button>
                    </div>

                    <div class="col-sm-3">
                        <a role="button" class="btn btn-info btn-block" href="inscriere.php">Sign Up</a>
                    </div>

                    <div class="col-sm-6">
                        <a role="button" class="btn btn-info btn-block" href="parola.php">Reset Password</a>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <br><br><br><br><br>
</body>