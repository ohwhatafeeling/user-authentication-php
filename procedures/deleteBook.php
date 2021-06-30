<?php
require_once __DIR__.'/../inc/bootstrap.php';
requireAuth();

$bookId = getBook(request()->get('bookId'));
deleteBook($bookId['id']);
$session->getFlashBag()->add('success', 'Book deleted');
redirect('/books.php');
