<?php
// XJCTUKnkjslk123 = Error
// XJCTUKnkjslk133 = Checks database to see if record exists
// XJCTUKnkjslk143 = Success

class Database
{

  private $connection;
  private $pdo;

  function __construct()
  {
    $this->connect_db();
  }
  function __destruct()
  {
    if ($this->connection !== null) {
      $this->connection = null;
      $this->pdo = null;
    }
  }

  public function connect_db()
  {
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'wordalive');
    try {

    }
    catch (PDOException $e) {
      exit("Error: " . $e->getMessage());
    }
    $this->connection = mysqli_connect('localhost', 'root', '', 'wordalive');
    if (mysqli_connect_error()) {
      die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
    }
  }

  public function connect_db_()
  {
    $this->connection = mysqli_connect('localhost', 'root', 'Ney8sCU:E.7f87', 'tosdapd1_wordalive');
    if (mysqli_connect_error()) {
      die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
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
    // $sql = "DELETE FROM ? WHERE `id` = ?";
    $stmt = $this->connection->prepare("DELETE FROM $menu_id WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();    $stmt->close();
    /* $res = $this->connection->prepare("DELETE FROM ? WHERE `id` = ?");
     $res->bind_param("ss", $menu_id, $id);    
     $res->execute(); */
    if (!$stmt) {
      return 'XJCTUKnkjslk123';
    }
    else
      return 'XJCTUKnkjslk143';
  }



  //Written sermon
  // Upload a written sermon    
  public function writtenSermon($topic, $description, $image_path)
  {
    $a = $this->random_str(32);
    $sql = "SELECT * FROM `writtensermon` WHERE `topic` = '$topic' && `description` = '$description' && image_path = '$image_path'" or die(mysqli_error($this->connection));
    ;
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO	writtensermon	(`checker`, `topic`, `description`, `image_path`) VALUES('$a', '$topic', '$description', '$image_path')" or die(mysqli_error($this->connection));
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
    return $res = mysqli_query($this->connection, $sql);
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

  // Series
  // Upload a series    
  public function series($topic, $category, $description, $image_path, $video_path)
  {
    $a = $this->random_str(32);
    $sql = "SELECT * FROM `series` WHERE `topic` = '$topic' && `category` = '$category' && `description` = '$description' && image_path = '$image_path' && video_path = '$video_path'" or die(mysqli_error($this->connection));
    ;
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO series(checker, topic, category, description, image_path, video_path) VALUES('$a', '$topic', '$category', '$description', '$image_path', '$video_path' )" or die(mysqli_error($this->connection));
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



  // Upload Sermon  
  public function sermon($title, $date, $preacher, $image_path, $video_path, $video_link )
  {
    $sql = "SELECT * FROM `sermon` WHERE `title` = '$title' && `preacher` = '$preacher' && `date` = '$date' && image_path = '$image_path' && video_path = '$video_path'";
    $res = $this->connection->query($sql);
    if (mysqli_num_rows($res) > 0) {
      return 'XJCTUKnkjslk133';
    }
    else {
      $sql = "INSERT INTO sermon(title, date, preacher, video_link , image_path, video_path) VALUES('$title', '$date', '$preacher', `$video_link`, '$image_path', '$video_path' )" or die(mysqli_error($this->connection));
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
  public function countMail()
  {
    $sql = "SELECT * from mails where read_mail = 'No'";
    $sql2 = "SELECT * from mails";
    $res = mysqli_query($this->connection, $sql);
    $total = mysqli_query($this->connection, $sql2);
    $unread = mysqli_num_rows($res);
    $total = mysqli_num_rows($total);
    $percentage_read = ($unread / $total) * 100;
    return array($unread, $total, $percentage_read);
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