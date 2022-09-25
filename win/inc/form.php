<?php

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];

$errors = [
    'firstNameError' => '', 'lastNameError' => '', 'emailError' => ''
];

if (isset($_POST['submit'])) {


    if (empty($firstName)) {
        $errors['firstNameError'] = 'Write your first name';
    }
    if (empty($lastName)) {
        $errors['lastNameError'] = 'Write your last name';
    }

    if (empty($email)) {
        $errors['emailError'] = 'Write your email';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['emailError'] = 'Please check your email';
    }

    if (!array_filter($errors)) {

        $firstName =  mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName =   mysqli_real_escape_string($conn, $_POST['lastName']);
        $email =      mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "INSERT INTO users(firstName, lastName, email)
         VALUES ('$firstName','$lastName','$email')";

        if (mysqli_query($conn, $sql)) {
           header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
            echo 'Error:' . mysqli_error($conn);
        }
    }
}
