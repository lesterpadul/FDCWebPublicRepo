<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NEWSFEED!</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 20px;
    }
    h2 {
      color: #007bff;
      text-align: center;
      margin-bottom: 20px;
    }
    .welcome {
      font-size: 1.2em;
      margin-bottom: 20px;
      text-align: right;
    }
    .card {
      margin-bottom: 20px;
    }
    .form-group textarea {
      resize: none;
    }
    img, audio {
      display: block;
      margin: 10px auto;
    }
    .file-upload {
      margin-top: 20px;
    }
    .article-card {
      margin-bottom: 15px;
    }
    .article-content {
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="welcome">
      Welcome back! <?php echo $_SESSION['first_name']?>
    </div>
    <hr>
    <h2>NEWSFEED!</h2>

    <div class="articles">
      <?php
        class Newsfeed {
          private $response;
          private $comment;
          private $user;
          private $fileName;
          private $fileType;
          private $fileTmpName;
          private $fileSize;
          private $fileContent;
          private $filePath;
          private $fileURL;
          private $file;

          public function __construct($db, $comment="undefined", $user="undefined", $fileName="undefined", $fileType="undefined", $fileTmpName="undefined", $fileSize="undefined", $fileContent="undefined", $filePath="undefined", $fileURL="undefined", $file="undefined") {
              $this->response = $db->getResponse();
              $this->comment = $comment;
              $this->user = $user;
              $this->fileName = $fileName;
              $this->fileType = $fileType;
              $this->fileTmpName = $fileTmpName;
              $this->fileSize = $fileSize;
              $this->fileContent = $fileContent;
              $this->filePath = $filePath;
              $this->fileURL = $fileURL;
              $this->file = $file;
          }

          public function getArticles() {
              $result = $this->response;
              $count = count($result);
              for($i=0; $i<$count; $i++) {
                  echo '<div class="card article-card">
                          <div class="card-body">
                            <h5 class="card-title">User: '.$result[$i]['user'].'</h5>
                            <p class="card-text article-content">'.$result[$i]['articles'].'</p>
                          </div>
                        </div>';
              }
          }

          public function postArticles($db) {
              if (isset($_POST['submit'])) {
                  $this->comment = $_POST["comment"];
                  $this->user = $_SESSION["first_name"];
                  $query = "INSERT INTO news (articles, user) VALUES ('$this->comment', '$this->user')";
                  $result = $db->sql->query($query);
                  if ($result) {
                      echo "Data inserted successfully.","<br>";
                  } else {
                      throw new Exception("Error: " . $db->sql->error);
                  }
              }
          }

          public function postFiles($db) {
              if (isset($_POST['upload'])) {
                  $this->fileName = $_FILES['file']['name'];
                  $this->fileTmpName = $_FILES['file']['tmp_name'];
                  $this->fileType = $_FILES['file']['type'];
                  $this->filePath = 'uploads/' . $this->fileName;
                  if (!is_dir('uploads')) {
                      mkdir('uploads', 0777, true);
                  }
                  if (move_uploaded_file($this->fileTmpName, $this->filePath)) {
                      $this->fileType = strpos($this->fileType, 'image') !== false ? 'image' : 'audio';

                      $insert = $db->sql->query("INSERT INTO files (file_name, file_path, file_type) VALUES ('".$this->fileName."', '".$this->filePath."', '".$this->fileType."')");
                      if ($insert) {
                          echo "File uploaded successfully.";
                      } else {
                          throw new Exception("File upload failed, please try again.");
                      }
                  } else {
                      throw new Exception("Sorry, there was an error uploading your file.");
                  }
              }
          }

          public function displayFiles($db) {
              $this->verifyFiles();
              $query = "SELECT file_path, file_type FROM files";
              $result = $db->sql->query($query);
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $this->fileURL = $row['file_path'];
                      $this->fileType = $row['file_type'];

                      if ($this->fileType == 'image') {
                          echo '<img src="'.$this->fileURL.'" alt="" class="img-fluid">';
                      } elseif ($this->fileType == 'audio') {
                          echo '<audio controls>
                                  <source src="'.$this->fileURL.'" type="audio/mpeg">
                                  Your browser does not support the audio element.
                                </audio>';
                      }
                  }
              } else {
                  throw new Exception("No files found...");
              }
          }

          private function verifyFiles() {
              if (isset($_POST["file"])) {
                  $this->file = $_POST["file"];
                  if (!$this->fileSize > 5000000) {
                      throw new Exception("File should at least be 5mb!");
                  }
                  if ($this->file !== UPLOAD_ERR_OK) {
                      throw new Exception("File was not uploaded properly!");
                  }
              }
          }
        }

        try {
          $db = new DB();
          $newNewsfeed = new Newsfeed($db);
          $newNewsfeed->getArticles();
          $newNewsfeed->postArticles($db);
          $newNewsfeed->postFiles($db);
          $newNewsfeed->displayFiles($db);
        } catch(Exception $err) {
          echo $err->getMessage();
        }
      ?>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Post Article</h5>
        <form action="" method="POST">
          <div class="form-group">
            <label for="comment"><strong>Article</strong></label>
            <textarea id="comment" name="comment" rows="4" cols="50" class="form-control"></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <div class="card file-upload">
      <div class="card-body">
        <h5 class="card-title">Upload your Files</h5>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <input type="file" name="file" required class="form-control-file">
          </div>
          <button type="submit" name="upload" class="btn btn-success">Upload File</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
