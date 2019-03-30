<?php

// connect to the database
include('connect-db.php');

$bp_query = "SELECT AVG(Selling_Price) AS 'avg' FROM Property;";
$bp_result = mysqli_query($conn, $bp_query) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($bp_result); 
$benchmark_price = round($row['avg']);

$th_query = "SELECT Selling_Price, Status, type, City  
            FROM  Property LEFT JOIN Address on Property.AddressID = Address.ID 
            WHERE type = 'Townhouse'
            LIMIT 1";
$th_result = mysqli_query($conn, $th_query)
or die(mysqli_error($conn));
$th_row = mysqli_fetch_assoc($th_result); 

$c_query = "SELECT Selling_Price, Status, type, City  
            FROM  Property LEFT JOIN Address on Property.AddressID = Address.ID 
            WHERE type = 'Condo'
            LIMIT 1";
$c_result = mysqli_query($conn, $c_query)
or die(mysqli_error($conn));
$c_row = mysqli_fetch_assoc($c_result); 

$sd_query = "SELECT Selling_Price, Status, type, City  
            FROM  Property LEFT JOIN Address on Property.AddressID = Address.ID 
            WHERE type = 'Semi-Detached'
            LIMIT 1";
$sd_result = mysqli_query($conn, $sd_query)
or die(mysqli_error($conn));
$sd_row = mysqli_fetch_assoc($sd_result); 

?>

<!DOCTYPE html>
<html lang="en-ca">
<head>
  <meta charset="utf-8">
  <title>Real Estate Management System</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="css/main.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic" rel="stylesheet">
  <meta name="decription" content="This dashboard developed for real estate managment system"/>
  <meta name="keywords" content=""/>
  <meta name="author" content="Jasmine Khalimova"/>
</head>
<body>

  <header class="masthead" role="banner">
    <section class="logo">
      <img class="logo-img logo-img-small" src="img/logo-small.png" alt="Space Control">
      <img class="logo-img logo-img-big" src="img/logo.png" alt="Space Control">
    </section>
    <h1 class="title">DASHBOARD</h1>
    <nav class="nav-wrap" role="navigation">
      <button class="nav-btn" aria-controls="nav" aria-expanded="false"><i class="nav-icon">Toggle Navigation</i></button>
      <ul class="nav" id="nav" aria-hidden="true">
        <li>
          <span class="nav-label"><span class="nav-label-back">DASHBOARD</span></span>
          <ol>
            <li><a href="index.php">Home Page</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">REALTOR</span></span>
          <ol>
            <li><a href="realtor/view-realtor.php">Realtor List</a></li>
            <li><a href="realtor/new-realtor.php">Add Realtor</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">CLIENT</span></span>
          <ol>
            <li><a href="client/view-client.php">Client List</a></li>
            <li><a href="client/new-client.php">Add Client</a></li>
            <li><a href="client_payments/view-client-payments.php">Assign Payment</a></li>
            <li><a href="client_properties/view-client-properties.php">Assign Property</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">PAYMENT</span></span>
          <ol>
            <li><a href="payment/view-payment.php">Payment List</a></li>
            <li><a href="payment/new-payment.php">Add Payment</a></li>
          </ol>
        </li>
        <li>
          <span class="nav-label"><span class="nav-label-back">PROPERTY</span></span>
          <ol>
            <li><a href="property/view-property.php">Property List</a></li>
            <li><a href="property/new-property.php">Add Property</a></li>
          </ol>
        </li>
      </ul>
    </nav>
  </header>

  <main role="main">

    <article class="panel farthest">
      <h2 class="panel-head section-label" tabindex="0"><span class="section-label-back">BENCHMARK PRICE</span></h2>
      <div class="farthest-wrap">
        <p class="benchmark-price">$<?php echo $benchmark_price; ?></p>
        <p class="farthest-probe">Average all property types</p>
      </div>
    </article>

    <article class="panel distances">
      <h2 class="panel-head section-label" tabindex="0"><span class="section-label-back">Average Market Price</span></h2>
      <div>
        <svg class="bar-chart" viewBox="0 0 1000 821.8">
          <style>
            .st0{fill:#5ED3EE;} .st1{fill:#E2626E;} .st2{fill:#FA9843;} .st3{fill:#FB3F4B;} .st4{fill:#fff;font-family:Ubuntu} .st5{font-size:52.7692px;} .st6{font-size:37.6923px;} .st7{font-size:40.2051px;} .st8{fill:none;stroke:#555555;stroke-width:5;}
          </style>
          <g class="bar-wrap">
            <path id="bar-voy-1" d="M765.6 422.2h199v30.6h-199z" class="bar st0"/>
          </g>
          <g class="bar-wrap">
            <path id="bar-voy-2" d="M546.7 347.8h199v105h-199z" class="bar st1"/>
          </g>
          <g class="bar-wrap">
            <path id="bar-nh" d="M327.7 94h199v358.7h-199z" class="bar st2"/>
          </g>
          <g class="bar-wrap">
            <path id="bar-cas" d="M108.8 22.5h199v430.2h-199z" class="bar st3"/>
          </g>
          <text transform="matrix(0 -1 1 0 204.475 739.456)">
            <tspan x="0" y="0" class="st4 st5">Townhouse</tspan>
          </text>
          <text transform="matrix(0 -1 1 0 427.26 739.456)">
            <tspan x="0" y="0" class="st4 st5">Detached</tspan>
          </text>
          <text transform="matrix(0 -1 1 0 646.202 800.298)">
            <tspan x="0" y="0" class="st4 st5">Semi - Detach</tspan>
          </text>
          <text transform="matrix(0 -1 1 0 865.145 631.651)">
            <tspan x="0" y="0" class="st4 st5">Condo</tspan>
          </text>
          <text transform="translate(32.675 467.33)" class="st4 st7" aria-hidden="true">0</text>
          <text transform="translate(10 248.72)" class="st4 st7" aria-hidden="true">10</text>
          <path d="M83.5 452.8H990" class="st8"/>
          <path d="M83.5 452.8V22.5" class="st8"/>
          <path d="M83.5 452.8H65" class="st8"/>
          <path d="M83.5 234.2H65" class="st8"/>
        </svg>
      </div>
    </article>

    <article class="panel">
      <h2 class="panel-head section-label" tabindex="0"><span class="section-label-back">EXCLUSIVE SERVICES</span></h2>
      <div class="table-wrap">
        <table>
          <caption>Benefit from the full potential of our online services, free of charge, and with no obligation.<br> Let us know if there's anything else we can assist you with. We'd love to hear from you</caption>
          <thead>
            <tr>
              <th scope="col">News</th>
              <th scope="col">Last Update</th>
              <th scope="col">Title</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Market Report</th>
              <td><time datetime="2011-08-05">Aug. 5, 2011</time></td>
              <td>Full Map Searc</td>
            </tr>
            <tr>
              <th scope="row">Market Report</th>
              <td><time datetime="2004-03-02">Mar. 2, 2004</time></td>
              <td>Free Home Evaluation</td>
            </tr>
            <tr>
              <th scope="row">Market Report</th>
              <td><time datetime="2010-05-20">May 20, 2010</time></td>
              <td>Latest Listings Alert</td>
            </tr>
            <tr>
              <th scope="row">Market Report</th>
              <td><time datetime="2014-12-03">Dec. 3, 2014</time></td>
              <td>Market Update</td>
            </tr>
            <tr>
              <th scope="row">Market Report</th>
              <td><time datetime="2013-12-19">Dec. 19, 2013</time></td>
              <td>Full MLS Report</td>
            </tr>
          </tbody>
        </table>
      </div>
    </article>

    <article class="panel">
      <h2 class="panel-head section-label" tabindex="0"><span class="section-label-back">FEATURED PROPERTIES</span></h2>

      <div class="tab-group">
        <ul class="tabs clearfix" role="tablist">
          <li class="tab" role="presentation"><a href="#townhouse" role="tab" aria-controls="townhouse" aria-selected="true">Townhouse</a></li>
          <li class="tab" role="presentation"><a href="#Condo" role="tab" aria-controls="Condo">Condo</a></li>
          <li class="tab" role="presentation"><a href="#Semi-Detached" role="tab" aria-controls="Semi-Detached">Semi-Detached</a></li>
        </ul>

        <div class="tab-panels">
          <div class="tab-panel" id="townhouse" role="tabpanel" aria-hidden="false">
            <img class="flex-img details-img" src="img/detached.jpg" alt="Townhouse">
            <dl class="details">
              <dt>Type</dt>
              <dd><?php echo $th_row['type'] ?></dd>
              <dt>Status</dt>
              <dd><?php echo $th_row['Status'] ?></dd>
              <dt>Selling Price</dt>
              <dd>$<?php echo $th_row['Selling_Price'] ?></dd>
              <dt>City</dt>
              <dd><?php echo $th_row['City'] ?></dd>
            </dl>
          </div>
          <div class="tab-panel" id="Condo" role="tabpanel" aria-hidden="true">
            <img class="flex-img details-img" src="img/apartment.jpg" alt="Apartment">
            <dl class="details">
              <dt>Type</dt>
              <dd><?php echo $c_row['type'] ?></dd>
              <dt>Status</dt>
              <dd><?php echo $c_row['Status'] ?></dd>
              <dt>Selling Price</dt>
              <dd>$<?php echo $c_row['Selling_Price'] ?></dd>
              <dt>City</dt>
              <dd><?php echo $c_row['City'] ?></dd>
            </dl>
          </div>
          <div class="tab-panel" id="Semi-Detached" role="tabpanel" aria-hidden="true">
            <img class="flex-img details-img" src="img/semi.jpg" alt="Semi-Detached">
            <dl class="details">
              <dt>Type</dt>
              <dd><?php echo $sd_row['type'] ?></dd>
              <dt>Status</dt>
              <dd><?php echo $sd_row['Status'] ?></dd>
              <dt>Selling Price</dt>
              <dd>$<?php echo $sd_row['Selling_Price'] ?></dd>
              <dt>City</dt>
              <dd><?php echo $sd_row['City'] ?></dd>
            </dl>
          </div>
        </div>
      </div>

    </article>
  </main>

  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
