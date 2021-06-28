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

function updateBook($bookId, $title, $description) {
  global $db;

  try {
    $query = 'UPDATE books SET name=:name, description=:description WHERE id=:bookId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':bookId', $bookId);
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

function getBook($bookId) {
  global $db;

  try {
    $query = 'SELECT * FROM books WHERE id = ?';
    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $bookId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (\Exception $e) {
    throw $e;
  }
}
