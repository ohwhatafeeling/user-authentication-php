<?php

require_once __DIR__.'/../inc/bootstrap.php';

$bookId = request()->get('bookId');
$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = updateBook($bookId, $bookTitle, $bookDescription);
  $response = \Symfony\Component\HttpFoundation\Response::create(
    null,
    \Symfony\Component\HttpFoundation\Response::HTTP_FOUND,
    ['Location'=>'/books.php']
  );
  $response->send();
  exit;
} catch (\Exception $e) {
  $response = \Symfony\Component\HttpFoundation\Response::create(
    null,
    \Symfony\Component\HttpFoundation\Response::HTTP_FOUND,
    ['Location'=>'/edit.php?bookId='.$bookId]
  );
  $response->send();
  exit;
}
