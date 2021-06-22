<?php

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function request() {
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function addBook($title, $description) {
  global $db;
  $ownerId = 0;

  try {
    $query = 'INSERT INTO books (name, description, owner_id) VALUES (:name, :description, :ownerId)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':ownerId', $ownerId);
    return $stmt->execute();
  } catch (\Exception $e) {
    throw $e;
  }
}

function getAllBooks() {
  global $db;

  try {
    $query = 'SELECT * FROM books';
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
  } catch (\Exception $e) {
    throw $e;
  }
}
