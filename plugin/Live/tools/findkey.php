<?php

require_once dirname(__FILE__) . '/../../../videos/configuration.php';

if (!isCommandLineInterface()) {
    forbiddenPage('Command line only');
}

ob_end_flush();

// Prompt the user for the key
echo "Please enter the key: ";
$key = trim(fgets(STDIN));

// Prepare the SQL queries for both tables
$sql1 = "SELECT lt.users_id, u.username, u.channel_name, 'live_transmitions' as source
FROM 
    `live_transmitions` lt
JOIN 
    `users` u ON lt.`users_id` = u.`id`
WHERE 
    lt.`key` = ?";

$sql2 = "SELECT lth.users_id, u.username, u.channel_name, 'live_transmitions_history' as source
FROM 
    `live_transmitions_history` lth
JOIN 
    `users` u ON lth.`users_id` = u.`id`
WHERE 
    lth.`key` = ?";

// Execute the first query
$res1 = sqlDAL::readSql($sql1, 's', [$key]);
$fullData1 = sqlDAL::fetchAllAssoc($res1);
sqlDAL::close($res1);

// Execute the second query
$res2 = sqlDAL::readSql($sql2, 's', [$key]);
$fullData2 = sqlDAL::fetchAllAssoc($res2);
sqlDAL::close($res2);

// Merge the results
$fullData = array_merge($fullData1, $fullData2);

$rows = [];
if (!empty($fullData)) {
    foreach ($fullData as $row) {
        // Print the result nicely
        echo "User ID: " . $row['users_id'] . "\n";
        echo "Username: " . $row['username'] . "\n";
        echo "Channel Name: " . $row['channel_name'] . "\n";
        echo "Source: " . $row['source'] . "\n";
        echo "--------------------------\n";
        $rows[] = $row;
    }
} else {
    echo "No results found for the key: " . $key . "\n";
}

return $rows;
