<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country =  trim($_GET['country'] ?? '');
$lookup = trim($_GET['lookup'] ?? '');
$country_param = '%' . $country . '%';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$sqlStmt = '';

if ($lookup === "cities"){
  $sqlStmt = "SELECT ci.name, ci.district, ci.population FROM countries c JOIN cities ci ON c.code = ci.country_code WHERE c.name LIKE :country";
} else {
  $sqlStmt = "SELECT * FROM countries WHERE name LIKE :country";
}

$stmt = $conn->prepare($sqlStmt);

$stmt->bindValue(':country', $country_param);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($lookup === "cities"): ?>
  <table>
  <thead>
    <tr>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $cityDetails): ?>
      <tr>
        <td><?= $cityDetails['name']; ?></td>
        <td><?= $cityDetails['district']; ?></td>
        <td><?= $cityDetails['population']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Continent</th>
      <th>Independence</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $countryDetails): ?>
      <tr>
        <td><?= $countryDetails['name']; ?></td>
        <td><?= $countryDetails['continent']; ?></td>
        <td><?= $countryDetails['independence_year']; ?></td>
        <td><?= $countryDetails['head_of_state']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif; ?>

