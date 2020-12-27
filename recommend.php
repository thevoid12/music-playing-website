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
    <style>
        body {
            background-image: url("https://media.istockphoto.com/photos/snowflake-material-in-the-black-background-picture-id913260670?k=6&m=913260670&s=612x612&w=0&h=rcTpZRvWTgMxW2uc-EWLrfAp3TZFQmFl2ckdNuxdHTY=");
        }
    </style>
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
        <a class="recom" href="recommend.php">Recommendation</a>
    </div>
    <br><br><br>



    <!------------------------------------------------------------------------------------------>
    <?php
    $count = 0;
    $a = "select * from songs ";
    $result = $con->query($a);
    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {
            if ($count < 5) {

    ?>

                <span role='link' tabindex='0' onclick="location.href='recommend.php?id=<?php echo $row['id'] ?>'">
                    <img src="<?php echo $row["album_cover"]; ?>" style="height:150px;width:150px;">


                </span>
    <?php
                $count = $count + 1;
            }
        }
    } ?>


    </script>

</body>
<!----------------------------------------------------------------------------->
<?php
if (isset($_GET["id"])) {
    //node structure
    class Node
    {
        public $data;
        public $next;
    }

    class LinkedList
    {
        public $head;

        //constructor to create an empty LinkedList
        public function __construct()
        {
            $this->head = null;
        }

        //display the content of the list
        public function PrintList()
        {
            $temp = new Node();
            $temp = $this->head;
            if ($temp != null) {
                echo "\nThe list contains: ";
                while (true) {
                    echo $temp->data . " ";
                    $temp = $temp->next;
                    if ($temp == $this->head)
                        break;
                }
            } else {
                echo "\nThe list is empty.";
            }
        }
        public function display()
        {
            $temp1 = new Node();
            $temp1 = $this->head;
            if ($temp1 != null) {

                while (true) {
                    $con = mysqli_connect("localhost", "root", "") or die("unable to connect");
                    mysqli_select_db($con, "vusic");

                    $a = "select * from songs where id='$temp1->data'";
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

                    $temp1 = $temp1->next;
                    if ($temp1 == $this->head)
                        break;
                }
            }
        }
    };

    $clicked = $_GET["id"];

    // test the code  
    //create an empty LinkedList
    $MyList = new LinkedList();

    //Add first node.
    $first = new Node();
    $first->data = rand(1, 24);
    while ($clicked == $first->data) {
        $first->data = rand(1, 24);
    }
    //linking with head node
    $MyList->head = $first;
    //linking next of the node with head
    $first->next = $MyList->head;

    //Add second node.
    $second = new Node();
    $second->data = rand(1, 24);
    while ($second->data == $first->data) {
        $second->data = rand(1, 24);
    }
    //linking with first node
    $first->next = $second;
    //linking next of the node with head
    $second->next = $MyList->head;
    //Add third node.
    $third = new Node();
    $third->data = rand(1, 24);
    while ($second->data == $third->data || $third->data == $first->data || $second->data == $clicked) {
        $third->data = rand(1, 24);
    }
    //linking with second node
    $second->next = $third;
    //linking next of the node with head
    $third->next = $MyList->head;

    //print the content of list
    $MyList->PrintList();

    echo "<br><br><br><br><br><br>";
    ?>
    <h1 style="color:white">RECOMMENDATION</h1>
<?php
    $MyList->display();
}
?>
