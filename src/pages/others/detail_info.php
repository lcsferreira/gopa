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

// Retrieve the country ID from the URL
$country_id = $_GET['country_id'];


// Fetch data from the specified tables for the given country
$sql_demographic = "SELECT * FROM demographic_values_admin WHERE id = $country_id";
$sql_pa_prevalence = "SELECT * FROM pa_prevalence_values_admin WHERE id = $country_id";
$sql_national_surveillance = "SELECT * FROM national_surveillance_values_admin WHERE id = $country_id";
$sql_national_policy = "SELECT * FROM national_policy_values_admin WHERE id = $country_id";
$sql_research = "SELECT * FROM research_values_admin WHERE id = $country_id";
$sql_pa_promotion = "SELECT * FROM pa_promotion_values_admin WHERE id = $country_id";
$sql_contact = "SELECT * FROM contact_values_admin WHERE id = $country_id";
$sql_national_policy_title = "SELECT * FROM national_policy_titles_reference_admin WHERE id_country = $country_id";
$sql_national_guideline_title = "SELECT * FROM national_guideline_titles_reference_admin WHERE id_country = $country_id";


$result_demographic = $conn->query($sql_demographic);
$result_pa_prevalence = $conn->query($sql_pa_prevalence);
$result_national_surveillance = $conn->query($sql_national_surveillance);
$result_national_policy = $conn->query($sql_national_policy);
$result_research = $conn->query($sql_research);
$result_pa_promotion = $conn->query($sql_pa_promotion);
$result_contact = $conn->query($sql_contact);
$result_national_policy_title = $conn->query($sql_national_policy_title);
$result_national_guideline_title = $conn->query($sql_national_guideline_title);

// Check if any data was found
$data_found = $result_demographic->num_rows > 0 ||
              $result_pa_prevalence->num_rows > 0 ||
              $result_national_surveillance->num_rows > 0 ||
              $result_national_policy->num_rows > 0 ||
              $result_research->num_rows > 0 ||
              $result_pa_promotion->num_rows > 0 ||
              $result_contact->num_rows > 0 ||
              $result_national_policy_title->num_rows > 0 ||
              $result_national_guideline_title->num_rows > 0;

ob_start();  // Start output buffering

// Output the HTML table for each section
function output_html_table($section_title, $column_names, $data) {
    if ($data->num_rows > 0) {
        echo "<h2>$section_title</h2>";
        echo "<table border='1'>";
        echo "<tr>";
        foreach ($column_names as $column_name) {
            echo "<th>$column_name</th>";
        }
        echo "</tr>";

        while ($row = $data->fetch_assoc()) {
            echo "<tr>";
            foreach ($column_names as $column_name) {
              $value = $row[$column_name];
              if ($value === '1') {
                  $value = 'yes';
              } elseif ($value === '0') {
                  $value = 'no';
              }
              echo "<td>" . nl2br(htmlspecialchars($value)) . "</td>";
            }
            echo "</tr>";
        }

        echo "</table><br>";
    }
}

// Output demographic data
output_html_table("Demographic", ['country', 'capital', 'total_population', 'urban_population', 'life_expentacy', 'gini_index', 'human_index', 'literacy_rate', 'deaths_diseases', 'risk_of_premature', 'human_capital', 'democracy', 'tax_burden'], $result_demographic);

// Output PA prevalence data
output_html_table("PA Prevalence", ['both_sexes', 'males', 'females', 'reference'], $result_pa_prevalence);

// Output National Surveillance data
output_html_table("National Surveillance", ['national_surveys', 'most_recent_year', 'next_year', 'survey_instrument', 'survey_tool', 'objective_measures', 'devices_used', 'devices_used_reference', 'estimates', 'quantifiable_targets'], $result_national_surveillance);

// Output National Policy data
output_html_table("National Policy", ['national_policy', 'embbed_prevention', 'standalone_prevention', 'national_recommendations'], $result_national_policy);

// Output Research data
output_html_table("Research", ['contribution', 'pa_quintiles'], $result_research);

// Output PA Promotion data
output_html_table("PA Promotion", ['research', 'policy', 'policy_type', 'surveillance'], $result_pa_promotion);

// Output Contact data
output_html_table("Contact", ['name_1', 'email_1', 'institution_1', 'name_2', 'email_2', 'institution_2', 'name_3', 'email_3', 'institution_3', 'additional_contact'], $result_contact);

// Output National Policy Titles and References
output_html_table("National Policy Titles and References", ['title', 'reference'], $result_national_policy_title);

// Output National Guideline Titles and References
output_html_table("National Guideline Titles and References", ['title', 'reference'], $result_national_guideline_title);

$content = ob_get_clean();  // Get the buffered content

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Country Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto; /* Allow horizontal scrolling when needed */
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            min-width: 100px; /* Ensure a minimum width for columns */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    if ($data_found) {
        echo $content;
    } else {
        echo "No data found for the specified country.";
    }
    ?>
</body>
</html>
