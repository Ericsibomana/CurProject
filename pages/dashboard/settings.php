<?php
require_once '../../includes/init.php';
$currentPage = 'settings';

include_once '../../components/DashboardHeader.php';
include_once '../../components/DashboardSidebar.php';
include_once '../../components/SettingCard.php';
?>

<main class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Settings</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php
        renderSettingCard(
            'fas fa-bars',
            'bg-blue-100',
            'text-blue-600',
            'Menu Settings',
            'Customize dashboard navigation menu',
            'Customize your dashboard menu by adding, removing, or reordering items.',
            SITE_URL . '/pages/dashboard/menu-settings.php',
            'Manage Menu',
            'bg-blue-600 hover:bg-blue-700'
        );

        renderSettingCard(
            'fas fa-cog',
            'bg-green-100',
            'text-green-600',
            'Site Settings',
            'Configure website general settings',
            'Manage site name, logo, contact information, and other general settings.',
            SITE_URL . '/pages/dashboard/site-settings.php',
            'Manage Site Settings',
            'bg-green-600 hover:bg-green-700'
        );

        renderSettingCard(
            'fas fa-user-shield',
            'bg-purple-100',
            'text-purple-600',
            'User Roles',
            'Manage user permissions and roles',
            'Define user roles and their corresponding permissions throughout the system.',
            SITE_URL . '/pages/dashboard/user-roles.php',
            'Manage Roles',
            'bg-purple-600 hover:bg-purple-700'
        );

        renderSettingCard(
            'fas fa-database',
            'bg-yellow-100',
            'text-yellow-600',
            'Backup & Restore',
            'Manage database backups',
            'Create database backups and restore from previous backups when needed.',
            SITE_URL . '/pages/dashboard/backup.php',
            'Backup & Restore',
            'bg-yellow-600 hover:bg-yellow-700'
        );
        ?>
    </div>
</main>

<?php include_once '../../components/DashFooter.php'; ?>
