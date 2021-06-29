<?php

require_once __DIR__.'/../inc/bootstrap.php';
requireAuth();

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = addBook($bookTitle, $bookDescription);
  redirect('/books.php');
} catch (\Exception $e) {
  redirect('/add.php');
}
