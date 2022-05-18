<?php
  $username = $_POST['username'];
  $password = $_POST['password'];
  $error="";
  //db connection
    $con =new mysqli("localhost","root","","logindata");
    if($con->connect_error){
        die("Failed to connect : ".$con->connect_error);
    }else{
        $stmt = $con->prepare("select * from log where username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows >0){
            $data = $stmt_result->fetch_assoc();
            if($data['password']===$password){
               header("Location: sidebar.html");
            }
            else{
                echo '<script>
                alert("Invalidusername/password");
        
                window.open("http://localhost/login/index.html","_self");
                </script>';
            }
        }else{
            echo '<script>alert("Invalid");</script>';
        }
    }
?>