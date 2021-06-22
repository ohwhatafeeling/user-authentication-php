<?php

require_once __DIR__.'/../inc/bootstrap.php';

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

try {
  $newBook = addBook($bookTitle, $bookDescription);
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
    ['Location'=>'/add.php']
  );
  $response->send();
  exit;
}
