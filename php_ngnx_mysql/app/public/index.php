<?php
$success    =   false;
$error      = '';
$dbQuery    = null;

// try and authenticate with Mysql
try {
    $dbConnect  = new PDO('mysql:dbname=test_database;host=mysql', 'test', 'testing');
    $dbQuery    = $dbConnect->query('SHOW VARIABLES like "version"');
} catch (Exception $e) {
    $error = $e->getMessage();
}

// if authentication was good, try a query
if (false === empty($dbQuery)) {
    try {
        $dbQuery->fetch();
        $success = true;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <div style="max-width: 50%; margin-left: 25%; margin-top:10%">
        <?php echo (true === $success) ? '<h1>All working! Sweet!</h1>' : '<h1>Hmmm something is amiss...</h1>';?>
        <?php
        if (false === empty($error)) :
            echo "<p>Error: {$error}</p>";
         endif;
         ?>
        <table>
            <tr>
                <td>
                    PHP
                </td>
                <td>
                    Working! Version: <?php echo phpversion();?>
                </td>
            </tr>
            <tr>
                <td>Mysql</td>
                <td>
                    <?php echo (true === $success) ? 'Working!' : 'Boo! Not working!';?>
                </td>
            </tr>
        </table>
    </div>
</body>
