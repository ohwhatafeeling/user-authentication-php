<?php
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>
<div class="container">
    <div class="well">
        <h2>Add a book</h2>
        <form class="form-horizontal" method="post" action="procedures/addBook.php">
        <?php include __DIR__.'/inc/bookForm.php'; ?>
        </form>
    </div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';
