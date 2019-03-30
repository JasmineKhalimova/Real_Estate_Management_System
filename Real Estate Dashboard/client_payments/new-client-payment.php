<?php

// creates the new record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($ClientID, $PaymentID, $ClientIDResult, $PaymentIDResult, $error)

{

?>

<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link href="../css/main.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic" rel="stylesheet">
<meta name="decription" content="This dashboard developed for real estate managment system"/>
<meta name="keywords" content=""/>
<meta name="author" content="Jasmine Khalimova"/>
<title>New Record</title>

</head>

<body>
<header class="masthead" role="banner">
    <section class="logo">
      <img class="logo-img logo-img-small" src="../img/logo-small.png" alt="Space Control">
      <img class="logo-img logo-img-big" src="../img/logo.png" alt="Space Control">
    </section>
    <h1 class="title">Add ClientPayment</h1>
    <nav class="nav-wrap" role="navigation">
      <button class="nav-btn" aria-controls="nav" aria-expanded="false"><i class="nav-icon">Toggle Navigation</i></button>
      <ul class="nav" id="nav" aria-hidden="true">
        <li>
          <span class="nav-label"><span class="nav-label-back">DASHBOARD</span></span>
          <ol>
            <li><a href="../index.php">Home Page</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">REALTOR</span></span>
          <ol>
            <li><a href="../realtor/view-realtor.php">Realtor List</a></li>
            <li><a href="../realtor/new-realtor.php">Add Realtor</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">CLIENT</span></span>
          <ol>
            <li><a href="../client/view-client.php">Client List</a></li>
            <li><a href="../client/new-client.php">Add Client</a></li>
            <li><a href="view-client-payments.php">Assign Payment</a></li>
            <li><a href="../client_properties/view-client-properties.php">Assign Property</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">PAYMENT</span></span>
          <ol>
            <li><a href="../payment/view-payment.php">Payment List</a></li>
            <li><a href="../payment/new-payment.php">Add Payment</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">PROPERTY</span></span>
          <ol>
            <li><a href="../property/view-property.php">Property List</a></li>
            <li><a href="../property/new-property.php">Add Property</a></li>
          </ol>
        </li>
      </ul>
    </nav>
  </header>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}  

?>

<form action="" method="post">

<section class="container">

<div id="form">

<label>Client ID *</label>
<select name="ClientID" class="ID-dropdown">
<?php
while($row = mysqli_fetch_array($ClientIDResult))

{
    $ClientID = $row['ID'];

    echo "<option value='$ClientID'>$ClientID</option>";

}
?>
</select>

<label>Property ID *</label>
<select name="PaymentID" class="ID-dropdown">
<?php
while($row = mysqli_fetch_array($PaymentIDResult))

{
    $PaymentID = $row['ID'];

    echo "<option value='$PaymentID'>$PaymentID</option>";

}
?>
</select>

<input type="submit" name="submit" value="Submit" class="btn"><a href="view-client-payments.php" class="btn">Cancel</a>

</div>

</section>
</form>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/main.js"></script>
</body>

</html>

<?php

}

// connect to the database
include('../connect-db.php');

$ClientIDResult = mysqli_query($conn, "SELECT ID FROM Client") or die(mysqli_error($conn));
$PaymentIDResult = mysqli_query($conn, "SELECT ID FROM Payment") or die(mysqli_error($conn)); 

// check if the form has been submitted. If it has, start to process the form and save it to the database

if (isset($_POST['submit']))

{

// get form data, making sure it is valid

$ClientID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['ClientID']));

$PaymentID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['PaymentID']));

// check to make sure both fields are entered

if ($ClientID == '' || $PaymentID == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';

// if either field is blank, display the form again

renderForm($ClientID, $PaymentID, $ClientIDResult, $PaymentIDResult, $error);

}

else

{

// save the data to the database

mysqli_query($conn, "INSERT Client_Payments SET ClientID='$ClientID', PaymentID='$PaymentID'")

or die(mysqli_error($conn));

// once saved, redirect back to the view page

header("Location: view-client-payments.php");

}

}

else

// if the form hasn't been submitted, display the form

{

    renderForm('','', $ClientIDResult, $PaymentIDResult, '');

}

?>