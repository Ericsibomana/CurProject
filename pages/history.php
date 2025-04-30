<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Center for Entrepreneurship</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-800">
    <!-- Your existing header would go here -->
    <?php
    // Pass the web root to the header
    $site_url = $web_root;
    include $base_path . '/components/Header.php'; 
    ?>
    <!-- Page Banner -->
    <div class="bg-blue-900 py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Our History</h1>
            <p class="text-xl max-w-3xl mx-auto">Discover the journey of the Center for Entrepreneurship from its foundation to the present day.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Timeline -->
            <div class="space-y-12">
                <!-- Timeline Item -->
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <div class="text-2xl font-bold text-blue-800">2005</div>
                    </div>
                    <div class="md:w-3/4 relative pl-8 border-l-4 border-blue-800 md:pl-12">
                        <div class="absolute w-4 h-4 bg-blue-800 rounded-full left-0 top-2 -ml-2"></div>
                        <h3 class="text-xl font-semibold mb-2">Foundation Year</h3>
                        <p class="text-gray-600">The Center for Entrepreneurship was established with the mission to foster innovation and entrepreneurial thinking among university students. Initial programs focused on business plan competitions and startup workshops.</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <div class="text-2xl font-bold text-blue-800">2010</div>
                    </div>
                    <div class="md:w-3/4 relative pl-8 border-l-4 border-blue-800 md:pl-12">
                        <div class="absolute w-4 h-4 bg-blue-800 rounded-full left-0 top-2 -ml-2"></div>
                        <h3 class="text-xl font-semibold mb-2">Expansion Phase</h3>
                        <p class="text-gray-600">The center expanded its curriculum to include entrepreneurship courses across multiple disciplines. Partnerships with local businesses began to provide internship opportunities for students.</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <div class="text-2xl font-bold text-blue-800">2015</div>
                    </div>
                    <div class="md:w-3/4 relative pl-8 border-l-4 border-blue-800 md:pl-12">
                        <div class="absolute w-4 h-4 bg-blue-800 rounded-full left-0 top-2 -ml-2"></div>
                        <h3 class="text-xl font-semibold mb-2">Innovation Hub Launch</h3>
                        <p class="text-gray-600">The opening of our dedicated Innovation Hub provided a collaborative space for students to develop their business ideas. The first cohort of student-led startups received seed funding through our newly established grant program.</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <div class="text-2xl font-bold text-blue-800">2020</div>
                    </div>
                    <div class="md:w-3/4 relative pl-8 border-l-4 border-blue-800 md:pl-12">
                        <div class="absolute w-4 h-4 bg-blue-800 rounded-full left-0 top-2 -ml-2"></div>
                        <h3 class="text-xl font-semibold mb-2">Global Initiative</h3>
                        <p class="text-gray-600">Launch of international partnerships and exchange programs to foster global entrepreneurship. Our virtual incubator program was introduced to support remote collaboration and mentorship.</p>
                    </div>
                </div>

                <!-- Timeline Item -->
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <div class="text-2xl font-bold text-blue-800">Present</div>
                    </div>
                    <div class="md:w-3/4 relative pl-8 border-l-4 border-blue-800 md:pl-12">
                        <div class="absolute w-4 h-4 bg-blue-800 rounded-full left-0 top-2 -ml-2"></div>
                        <h3 class="text-xl font-semibold mb-2">Current Impact</h3>
                        <p class="text-gray-600">Today, the Center for Entrepreneurship supports over 200 courses, runs an active incubator program, and continues to expand its global reach with partners across five continents.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include $base_path . '/components/Footer.php'; ?>
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>