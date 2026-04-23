
   <?php
   include"connection.php";
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $location = $_POST['password'];
        $sql = "INSERT INTO student (fname, username, phone, password)
            VALUES ('$fname', '$username', '$age', '$location')";
            $a=mysqli_query($conn, $sql);
            if($a){
                header("location:home.php");
            }
            else{
                echo 'not';
            }
    ?>