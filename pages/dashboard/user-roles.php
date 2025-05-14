<?php
$currentPage = 'user_roles';
require_once '../../includes/init.php';
include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';

// Fetch all users
$query = "SELECT * FROM users ORDER BY id ASC";
$result = mysqli_query($conn, $query);

$users = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

// Update user role
if (isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $new_role, $user_id);
    $stmt->execute();
    header("Location: user_roles.php");
    exit;
}
?>

<main class="flex-1 p-6">
    <h1 class="text-2xl font-bold mb-6">User Roles</h1>

    <!-- User Role Table -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Manage Roles</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Username</th>
                    <th class="p-2 border">Current Role</th>
                    <th class="p-2 border">Change Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="p-2 border"><?= htmlspecialchars($user['name']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($user['username']) ?></td>
                        <td class="p-2 border"><?= htmlspecialchars($user['role']) ?></td>
                        <td class="p-2 border">
                            <form method="POST" class="flex items-center space-x-2">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                                <select name="role" class="border p-1 rounded">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="editor" <?= $user['role'] == 'editor' ? 'selected' : '' ?>>Editor</option>
                                    <option value="viewer" <?= $user['role'] == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                                </select>
                                <button type="submit" name="update_role" class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>
