<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vusic";
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<?php
if (isset($_GET["id"])) {
    $idaudio = $_GET["id"];
class history
{
    protected $stack;
    protected $limit;
    
    public function __construct($limit = 24) {
        // initialization of stack
        $this->stack = array();
        // tells the limit of the stack
        $this->limit = $limit;
    }

    public function push($item) {
        // stack overflow
        if (count($this->stack) < $this->limit) {
            // to add the song to the starting of the array
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
if(isset($_SESSION['stack']))
{
$obj=unserialize($_SESSION['stack']);
$obj->push($idaudio);
$_SESSION['stack'] = serialize($obj);
}
else
{
$object = new history();
$object->push($idaudio);//inputs the songs into the history
$_SESSION['stack'] = serialize($object);
}
    $b = "select * from songs where id='$idaudio'";

    $result = $conn->query($b);

    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = mysqli_fetch_assoc($result)) {

?>
            <html>

            <head>
                <script>
                    var music = document.getElementById("player");

                    function pauseMusic() {
                        player.pause();
                    }

                    function playMusic() {
                        player.play();
                    }
                </script>
            </head>

            <body>
                <link rel="stylesheet" href="assets/css/audiocss.css">
                <h2>VUSIC</h2>
                <div class="container-audio">
                    <audio id="player" controls loop autoplay>
                        <source src="<?php echo $row["path"]; ?>" type="audio/mpeg">
                    </audio>
                    <?php
                    $i = $row['id'] ?>
                    <img class="hovering" src="assets\images\icons\previous.png" onclick="location.href='play.php?id=<?php echo $i - 1 ?>'">
                    <img class="hovering" src="assets\images\icons\pause.png" onclick="pauseMusic()">
                    <img class="hovering" src="assets\images\icons\play.png" onclick="playMusic()">
                    <img class="hovering" src="assets\images\icons\repeat.png" onclick="location.href='play.php?id=<?php echo $row['id'] ?>'">
                    <img class="hovering" src="assets\images\icons\next.png" onclick="location.href='play.php?id=<?php echo $i + 1 ?>'">
                </div>
                <style>
                    .hovering:hover {
                        transform: scale(1.2);
                    }
                </style>
                <div class="container-audio">
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                    <div class="colum1">
                        <div class="row"></div>
                    </div>
                </div>
            </body>

            </html>
<?php
        }
    }
}
?>

<link rel="stylesheet" href="assets/css/button.css">
<a href="index.php" class="myButton">Home</a>
<a href="search.php" class="myButton">Search</a>
<a href="albums.php" class="myButton">Albums</a>