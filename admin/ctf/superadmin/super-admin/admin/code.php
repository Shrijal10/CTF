<?php
session_start();
include('config/dbcon.php');

if(isset($_POST['addUser']))
{   
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_query = "INSERT INTO `users`(`name`, `phone`, `email`, `password`) VALUES ('$name', '$phone', '$email', '$password')";
    $user_query_run = mysqli_query($con, $user_query);

    if($user_query_run)
    {
        $_SESSION['status'] = "User Added Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Not Added";
        header('Location: registered.php');
    }
}

if(isset($_POST['updateUser']))
{   
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE `users` SET `name` = '$name', `phone` = '$phone', `email` = '$email', `password` = '$password' WHERE `users`.`id` = $user_id";
    $query_run = mysqli_query($con, $query);

    if($user_query_run)
    {
        $_SESSION['status'] = "User Updated Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Updating Failed";
        header('Location: registered.php');
    }
}

if(isset($_POST['DeleteUserbtn']))
{
    $user_id = $_POST['delete_id'];

    $query = "DELETE FROM users WHERE `users`.`id` = $user_id ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "User Deleted Successfully";
        header('Location: registered.php');
    }
    else
    {
        $_SESSION['status'] = "User Deleting Failed";
        header('Location: registered.php');
    }
}

?>
