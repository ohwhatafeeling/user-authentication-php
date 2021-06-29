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

function deleteBook($bookId) {
  global $db;

  try {
    $query = 'DELETE FROM books WHERE id = :bookId';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':bookId', $bookId);
    $stmt->execute();
    return true;
  } catch (\Exception $e) {
    return false;
  }
}

function getAllBooks() {
  global $db;

  try {
    $query = 'SELECT books.*, SUM(votes.value) AS score
    FROM books
    LEFT JOIN votes ON (books.id=votes.book_id)
    GROUP BY books.id
    ORDER BY score DESC';
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

function vote($bookId, $score) {
  global $db;
  $userId = 0;

  try {
    $query = 'INSERT INTO votes (book_id, user_id, value) VALUES (:bookId, :userId, :score)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':bookId', $bookId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':score', $score);
    $stmt->execute();
  } catch (\Exception $e) {
    die('Something happen with the voting. Please try again');
  }
}

function redirect($path, $extra =[]) {
  $response = \Symfony\Component\HttpFoundation\Response::create(
    null,
    \Symfony\Component\HttpFoundation\Response::HTTP_FOUND,
    ['Location' => $path]
  );
  if (key_exists('cookies', $extra)) {
    foreach ($extra['cookies'] as $cookie) {
      $response->headers->setCookie($cookie);
    }
  }
  $response->send();
  exit;
}

function findUserByEmail($email) {
  global $db;

  try {
    $query = 'SELECT * FROM users WHERE email = :email';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (\Exception $e) {
    throw $e;
  }
}

function createUser($email, $password) {
  global $db;

  try {
    $query = 'INSERT INTO users (email, password, role_id) VALUES (:email, :password, 2)';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return findUserByEmail($email);
  } catch (\Exception $e) {
    throw $e;
  }
}

function isAuthenticated() {
  if (!request()->cookies->has('access_token')) {
    return false;
  }
  try {
    \Firebase\JWT\JWT::$leeway = 1;
    \Firebase\JWT\JWT::decode(
      request()->cookies->get('access_token'),
      getenv('SECRET_KEY'),
      ['HS256']
    );
    return true;
  } catch (\Exception $e) {
    return false;
  }
}

function requireAuth() {
  if (!isAuthenticated()) {
    $accessToken = new \Symfony\Component\HttpFoundation\Cookie("access_token", "Expired", time() - 3600, '/', getenv('COOKIE_DOMAIN'));
    redirect('/login.php', ['cookies' => [$accessToken]]);
  }
}
