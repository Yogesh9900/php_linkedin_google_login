<?php


require_once "init_linkedin_login.php";

$accessToken = $linkedin->getAccessToken($_GET['code']);

$profileObject = $linkedin->getPerson();
$emailObject = $linkedin->getEmail();

$fname = $profileObject->firstName->localized->en_US;

$lname = $profileObject->lastName->localized->en_US;

$email = $emailObject->elements[0]->{"handle~"}->emailAddress;
?>

<html>

<body>

<h1>Name: <?php echo $fname; ?> </h1>
<h1>Surname: <?php echo $lname; ?> </h1>
<h1>Email: <?php echo $email; ?> </h1>


</body>
</html>

