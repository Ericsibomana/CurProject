<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Center for Entrepreneurship</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
$web_root = "../"; 
$base_path = dirname(__DIR__);
include $base_path . '/components/Header.php';
?>

<main class="max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white p-6 shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-primary mb-6">Our Projects</h1>
        
        <div class="space-y-8">
            <!-- Project 1 -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-primary mb-2">Innovation Hub</h2>
                <p class="text-gray-700 mb-4">
                    The Innovation Hub is a collaborative workspace where entrepreneurs, students, and faculty 
                    can work together on innovative projects. The hub provides resources, mentorship, and networking
                    opportunities to help bring ideas to life.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Innovation</span>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Collaboration</span>
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">Entrepreneurship</span>
                </div>
            </div>
            
            <!-- Project 2 -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-semibold text-primary mb-2">Student Startup Incubator</h2>
                <p class="text-gray-700 mb-4">
                    Our student startup incubator program provides funding, mentorship, and resources to 
                    help student entrepreneurs turn their ideas into viable businesses. The program runs
                    annually and selects promising startups to receive support.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Startups</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Funding</span>
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Mentorship</span>
                </div>
            </div>
            
            <!-- Project 3 -->
            <div>
                <h2 class="text-2xl font-semibold text-primary mb-2">Community Outreach Program</h2>
                <p class="text-gray-700 mb-4">
                    Our community outreach program aims to foster entrepreneurship in the local community.
                    We organize workshops, seminars, and networking events to help local entrepreneurs 
                    develop their skills and grow their businesses.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Community</span>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded">Education</span>
                    <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-0.5 rounded">Networking</span>
                </div>
            </div>
        </div>
        
        <div class="mt-10">
            <h2 class="text-2xl font-semibold text-primary mb-4">Get Involved</h2>
            <p class="text-gray-700 mb-6">
                Interested in participating in our projects or suggesting a new one? Contact us to learn more about
                how you can get involved with the Center for Entrepreneurship's initiatives.
            </p>
            <a href="../pages/contact.php" class="bg-primary text-white px-6 py-2 rounded hover:bg-primary-dark transition duration-300">Contact Us</a>
        </div>
    </div>
</main>

<?php include $base_path . '/components/Footer.php'; ?>
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>