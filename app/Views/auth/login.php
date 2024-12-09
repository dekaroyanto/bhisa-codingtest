<!-- <form method="post" action="/login">
    <input type="text" name="email_or_username" placeholder="Email or Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Login Form' ?></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="<?= base_url('loginform/fonts/material-icon/css/material-design-iconic-font.min.css') ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('loginform/css/style.css') ?>">
</head>

<body>

    <div class="main">


        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="<?= base_url('loginform/images/loginlogo.jpg') ?>" alt="sign in image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="/login">
                            <div class="form-group">
                                <label for="email_or_username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email_or_username" id="email_or_username" placeholder="Username/Email" />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="<?= base_url('loginform/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('loginform/js/main.js') ?>"></script>
</body>

</html>