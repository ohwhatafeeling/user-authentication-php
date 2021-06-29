<?php

require_once __DIR__.'/../inc/bootstrap.php';
requireAuth();

$bookId = request()->get('bookId');
$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = updateBook($bookId, $bookTitle, $bookDescription);
  $session->getFlashBag()->add('success', 'Book updated');
  redirect('/books.php');
} catch (\Exception $e) {
  $session->getFlashBag()->add('error', 'Unable to update book');
  redirect('/edit.php?bookId='.$bookId);
}
