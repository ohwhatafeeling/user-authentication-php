<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>

<div class="container">
    <div class="well col-sm-6 col-sm-offset-3">
        <form class="form-signin" method="post" action="/procedures/doLogin.php">
            <h2 class="form-signin-heading">Please sign in</h2>
            <?php
            echo display_errors();
            echo display_success(); 
            ?>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>
