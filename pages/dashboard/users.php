<?php
require_once '../../includes/init.php';
$currentPage = 'users';

$error = '';
$success = false;

// DELETE user
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'delete') {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    if (mysqli_query($conn, "DELETE FROM users WHERE id = '$user_id'")) {
        header('Location: users.php?success=deleted');
        exit;
    } else {
        $error = 'Error deleting user: ' . mysqli_error($conn);
    }
}

// ADD NEW USER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'add_user') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if (empty($name) || empty($username) || empty($role) || empty($password)) {
        $error = 'All fields are required.';
    } else {
        $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Username already exists.';
        } else {
            $query = "INSERT INTO users (name, username, password, role, created_at) VALUES ('$name', '$username', '$hashed_password', '$role', NOW())";
            if (mysqli_query($conn, $query)) {
                header('Location: users.php?success=added');
                exit;
            } else {
                $error = 'Error adding user: ' . mysqli_error($conn);
            }
        }
    }
}

// UPDATE user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update_user') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    if (empty($name) || empty($username) || empty($role)) {
        $error = 'Name, Username and Role are required.';
    } else {
        $query = "UPDATE users SET name='$name', username='$username', role='$role'";
        if ($password) {
            $query .= ", password='$password'";
        }
        $query .= " WHERE id='$user_id'";

        if (mysqli_query($conn, $query)) {
            header('Location: users.php?success=updated');
            exit;
        } else {
            $error = 'Error updating user: ' . mysqli_error($conn);
        }
    }
}

// Get user for editing
$edit_user = null;
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'edit') {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
    if ($res && mysqli_num_rows($res) > 0) {
        $edit_user = mysqli_fetch_assoc($res);
    } else {
        $error = 'User not found.';
    }
}

// Fetch all users
$users = fetchData($conn, "SELECT * FROM users ORDER BY created_at DESC");

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
?>

<main class="flex-1 p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Management</h1>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="bg-green-100 text-green-700 border border-green-400 rounded p-4 mb-4">
            <?php
                if ($_GET['success'] == 'deleted') echo 'User has been deleted.';
                elseif ($_GET['success'] == 'updated') echo 'User has been updated.';
                elseif ($_GET['success'] == 'added') echo 'User has been added.';
            ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 border border-red-400 rounded p-4 mb-4"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && $edit_user): ?>
        <!-- Edit User Form -->
        <form method="post" class="bg-white p-6 rounded shadow space-y-4">
            <input type="hidden" name="action" value="update_user">
            <input type="hidden" name="user_id" value="<?php echo $edit_user['id']; ?>">

            <h2 class="text-xl font-semibold mb-4">Edit User</h2>

            <div>
                <label>Name*</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($edit_user['name']); ?>" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Username*</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($edit_user['username']); ?>" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Role*</label>
                <input type="text" name="role" value="<?php echo htmlspecialchars($edit_user['role']); ?>" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Password (leave blank to keep current)</label>
                <input type="password" name="password" class="w-full border p-2 rounded">
            </div>

            <div class="text-right">
                <button class="bg-primary text-white px-4 py-2 rounded hover:bg-blue-700">Update User</button>
                <a href="users.php" class="ml-4 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>

    <?php else: ?>
        <!-- Add User Form -->
        <form method="post" class="bg-white p-6 rounded shadow space-y-4 mb-8">
            <input type="hidden" name="action" value="add_user">

            <h2 class="text-xl font-semibold mb-4">Add New User</h2>

            <div>
                <label>Name*</label>
                <input type="text" name="name" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Username*</label>
                <input type="text" name="username" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Role*</label>
                <input type="text" name="role" required class="w-full border p-2 rounded">
            </div>

            <div>
                <label>Password*</label>
                <input type="password" name="password" required class="w-full border p-2 rounded">
            </div>

            <div class="text-right">
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add User</button>
            </div>
        </form>
    <?php endif; ?>

    <!-- List of Users -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Username</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Created</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($users)): ?>
                    <tr><td colspan="5" class="px-6 py-4 text-center">No users found.</td></tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="px-6 py-4 text-gray-500"><?php echo date('Y-m-d', strtotime($user['created_at'])); ?></td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="?action=edit&id=<?php echo $user['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?');" class="text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>
