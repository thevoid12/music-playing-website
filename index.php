<?php session_start();
require("config.php");
if (isset($_SESSION["username"])) {
  $user = $_SESSION["username"];
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styleindex.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/table.css">
  <link rel="stylesheet" href="css/pl-list.css">

  <style>
    .search {
      background: green;

    }

    .recom {
      color: white;
      position: absolute;
      left: 410px;
      top: 12px;
      font-size: 20px;
      text-decoration: none;
    }
     
    .his {
    color: white;
    position: absolute;
    left: 560px;
    top: 12px;
    font-size: 20px;
    text-decoration: none;
}

    .recom:hover {
      background-color: grey;
    }
  </style>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <!-- Script for adding playlist dropdown button starts-->
  <script src="index.js"></script>
  <!-- Script for adding playlist dropdown button ends-->
</head>

<body>

  <!--code for side bar-->

  <div class="navcolor">

    <a class="search" href="index.php">Home</a>
    <a class="images" href="search.php">Search</a>
    <a class="maps" href="playlist.php">Playlist</a>
    <a class="his" href="history.php">History</a>
    <a class="play" href="albums.php">Albums</a>
    <a class="recom" href="recommend.php">Recomendation</a>
    <?php
    if (isset($_SESSION['username'])) {
      echo '<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</i></a>';
    } else {
      echo '<a href="login.php" class="youtube" >Login</a>
            <a href="registration.php" class="gmail">Register</i></a>';
    }

    ?>


  </div>
  <br><br><br><br>
  <!--image adding using php -->
  <?php
  $a = "select * from songs";
  $result = mysqli_query($con, $a);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row

    while ($row = mysqli_fetch_assoc($result)) {
  ?>
      <div class="image-cls">
        <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
          <img class="image" src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;position:relative;z-index:-10;">
        </span>
        <div class="pl-list">
          <div class='trackOptions'>
            <input type='hidden' class='songId' value=''>
            <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
          </div>
          <nav class="optionsMenu">
            <input type="hidden" class="songId">
            <?php
            $dropdown = '<select class="item playlist" onclick="addsonglist(' . $row["id"] . ',this.value)">
              <option value="">Add to playlist</option>';
            if (isset($_SESSION["username"])) {
              $query_new = mysqli_query($con, "SELECT id, listname FROM playlist WHERE username='$user'");
              while ($row_new = mysqli_fetch_assoc($query_new)) {
                $id = $row_new['id'];
                $name = $row_new['listname'];

                $dropdown = $dropdown . "<option value='" . $id . "'>" . $name . "</option>";
              }
            }
            $dropdown .= "</select>";
            echo $dropdown;
            ?>
          </nav>
        </div>
      </div>
  <?php
    }
  } ?>
  </script>
</body>

</html>