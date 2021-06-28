<?php

require __DIR__.'/../inc/bootstrap.php';

$vote = request()->get('vote');
$bookId = request()->get('bookId');

switch (strtolower($vote)) {
  case 'up':
    vote($bookId, 1);
    break;
  case 'down':
    vote($bookId, -1);
    break;
}

redirect('/books.php');
