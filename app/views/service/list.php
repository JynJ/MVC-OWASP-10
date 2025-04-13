<!-- /app/views/service/list.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Services</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/menu.css">
</head>
<body>
    <?php include __DIR__ . '/../common/header.php'; ?>
    <h2>Liste des Services</h2>
    <table border="1">
        <tr>
            <th>Num_Service</th>
            <th>Type_section</th>
        </tr>
        <?php foreach ($services as $s): ?>
            <tr>
                <td><?php echo $s['Num_Service']; ?></td>
                <td><?php echo $s['Type_section']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
