<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

// Function to make API request
function fetchWinGoData() {
    $apiUrl = 'https://draw.ar-lottery01.com/WinGo/WinGo_1M/GetHistoryIssuePage.json';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return json_encode(['error' => 'CURL Error: ' . $error]);
    }
    
    curl_close($ch);
    
    if ($httpCode !== 200) {
        return json_encode(['error' => 'HTTP Error: ' . $httpCode]);
    }
    
    return $response;
}

// Get data from API
$data = fetchWinGoData();
echo $data;
?>
