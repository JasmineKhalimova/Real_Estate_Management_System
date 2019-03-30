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
<title>Property Records</title>

</head>

<body>
<header class="masthead" role="banner">
<section class="logo">
  <img class="logo-img logo-img-small" src="../img/logo-small.png" alt="Space Control">
  <img class="logo-img logo-img-big" src="../img/logo.png" alt="Space Control">
</section>
<h1 class="title">Property List</h1>
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
        <li><a href="../payment/view-payment.php">Payment List</a></li>
        <li><a href="../payment/new-payment.php">Add Payment</a></li>
      </ol>
    </li>
    <li>
      <span class="nav-label"><span class="nav-label-back">PROPERTY</span></span>
      <ol>
        <li><a href="view-property.php">Property List</a></li>
        <li><a href="new-property.php">Add Property</a></li>
      </ol>
    </li>
  </ul>
</nav>
</header>

<section class="table-container">

<?php



include('../connect-db.php');

$query = "SELECT Property.ID as ID, Property.Name as Name, Selling_Price, Status, type, Listing_date, Address.Name as aName, Street, City, Province, Country, Postal_Code  FROM  Property LEFT JOIN Address on Property.AddressID = Address.ID";

$result = mysqli_query($conn, $query)

or die(mysqli_error($conn));


echo "<table border='1' cellpadding='10'>";

echo "<tr><th>ID</th><th>Name</th><th>Selling_Price</th> <th>Status</th><th>Type</th><th>Listing_Date</th><th>Address Name</th> <th>Steet</th><th>City</th><th>Province</th><th>Country</th><th>Postal Code</th></tr>";



// loop through results of database query, displaying them in the table

while($row = mysqli_fetch_array( $result )) {



// echo out the contents of each row into a table

echo "<tr>";

echo '<td>' . $row['ID'] . '</td>';

echo '<td>' . $row['Name'] . '</td>';

echo '<td>' . $row['Selling_Price'] . '</td>';

echo '<td>' . $row['Status'] . '</td>';

echo '<td>' . $row['type'] . '</td>';

echo '<td>' . $row['Listing_date'] . '</td>';

echo '<td>' . $row['aName'] . '</td>';

echo '<td>' . $row['Street'] . '</td>';

echo '<td>' . $row['City'] . '</td>';

echo '<td>' . $row['Province'] . '</td>';

echo '<td>' . $row['Country'] . '</td>';

echo '<td>' . $row['Postal_Code'] . '</td>';

echo '<td><a href="edit-property.php?id=' . $row['ID'] . '">Edit</a></td>';

echo '<td><a href="delete-property.php?id=' . $row['ID'] . '">Delete</a></td>';

echo "</tr>";

}


// close table>

echo "</table>";

?>

<a href='new-property.php' id="add-button">Add a new record</a>
</section>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>