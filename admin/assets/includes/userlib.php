<?php
class User {
  // (A) CONNECT TO DATABASE
  public $error = "";
  private $pdo = null;
  private $stmt = null;
  function __construct () {
  try {
    
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    } catch (Exception $ex) { exit($ex->getMessage()); }
  }
 
  // (B) CLOSE CONNECTION
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }
 
  // (C) RUN SQL QUERY
  function query ($sql, $data=null) {
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      return true;
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
  }

  // function save($name, $username, $email, $password, $id = null)
  // {
  //   if ($id === null) {
  //     $password = password_hash($password, PASSWORD_DEFAULT);
  //     $stmt = $this->connection->prepare("INSERT INTO `users` (`name`,`username`, `email`, `password`) VALUES (?,?,?,?)");
  //     $stmt->bind_param("ssss", $name, $username, $email, $password);
  //   }
  //   else {
  //     $stmt = $this->connection->prepare("UPDATE `users` SET `name`=?, `email`=? WHERE `id`=?");
  //     $stmt->bind_param("ssi", $name, $username, $id);
  //   }
  //   return $stmt->execute();

  // }

 
  // (D) SAVE USER
  function save ($name, $username, $email, $password, $id = null) {
    if ($id===null) {
      $sql = "INSERT INTO `users` (`name`,`username`, `email`, `password`) VALUES (?,?,?,?)";
      $data = [$name, $username, $email, password_hash($password, PASSWORD_DEFAULT)];
    } else {
      $sql = "UPDATE `users` SET `name`=?, `email`=? WHERE `id`=?";
      $data = [$name, $email, $id];
    }
    return $this->query($sql, $data);
  }
 
  // (E) GET USER
  function get ($id) {
    $this->query(sprintf("SELECT * FROM `users` WHERE `%s`=?",
      is_numeric($id) ? "id" : "email"
    ), [$id]);
    return $this->stmt->fetch();
  }
 
  // (F) VERIFY USER
  function verify ($email, $password) {     
    $user = $this->get($email);     
    $valid = is_array($user);     
 
    if ($valid) {      
      $valid = password_verify($password, $user["password"]);                
    }     
    if ($valid) {        
        return $user; }
    else {
      $this->error = "Invalid user/password";     
      return false;
    } 
  }
}


?>