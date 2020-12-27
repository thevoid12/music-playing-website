<?php
session_start();
require("config.php");
?>
<style>
    .recom {
        background: green;
    }

    .recom {
        color: white;
        position: absolute;
        left: 400px;
        top: 12px;
        font-size: 20px;
        text-decoration: none;
    }

    .recom:hover {
        background-color: grey;
    }
</style>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styleindex.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/nav.css">
</head>

<body>
    <!--navigation bar -->
    <!--code for side bar-->
    <div class="navcolor">

        <a class="search" href="index.php">Home</a>
        <a class="images" href="search.php">Search</a>
        <a class="maps" href="playlist.php">Playlist</a>
        <a class="play" href="albums.php">Albums</a>

        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="logout.php" class="youtube" >Logout</a>
            <a href="profile.php" class="gmail">Profile</i></a>';
        } else {
            echo '<a href="login.php" class="youtube" >Login</a>
            <a href="registration.php" class="gmail">Register</i></a>';
        }

        ?>
        <a class="recom" href="history.php">History</a>
    </div>
    <br><br><br>

<!------------------------------------------------------------------------------------------>
<?php
class history
{
    protected $stack;
    protected $limit;
    
    public function __construct($limit = 10) {
        // initialization of stack
        $this->stack = array();
        // tells the limit of items
        $this->limit = $limit;
    }

    public function push($item) {
        // stack overflow
        if (count($this->stack) < $this->limit) {
            // add to the beginning of an array
            array_unshift($this->stack, $item);
        } else {
            throw new RunTimeException('Stack is full!'); 
        }
    }

    public function pop() {
        if ($this->isEmpty()) {
            // stack underflow
	      throw new RunTimeException('Stack is empty!');
	  } else {
            // pop item from the start of the array
            return array_shift($this->stack);
        }
    }

     public function isEmpty() {
        return empty($this->stack);
    }

    public function top() {
        return current($this->stack);
    }

}
?>
<?php
if(isset($_POST['clear']))
{
if(isset($_SESSION['stack']))
unset($_SESSION['stack']);
    }
if(isset($_SESSION['stack'])){
$obj=unserialize($_SESSION['stack']);
 // outputs 'songs'
while(!($obj->isEmpty()))
{
    $sid=$obj->pop();
    $a = "select * from songs where id='$sid'";
        $result = $con->query($a);
        if ($result->num_rows > 0) {
            // output data of each row

            while ($row = $result->fetch_assoc()) {
?>
                <span role='link' tabindex='0' onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
                    <img src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;">
                </span>
 <?php
            }

        }
        //session_destroy();
}
    }// outputs 'songs'
?>
    <form method="post" action="history.php"><button name="clear">Clear history</button></form>
    </body>

<?php
?>