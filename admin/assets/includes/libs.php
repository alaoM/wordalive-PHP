<?php
// XJCTUKnkjslk123 = Error
// XJCTUKnkjslk133 = Checks database to see if record exists
// XJCTUKnkjslk143 = Success

class Database
{

  private $connection = null;
  private $pdo;

  private $db;

  public $error = "";


  function __construct()
  {
    $this->connect_db();
  }
  function __destruct()
  {
    if ($this->connection !== null) {
      $this->connection = null;
    }
  }

  public function connect_db()
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
      require __DIR__ . '/cerd.php';
      $this->connection = new mysqli($host, $user, $pass, $db, $port);
      $this->connection->set_charset($charset);
      $this->connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
    }
    catch (\mysqli_sql_exception $e) {
      throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
    }
    finally {
      unset($host, $db, $user, $pass, $charset);
    }

  }




  function logger($message, array $data, $logFile = "./error.log")
  {
    foreach ($data as $key => $value) {
      $message = str_replace("%{$key}%", $value, $message);
    }
    $message .= PHP_EOL;
    return file_put_contents($logFile, $message, FILE_APPEND);
  }

  // delete any post

  public function deletePost($menu_id, $id)
  {

    $stmt = $this->connection->prepare("DELETE FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    if (!$stmt) {
      return 'XJCTUKnkjslk123';
    }
    else
      return 'XJCTUKnkjslk143';
  }
  function save($role, $name, $username, $email, $password, $id = null)
  {
    try {
      if ($id === null) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connection->prepare("INSERT INTO `users` (`role`, `name`,`username`, `email`, `password`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$role, $name, $username, $email, $password);
      }
      else {
        $stmt = $this->connection->prepare("UPDATE `users` SET `name`=?, `email`=? WHERE `id`=?");
        $stmt->bind_param("ssi", $name, $username, $id);
      }
      return $stmt->execute();
    }
    catch (Exception $e) {
      echo $e;
     $this->error = "Record Exists";
     return false;
    
    }
  }



  function get($id)
  {
    try {
      $stmt = $this->connection->prepare(sprintf("SELECT * FROM `users` WHERE `%s`=?",
        is_numeric($id) ? "id" : "email"));
      $stmt->bind_param("s", $id);
      $stmt->execute();
      return $stmt->get_result();
    }
    catch (Exception $th) {
      $this->error = $th->getMessage();
      return false;
    }
  }


  function verify($email, $password)
  {
    $user = $this->get($email);
    $valid = is_array($user);
    if ($user->num_rows == 1) {
      while ($row = mysqli_fetch_array($user, MYSQLI_ASSOC)) {
        $valid = password_verify($password, $row['password']);
        if (!$valid) {
          $this->error = "Invalid user/password";
          return false;
        }
        if ($valid) {
          require "vendor/autoload.php";
          $now = strtotime("now");
          return Firebase\JWT\JWT::encode([
            "iat" => $now,
            "nbf" => $now,
            "exp" => $now + 3600,
            "jti" => base64_encode(random_bytes(16)),
            "iss" => JWT_ISSUER,
            "aud" => JWT_AUD,
            "data" => [
              "id" => $row["id"],
              "role" => $row["role"],
              "name" => $row["name"],
              "email" => $row["email"]
            ]
          ], JWT_SECRET, JWT_ALGO);
        }
      }
    }
    else {
      $this->error = "Invalid user/password";
      return false;
    }
  }

  function validate($jwt)
  {
    require "vendor/autoload.php";
    try {
      $jwt = Firebase\JWT\JWT::decode($jwt, new Firebase\JWT\Key(JWT_SECRET, JWT_ALGO));
      $valid = is_object($jwt);
    }
    catch (Exception $e) {
      $this->error = $e->getMessage();
      return false;
    }

    // (G3) RETURN RESULT
    if ($valid) {
      $user = $this->get($jwt->data->id);
      $valid = is_array($user);
      if ($user->num_rows == 1) {
        while ($row = mysqli_fetch_array($user, MYSQLI_ASSOC)) {
          unset($row["password"]);
          return $row;
        }
      }
    }
    else {
      $this->error = "Invalid JWT";
      return false;
    }
  }

  //Written sermon
  // Upload a written sermon    
  public function writtenSermon($topic, $description, $video_link, $image_path, $video_path)
  {
    $a = $this->random_str(32);
    $sql = "SELECT * FROM `writtensermon` WHERE `topic` = '$topic' && `description` = '$description' && image_path = '$image_path'" or die(mysqli_error($this->connection));
    ;
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO	writtensermon	(`checker`, `topic`, `description`, video_link, `image_path`, `video_path`) VALUES('$a', '$topic', '$description', `$video_link`, '$image_path', $video_path)" or die(mysqli_error($this->connection));
      $res = $this->connection->query($sql);
      if (!$res) {
        return 'XJCTUKnkjslk123';
      }
      else
        return 'XJCTUKnkjslk143';
    }
  }

  // Fetch written sermon
  public function fetchWrittenSermon()
  {
    $sql = "SELECT * FROM `writtensermon` WHERE `topic` !='' ORDER BY timestamp DESC" or die(mysqli_error($this->connection));
    $res = $this->connection->query($sql);
    return $res;
  }
  // Fetch Sermon by id
  public function fetchWrittenSermonById()
  {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $checker = substr($url, -32);

    $sql = "SELECT * FROM `writtensermon` WHERE `checker` = '$checker'";
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_array($res)) {
        $topic = $row['topic'];
        $description = $row['description'];
        $image_path = $row['image_path'];
        $encode = array($topic, $description, $image_path);
        return $encode;
      }
    }
  // return $encode;
  }
  public function fetchWrittenSermonID($menu_id, $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          "topic" => $row['topic'],
          "description" => $row['description'],
          "image_path" => $row['image_path'],
          "TimeStamp" => $row['TimeStamp'],
        );
        return $encode;
      }
    }
    else if (!$res) {
      return 'XJCTUKnkjslk123';
    }
  }


  // Upload Portfolio
  public function portfolio($title, $subtitle, $portfolio, $image_path, $video_url)
  {
    $sql = "INSERT INTO portfolio(title, subtitle, portfolio, image_path, video_uri) VALUES('$title', '$subtitle', '$portfolio', '$image_path', '$video_url' )" or die(mysqli_error($this->connection));
    $res = $this->connection->query($sql);
    if (!$res) {
      return 'XJCTUKnkjslk123';
    }
    else
      return 'XJCTUKnkjslk143';
  }
  // Fetch portfolio
  public function fetchPortfolio()
  {
    $encode = "";
    $sql = "SELECT * FROM `portfolio` ORDER BY timestamp DESC ";
    $stmt = $this->connection->query($sql);
    $res = $stmt->fetch_all(MYSQLI_ASSOC);
    return $res;
  }
  public function fetchPortfolioByID($menu_id, $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          "title" => $row['title'],
          "subtitle" => $row['subtitle'],
          "image_path" => $row['image_path'],
          "TimeStamp" => $row['TimeStamp'],
        );
        return $encode;
      }
    }
    else if (!$res) {
      return 'XJCTUKnkjslk123';
    }

  }
  // Upload Events
  public function events($title, $location, $date, $flier_path)
  {
    $sql = "SELECT * FROM `events` WHERE `title` = '$title' && `location` = '$location' && `date` = '$date'";
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO events(title, location, date, flier_path) VALUES('$title', '$location', '$date', '$flier_path' )" or die(mysqli_error($this->connection));
      $res = $this->connection->query($sql);
      if (!$res) {
        return 'XJCTUKnkjslk123';
      }
      else
        return 'XJCTUKnkjslk143';
    }
  }
  // Fetch Events
  public function fetchEvents()
  {
    $encode = "";
    $sql = "SELECT * FROM `events` ORDER BY timestamp DESC limit 1";
    $res = mysqli_query($this->connection, $sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_array($res)) {
        $title = $row['title'];
        $location = $row['location'];
        $eventDate = $row['date'];
        $encode = array($title, $location, $eventDate);
      }
    }
    return $encode;
  }
  public function fetchEventPage()
  {
    $sql = "SELECT * FROM `events` ORDER BY timestamp DESC";
    $res = mysqli_query($this->connection, $sql);
    return $res;
  }
  public function fetchEventID($menu_id, $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          "title" => $row['title'],
          "location" => $row['location'],
          "date" => $row['date'],
          "image_path" => $row['flier_path'],
        );
        return $encode;
      }
    }
    else if (!$res) {
      return 'XJCTUKnkjslk123';
    }
  }

  // Series
  // Upload a series    
  public function series($topic, $category, $description, $preacher, $image_path, $video_link, $video_path)
  {
    $a = $this->random_str(32);
    $sql = "SELECT * FROM `series` WHERE `topic` = '$topic' && `category` = '$category' && `description` = '$description' && image_path = '$image_path' && video_path = '$video_path'" or die(mysqli_error($this->connection));
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO series(checker, topic, category, description, preacher, image_path,video_link, video_path) VALUES('$a', '$topic', '$category', '$description', '$preacher', '$image_path', '$video_link', '$video_path' )" or die(mysqli_error($this->connection));
      $res = $this->connection->query($sql);
      if (!$res) {
        return 'XJCTUKnkjslk123';
      }
      else
        return 'XJCTUKnkjslk143';
    }
  }

  // Fetch a Series
  public function fetchSeries()
  {
    $sql = "SELECT * FROM `series` WHERE (`image_path` != '') ORDER BY timestamp DESC";
    $res = mysqli_query($this->connection, $sql);
    return $res;
  }
  public function fetchSingleSeries()
  {
    $sql = "SELECT * FROM `series` ORDER BY timestamp DESC LIMIT 8";
    $res = mysqli_query($this->connection, $sql);
    return $res;
  }
  // Fetch Sermon by id
  public function fetchSeriesById()
  {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $checker = substr($url, -32);

    $sql = "SELECT * FROM `series` WHERE `checker` = '$checker'";
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_array($res)) {
        $topic = $row['topic'];
        $description = $row['description'];
        $image_path = $row['image_path'];
        $encode = array($topic, $description, $image_path);
      }
    }
    return $encode;
  }
  public function fetchSeriesID($menu_id, $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          "topic" => $row['topic'],
          "description" => $row['description'],
          "category" => $row['category'],
          "preacher" => $row['preacher'],
          "image_path" => $row['image_path'],
          "video_link" => $row['video_link'],
          "video_path" => $row['video_path'],
          "TimeStamp" => $row['TimeStamp'],
        );
        return $encode;
      }
    }
    else if (!$res) {
      return 'XJCTUKnkjslk123';
    }
  }


  // Upload Sermon  
  public function sermon($title, $date, $preacher, $image_path, $video_path, $video_link)
  {
    $sql = "SELECT * FROM `sermon` WHERE `title` = '$title' && `preacher` = '$preacher' && `date` = '$date' && image_path = '$image_path' && video_path = '$video_path'";
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO sermon(title, date, preacher , image_path, video_path, video_link) VALUES('$title', '$date', '$preacher', '$image_path', '$video_path',  '$video_link')" or die(mysqli_error($this->connection));
      $res = $this->connection->query($sql);
      if (!$res) {
        return 'XJCTUKnkjslk123';
      }
      else
        return 'XJCTUKnkjslk143';
    }
  }
  // fetch sermon
  public function fetchHomePageSermons()
  {
    $sql = "SELECT * FROM `sermon` ORDER BY timestamp DESC limit 1";
    $res = mysqli_query($this->connection, $sql);
    if (mysqli_num_rows($res) > 0) {
      while ($row = mysqli_fetch_array($res)) {
        $sermon_title = $row['title'];
        $date = $row['date'];
        $preacher = $row['preacher'];
        $video_path = $row['video_path'];
        $encode = array($sermon_title, $date, $preacher, $video_path);
      }
    }
    return $encode;
  }
  public function fetchSermonPageSermons()
  {
    $sql = "SELECT * FROM `sermon` WHERE (`video_path` != '') ORDER BY timestamp DESC";
    $res = mysqli_query($this->connection, $sql);
    return $res;
  }
  public function fetchSermonID($menu_id, $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $res = $stmt->get_result();


    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          "title" => $row['title'],
          "date" => $row['date'],
          "preacher" => $row['preacher'],
          "image_path" => $row['image_path'],
          "video_link" => $row['video_link'],
          "video_path" => $row['video_path'],
        );
        return $encode;
      }
    }
    else if (!$res) {
      return 'XJCTUKnkjslk123';
    }
  }


  // Mail Functions
  public function mail($sender, $from_email, $subject, $body, $phone_number)
  {
    $sql = "INSERT INTO mails(sender_name, sender_email, subject, message, phoneNumber, read_mail) VALUES('$sender', '$from_email', '$subject','$body', '$phone_number', 'No' )" or die(mysqli_error($this->connection));
    $res = $this->connection->query($sql);
    if ($res) {
      return true;
    }
    else {
      return false;
    }
  }
  // Read Email
  public function readEmail()
  {
    $sql = "SELECT * FROM mails WHERE read_mail = 'No' LIMIT 5 ";
    $res = mysqli_query($this->connection, $sql);
    return $res;
  }
  // count mails
  public function count()
  {
    
    $stmt = $this->connection->prepare("SELECT ( SELECT COUNT(*) FROM mails WHERE read_mail = 'No' ) AS unreadMail, ( SELECT COUNT(*) FROM mails ) AS totalMails, ( SELECT COUNT(*) FROM events ) AS events, ( SELECT COUNT(*) FROM portfolio ) AS portfolio, ( SELECT COUNT(*) FROM series ) AS series, ( SELECT COUNT(*) FROM sermon ) AS sermon, ( SELECT COUNT(*) FROM writtensermon ) AS writtensermon FROM dual;");
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 1) {
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        $encode = array(
          $row['totalMails'],
          $row['unreadMail'],
          ($row['unreadMail'] / $row['totalMails']) * 100,
          $row['events'],
          $row['portfolio'],
          $row['series'],
          $row['sermon'],
          $row['writtensermon'],
        );

        return $encode;
      }
    }
  /*  $res = mysqli_query($this->connection, $sql);
   $total = mysqli_query($this->connection, $sql2);
   $unread = mysqli_num_rows($res);
   $total = mysqli_num_rows($total);
   $percentage_read = ($unread / $total) * 100;
   return array($unread, $total, $percentage_read); */
  }


  // Sanitize inputs
  public function sanitize($var)
  {
    $return = mysqli_real_escape_string($this->connection, $var);
    return $return;
  }
  public function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string
  {
    if ($length < 1) {
      throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
      $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
  }
  // redirect pages
  public function redirect($url, $statusCode = 303)
  {
    header('Location: ' . $url, true, $statusCode);
    die();
  }




}






$database = new Database();

?>