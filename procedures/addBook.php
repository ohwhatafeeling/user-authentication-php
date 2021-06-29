<?php

require_once __DIR__.'/../inc/bootstrap.php';
requireAuth();

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = addBook($bookTitle, $bookDescription);
  $session->getFlashBag()->add('success', 'Book was added');
  redirect('/books.php');
} catch (\Exception $e) {
  $session->getFlashBag()->add('error', 'Problem adding book');
  redirect('/add.php');
}
