<?php

// Format the date to a readable format
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

// Get page title based on page identifier
function getPageTitle($page) {
    $titles = [
        'dashboard' => 'Dashboard',
        'courses' => 'Manage Courses',
        'news' => 'Manage News',
        'users' => 'Manage Users',
        'settings' => 'Settings',
        'menu_setting' => 'Menu Settings'
    ];

    return isset($titles[$page]) ? $titles[$page] : 'Dashboard';
}

// Fetch data from the database using a prepared statement
function fetchData($conn, $query, $params = [], $types = '') {
    $stmt = mysqli_prepare($conn, $query);
    if ($params && $types) {
        mysqli_stmt_bind_param($stmt, $types, ...$params); // Binding parameters safely
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$result) {
        error_log("Database query failed: " . mysqli_error($conn) . " - Query: " . $query);
        return [];
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

// Count records in a table, uses prepared statement to prevent SQL injection
function countRecords($conn, $table) {
    // Make sure the table name is valid (use a whitelist for security)
    $allowedTables = ['users', 'courses', 'news', 'menu_items']; // Whitelist of allowed table names
    if (!in_array($table, $allowedTables)) {
        error_log("Unauthorized table access attempt: " . $table);
        return 0;
    }

    $query = "SELECT COUNT(*) AS count FROM `$table`"; // Safe query to count records
    $result = mysqli_query($conn, $query);

    if (!$result) {
        error_log("Count query failed: " . mysqli_error($conn) . " - Table: " . $table);
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Fetch menu items based on the location
function getMenuItems($conn, $location = 'dashboard') {
    $query = "SELECT * FROM menu_items WHERE location = ? AND is_active = 1 ORDER BY display_order ASC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $location);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // Return all menu items as an associative array
    }

    return []; // Return empty array if no results
}

?>
