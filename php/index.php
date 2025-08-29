<?php
include 'db.php';

// Load entry if id is provided
$editUser = null;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $editUser = $result->fetch_assoc();
    $stmt->close();
}

// Load all users for display
$result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css">
</head>
<body>
    <h1>User Form</h1>

    <form action="process-form.php" method="post">
        <input type="hidden" name="id" value="<?= $editUser['id'] ?? '' ?>">
        <label>Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($editUser['name'] ?? '') ?>" required>
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($editUser['email'] ?? '') ?>" required>
        <button type="submit"><?= $editUser ? "Update" : "Add" ?></button>
    </form>

    <h2>All Users</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="?id=<?= $user['id'] ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
