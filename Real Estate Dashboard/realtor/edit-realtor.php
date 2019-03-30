<?php

// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id, $Name, $Phone, $Address_Name, $Street, $City, $Province,$Country, $Postal_Code, $error)

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
    <h1 class="title">Edit Realtor</h1>
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
            <li><a href="view-realtor.php">Realtor List</a></li>
            <li><a href="new-realtor.php">Add Realtor</a></li>
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

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div id="form">

<label>Name: *</label> <input type="text" name="Name" required value="<?php echo $Name; ?>" /><br/>

<label>Phone *</label> <input type="text" name="Phone" required value="<?php echo $Phone; ?>" /><br/>

<label>Address Name </label> <input type="text" name="Address_Name" value="<?php echo $Address_Name; ?>" /><br/>

<label>Street *</label> <input type="text" name="Street" required value="<?php echo $Street; ?>" /><br/>

<label>City *</label> <input type="text" name="City" required value="<?php echo $City; ?>" /><br/>

<label>Province *</label> <input type="text" name="Province"  required value="<?php echo $Province; ?>" /><br/>

<label>Country *</label> <input type="text" name="Country"  required value="<?php echo $Country; ?>" /><br/>

<label>Postal Code *</label> <input type="text" name="Postal_Code" required value=" <?php echo $Postal_Code; ?>" /><br/>

<input type="submit" name="submit" value="Submit" class="btn"><a href="view-realtor.php" class="btn">Cancel</a>

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



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];

$Name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Name']));

$Phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Phone']));

$Address_Name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Address_Name']));

$Street = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Street']));

$City = mysqli_real_escape_string($conn, htmlspecialchars($_POST['City']));

$Province = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Province']));

$Country = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Country']));

$Postal_Code = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Postal_Code']));



// check that firstname/lastname fields are both filled in

if ($Name == '' || $Phone == '' || $Street == '' || $City == '' || $Province == '' || $Country == '' || $Postal_Code == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $Name, $Phone, $Address_Name, $Street, $City, $Province,$Country, $Postal_Code, $error);

}

else

{

// save the data to the database

mysqli_query($conn, "UPDATE Realtor r INNER JOIN Address a ON (r.AddressID = a.ID)
SET r.Name='$Name', r.Phone='$Phone', a.Name='$Address_Name', a.Street='$Street', a.City='$City', a.Province='$Province',
  a.Country='$Country', a.Postal_Code='$Postal_Code' WHERE r.ID = '$id'")

or die(mysqli_error($conn));



// once saved, redirect back to the view page

header("Location: view-realtor.php");

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

$query = "SELECT Realtor.Name as Name, Phone, Address.Name as aName, Street, City, Province, Country, Postal_Code  FROM  Realtor LEFT JOIN Address on Realtor.AddressID = Address.ID WHERE Realtor.ID='$id'";

$result = mysqli_query($conn, $query)

or die(mysqli_error($conn));

$row = mysqli_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{


// get data from db

$Name = mysqli_real_escape_string($conn, htmlspecialchars($row['Name']));

$Phone = mysqli_real_escape_string($conn, htmlspecialchars($row['Phone']));

$Address_Name = mysqli_real_escape_string($conn, htmlspecialchars($row['Address_Name']));

$Street = mysqli_real_escape_string($conn, htmlspecialchars($row['Street']));

$City = mysqli_real_escape_string($conn, htmlspecialchars($row['City']));

$Province = mysqli_real_escape_string($conn, htmlspecialchars($row['Province']));

$Country = mysqli_real_escape_string($conn, htmlspecialchars($row['Country']));

$Postal_Code = mysqli_real_escape_string($conn, htmlspecialchars($row['Postal_Code']));



// show form

renderForm($id, $Name, $Phone, $Address_Name, $Street, $City, $Province,$Country, $Postal_Code, '');

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