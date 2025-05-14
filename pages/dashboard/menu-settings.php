<?php
$currentPage = 'menu_setting';
require_once '../../includes/init.php'; // Make sure to include the connection file
include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';

// Fetch top-level menu items only (parent_id = 0 or NULL)
$query = "SELECT * FROM menu_items WHERE parent_id IS NULL ORDER BY display_order ASC";
$result = mysqli_query($conn, $query);

$items = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
}

// Add menu item
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $icon = $_POST['icon'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $display_order = $_POST['display_order'];
    $location = $_POST['location'];
    $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;

    $stmt = $conn->prepare("INSERT INTO menu_items (title, url, icon, is_active, display_order, location, parent_id, created_at, updated_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    $stmt->bind_param("sssiiss", $title, $url, $icon, $is_active, $display_order, $location, $parent_id);
    $stmt->execute();
    header("Location: menu-settings.php");
    exit;
}

// Delete menu item
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    header("Location: menu-settings.php");
    exit;
}
?>

<main class="flex-1 p-6">
    <h1 class="text-2xl font-bold mb-6">Menu Settings</h1>

    <!-- Add Menu Item Form -->
    <form method="POST" class="mb-6 bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Add Menu Item</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="title" required placeholder="Title" class="border p-2 rounded" />
            <input name="url" required placeholder="URL (e.g. /dashboard/home.php)" class="border p-2 rounded" />
            <input name="icon" placeholder="FontAwesome Icon (e.g. fas fa-home)" class="border p-2 rounded" />
            <input name="display_order" type="number" value="1" class="border p-2 rounded" placeholder="Order" />
            <select name="location" class="border p-2 rounded">
                <option value="sidebar">Sidebar</option>
                <option value="top">Top Menu</option>
            </select>
            <select name="parent_id" class="border p-2 rounded">
                <option value="">No Parent</option>
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <label class="inline-flex items-center mt-4">
            <input type="checkbox" name="is_active" class="mr-2" checked />
            Active
        </label>
        <button type="submit" name="add" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add Menu Item
        </button>
    </form>

    <!-- Menu Items List -->
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Existing Menu Items</h2>
        <ul class="space-y-2">
            <?php foreach ($items as $item): ?>
                <li class="flex justify-between items-center border p-2 rounded">
                    <div>
                        <i class="<?= htmlspecialchars($item['icon']) ?> mr-2"></i>
                        <strong><?= htmlspecialchars($item['title']) ?></strong> 
                        <span class="text-gray-500 text-sm">[<?= $item['url'] ?>]</span>
                    </div>
                    <form method="POST" onsubmit="return confirm('Delete this menu item?')">
                        <input type="hidden" name="delete_id" value="<?= $item['id'] ?>" />
                        <button type="submit" name="delete" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>
