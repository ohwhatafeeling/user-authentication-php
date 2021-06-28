
<div class="media well">
    <div class="media-body">
      <h4 class="media-heading"><?php echo $book['name']; ?></h4>
      <p><?php echo $book['description']; ?></p>
      <p>
        <span><a href="/edit.php?bookId=<?php echo $book['id']; ?>">Edit</a> | </span>
        <span><a href="/procedures/deleteBook.php?bookId=<?php echo $book['id']; ?>">Delete</a></span>
      </p>
    </div>
</div>
