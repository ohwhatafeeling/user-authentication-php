<?php

require_once __DIR__.'/../inc/bootstrap.php';

$bookId = request()->get('bookId');
$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = updateBook($bookId, $bookTitle, $bookDescription);
  redirect('/books.php');
} catch (\Exception $e) {
  redirect('/edit.php?bookId='.$bookId);
}
