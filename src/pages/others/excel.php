<?php
$servername = "mysql.pauloferreirajr.com";
$username = "gopa";
$password = "gopapedrinho22";
$dbname = "workgopa";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all countries from the "countries" table
$sql = "SELECT * FROM countries";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Country List with Info View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .view-info-btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .view-info-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>List of Countries</h1>

<table border="1">
    <tr>
        <th>Country</th>
        <th>View Info</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td><a class='view-info-btn' href='detail_info.php?country_id=" . $row["id"] . "'>View Info</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No countries found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
