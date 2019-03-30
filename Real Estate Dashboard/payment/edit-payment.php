<?php

// creates the edit record form

function renderForm($id, $Payment_Amount, $Payment_Date, $PropertyID,$PropertyIDResult, $error)

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
<title>Edit Record</title>

</head>

<body>

<header class="masthead" role="banner">
    <section class="logo">
      <img class="logo-img logo-img-small" src="../img/logo-small.png" alt="Space Control">
      <img class="logo-img logo-img-big" src="../img/logo.png" alt="Space Control">
    </section>
    <h1 class="title">Edit Payment</h1>
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
            <li><a href="../client_payments/view-client-payments.php">Assign Payment</a></li>
            <li><a href="../client_properties/view-client-properties.php">Assign Property</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">PAYMENT</span></span>
          <ol>
            <li><a href="view-payment.php">Payment List</a></li>
            <li><a href="new-payment.php">Add Payment</a></li>
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

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div id="form">

<label>Payment Amount: *</label> <input type="text" name="Payment_Amount" required value="<?php echo $Payment_Amount; ?>" /><br/>

<label>Payment Date *</label> <input type="date" name="Payment_Date" required class="form-date"value="<?php echo $Payment_Date; ?>" /><br/>
<label>Property ID *</label>
<select name="PropertyID" class="ID-dropdown">

<?php

while($row = mysqli_fetch_array($PropertyIDResult))

{
    $PropertyID = $row['ID'];

echo "<option value='$PropertyID'>$PropertyID</option>";

}

?>
</select>

<input type="submit" name="submit" value="Submit" class="btn"><a href="view-payment.php" class="btn">Cancel</a>

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

$query = "SELECT ID FROM Property";

$PropertyIDResult = mysqli_query($conn, $query); 

// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];

$Payment_Amount = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Payment_Amount']));

$Payment_Date = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Payment_Date']));

$PropertyID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['PropertyID']));


// check to make sure both fields are entered

if ($Payment_Amount == '' || $Payment_Date == '' || $PropertyID == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($Payment_Amount, $Payment_Date, $PropertyID, $PropertyIDResult, $error);

}

else

{

// save the data to the database

mysqli_query($conn, "UPDATE Payment SET Payment_Amount='$Payment_Amount', Payment_Date='$Payment_Date', PropertyID='$PropertyID' WHERE ID = '$id'")

or die(mysqli_error($conn));



// once saved, redirect back to the view page

header("Location: view-payment.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{

// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$query = "SELECT Payment_Amount, Payment_Date, PropertyID FROM Payment WHERE ID='$id'";

$result = mysqli_query($conn, $query)

or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);

// check that the 'id' matches up with a row in the databse

if($row)

{


// get data from db

$Payment_Amount = mysqli_real_escape_string($conn, htmlspecialchars($row['Payment_Amount']));

$Payment_Date = mysqli_real_escape_string($conn, htmlspecialchars($row['Payment_Date']));

$PropertyID = mysqli_real_escape_string($conn, htmlspecialchars($row['PropertyID']));


// show form

renderForm($id, $Payment_Amount, $Payment_Date, $PropertyID, $PropertyIDResult, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>