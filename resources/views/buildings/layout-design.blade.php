<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Layout Design</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 0 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Building Layout Design</h1>
        <p>Company: {{ $companyName }}</p>
    </div>
    <div class="content">
        <h2>Building Information</h2>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $building->name }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $building->address }}</td>
            </tr>
            <tr>
                <th>Floors</th>
                <td>{{ $building->floors }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
