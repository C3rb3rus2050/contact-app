<?php
include 'db.php';

// Search
$search = $_GET['search'] ?? '';
$users = [];

if ($search) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE name LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM users");
    $users = $result->fetch_all(MYSQLI_ASSOC);
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
</head>
<body>
    <h1>User Form</h1>

    <!-- Form -->
    <form action="process-form.php" method="post">
        <input type="hidden" name="id" id="id">
        <label>Name</label>
        <input type="text" name="name" id="name" required>
        <label>Email</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Submit</button>
    </form>

    <h2>Search Users</h2>
    <form method="get">
        <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>

    <h2>Users</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <button onclick="editUser(<?= $user['id'] ?>,'<?= htmlspecialchars($user['name'], ENT_QUOTES) ?>','<?= htmlspecialchars($user['email'], ENT_QUOTES) ?>')">Edit</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function editUser(id, name, email) {
            document.getElementById('id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            window.scrollTo(0,0);
        }
    </script>
</body>
</html>
