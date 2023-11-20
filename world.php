<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: *');

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


if (isset($_GET['country'])) {

  $countryInput = '%' . filter_var($_GET['country'], FILTER_SANITIZE_STRING) . '%';
  $lookupType = 'countries';
  
  if (isset($_GET['lookup'])){
    if ($_GET['lookup'] === 'cities'){
      $lookupType = 'cities';
    }
  }

  if ($lookupType === 'countries'){
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");

    $stmt->bindParam(':country', $countryInput, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($results)) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr>';
        foreach ($results as $row) {
            echo '<tr><td>' . $row['name'] . '</td><td>' . $row['continent'] . '</td><td>' . $row['independence_year'] . '</td><td>' . $row['head_of_state'] . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo 'No results found for the specified country.';
    }
  }

  elseif ($lookupType === 'cities') {
    $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");

    $stmt->bindParam(':country', $countryInput, PDO::PARAM_STR);
    $stmt->execute();
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
      echo '<table>';
      echo '<tr><th>Name</th><th>District</th><th>Population</th></tr>';
      foreach ($results as $row) {
          echo '<tr><td>' . $row['name'] . '</td><td>' . $row['district'] . '</td><td>' . $row['population'] . '</td></tr>';
      }
      echo '</table>';
  } else {
      echo 'No results found for the specified country.';
    }

  }

} 


  /* $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->bindParam(':country', $countryInput, PDO::PARAM_STR);
  $stmt->execute();
  
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if (!empty($results)) {
      echo '<table>';
      echo '<tr><th>Name</th><th>Continent</th><th>Independence</th><th>Head of State</th></tr>';
      foreach ($results as $row) {
          echo '<tr><td>' . $row['name'] . '</td><td>' . $row['continent'] . '</td><td>' . $row['independence_year'] . '</td><td>' . $row['head_of_state'] . '</td></tr>';
      }
      echo '</table>';
  } else {
      echo 'No results found for the specified country.';
  } */
