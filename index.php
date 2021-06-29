<?php
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
require __DIR__ . '/inc/bootstrap.php';

if (request()->cookies->has('access_token')) {
  echo 'Logged in';
}
?>
<div class="container">
    <div class="well">
        <h2>Book Voting System</h2>
        <p>Welcome to the book voting system.  Use this system to submit books you like and see if others like them as well
        by letting them upvote it.</p>
    </div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';
