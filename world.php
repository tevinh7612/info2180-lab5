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

  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $countryParam = '%' . $_GET['country'] . '%';
  $stmt->bindParam(':country', $countryParam, PDO::PARAM_STR);
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
