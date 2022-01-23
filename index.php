
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';



if(isset($_POST['arrival'], $_POST['departure'], $_POST['adults'], $_POST['children'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $_POST['room_type'])){
    $arrival = sanitizeStr($_POST['arrival']);
    $departure = sanitizeStr($_POST['departure']);
    $adults = sanitizeStr($_POST['adults']);
    $children = sanitizeStr($_POST['children']);
    $first_name = sanitizeStr($_POST['first_name']);
    $last_name = sanitizeStr($_POST['last_name']);
    $email = sanitizeStr($_POST['email']);
    $phone = sanitizeStr($_POST['phone']);
    $room_type = sanitizeStr($_POST['room_type']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email is not valid.";
    }

    if(!preg_match('/^[a-zA-Z]+$/', $first_name)){
        $errors[] = "First Name is not valid.";
    }

    if(!preg_match('/^[a-zA-Z]+$/', $last_name)){
        $errors[] = "Last Name is not valid.";
    }

    if(empty($errors)){
        sendMail('HotelReception@email.com', 'A new reservation');
    }

}

function sanitizeStr($str){
    $str = trim($str);
    if(get_magic_quotes_gpc()){
        $str = stripslashes($str);
    }
    $str = strip_tags($str);
    $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
    return $str;
}


function sendMail($ReceptionEmail, $emailSubject){
    global $errors, $arrival, $departure, $adults, $children, $first_name, $last_name, $email, $phone, $room_type;

    $mail = new PHPMailer(TRUE);

    try {
        $mail->CharSet  = 'UTF-8';

        $mail->setFrom('Your@email.com', 'Your Name');
        $mail->addAddress($ReceptionEmail, 'Your Name');
        $mail->Subject = $emailSubject;
        $mail->isHTML(true);

        ob_start();
        include('email-template.php');
        $mail->Body = ob_get_contents();
        ob_end_clean();

        $mail->AltBody = "A new reservation. Arrival: $arrival, Departure: $departure, adults: $adults, children: $children, first_name: $first_name, last_name: $last_name, Email: $email, Phone: $phone, Room type: $room_type";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'Your@email.com';
        $mail->Password = 'Your Password';
        $mail->Port = 587;

        /* Enable SMTP debug output. */
        $mail->SMTPDebug = 4; //0

        $mail->send();
    }
    catch (Exception $e)
    {
        $errors[] = 'Error sending email.';
        echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
        echo $e->getMessage();
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--    Font awesome   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">

    <title>Hotel Reservation</title>
</head>
<body>

<div id="errors">
    <?php
    if(!empty($errors)){
        echo implode('<br>', $errors);
    }
    ?>
</div>

<form action="" method="post" class="room-reservation-form">
    <h1><i class="fa fa-calendar-alt" aria-hidden="true"></i> room Reservation Form</h1>
    <div class="fields">
        <div class="wrapper-double">
            <div class="date-div">
                <label for="arrival">Arrival</label>
                <input type="date" id="arrival" name="arrival" required>
            </div>

            <div class="date-div">
                <label for="departure">Departure</label>
                <input type="date" id="departure" name="departure" required>
            </div>
        </div>

        <div class="wrapper-double">
            <div class="demographics-select">
                <label for="adults">Adults</label>
                <select name="adults" id="adults" required>
                    <option value="" selected>Select: </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <div class="demographics-select">
                <label for="children">Children</label>
                <select name="children" id="children" required>
                    <option value="">Select: </option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>

        <div class="wrapper-double">
            <div>
                <label for="first_name">First Name</label>
                <div class="field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                </div>
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <div class="field">
                    <i class="fas fa-user"></i>
                    <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                </div>
            </div>
        </div>

        <div class="wrapper-single">
            <label for="email">Email</label>
            <div class="field">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
        </div>

        <div class="wrapper-single">
            <label for="phone">Phone</label>
            <div class="field">
                <i class="fas fa-phone"></i>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
            </div>
        </div>

        <div class="wrapper-single">
            <label for="room_type">Room Type</label>
            <select name="room_type" id="room_type" required>
                <option value="" selected disabled>Select: </option>
                <option value="Standard">Standard</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
            </select>
        </div>

    </div>
    <input type="submit" value="Reserve">
</form>

</body>
</html>
