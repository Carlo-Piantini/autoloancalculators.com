<?php
// Credentials for database of zipcodes
$db_server = 'localhost';
$db_user='cpiantini';
$db_password='^2P]]?JPoq!1';
$db_name='autoloancalculators_zipcodes';
// Setup the connection to the database
$conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
if (!$conn) { echo 'Error : no connection to database server'; }
else {
    // Get the parameters for the user's IP address zipcode
    $sql = "SELECT * FROM `zipcodes_2011` WHERE `zipcode` = " . $result_zip;
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    if ($result_check > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $result_lat = $row['latitude']; // Grab the latitude
            $result_lng = $row['longitude']; // Grab the longitude
        }
    }
    if ($result_lat && $result_lng) {
        $radius = 20; // sets the radius to 20
        $query = sprintf("SELECT *,
            ( 6371 * acos( 
            cos(radians(%s)) * cos(radians(latitude)) * 
            cos(radians(longitude) - radians(%s)) + 
            sin(radians(%s)) * sin(radians(latitude)) 
            ) ) AS distance
            FROM `zipcodes_2011`
            HAVING distance < $radius              
            ORDER BY distance LIMIT 5 ",
        mysqli_real_escape_string($conn, $result_lat), 
        mysqli_real_escape_string($conn, $result_lng),  
        mysqli_real_escape_string($conn, $result_lat)); 
        $result = mysqli_query($conn, $query);
        $result_check = mysqli_num_rows($result);
        if ($result_check > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $query_zipcodes[$i] = $row['zipcode'];
                $i++;
            }
        }
    }
}
?>
