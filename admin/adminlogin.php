<?php
session_start();
require '../connection.php';
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["username"]) || empty($_POST["username"])) {
        array_push($errors, "Username is required.");
    }
    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        array_push($errors, "Password is required.");
    } else if (strlen($_POST["password"]) < 8) {
        array_push($errors, "Password should be more than or equal to 8 characters.");
    } else if (strlen($_POST["password"]) > 40) {
        array_push($errors, "Password should be less than 40 characters.");
    }
    if (count($errors) === 0) {
        $uname = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $username = mysqli_real_escape_string($conn, $uname);
        $password = mysqli_real_escape_string($conn, $pass);
        $query = mysqli_query($conn, "SELECT email, password FROM user WHERE email='$username'");
        if (mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
            if ($user['password'] === $password) {
                $_SESSION['username'] = $user['email'];
                $_SESSION['is_loggedin'] = true;
                header("Location: AdminPanel.html");
                exit();
            } else {
                array_push($errors, "The username or password is incorrect.");
            }
        } else {
            array_push($errors, "The username or password is incorrect.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gradient-custom-3 {
            background: #84fab0;
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
        }
        .gradient-custom-4 {
            background: #84fab0;
            background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
        }
        .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-link {
            text-decoration: none;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            font-size: 2rem;
            color: #27d868;
        }
        .logo-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<section class="vh-100 bg-image" style="background-image: url('img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <div class="logo-section">
                                <a href="homepage.html" class="logo-link">NEW@NEWS</a>
                            </div>
                            <h2 class="text-uppercase text-center mb-5">Admin Login</h2>

                            <?php if ((isset($errors) && count($errors)) > 0) { ?>
                                <div class="alert alert-danger">
                                    <ul class="my-0 list-unstyled">
                                        <?php foreach ($errors as $error) { ?>
                                            <li><?php echo $error; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <form action="adminlogin.php" method="POST">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox" id="rememberMe" />
                                    <label class="form-check-label" for="rememberMe">
                                        Remember me
                                    </label>
                                </div>
                                <div class="text-center mb-3">
                                    <a href="reset_password.php" class="text-body"><u>Forgot password?</u></a>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Login</button>
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Don't have an account?
                                    <a href="register_news.php" class="fw-bold text-body text-decoration-none"><u>Register here</u></a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="js/bootstrap.min.js"></script>
</body>
</html>