<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Team - Center for Entrepreneurship</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-800">

    <?php
    // Pass the web root to the header
    $site_url = $web_root;
    include $base_path . '/components/Header.php'; 
    ?>

    <!-- Page Banner -->
    <div class="bg-blue-900 py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Team</h1>
            <p class="text-xl max-w-3xl mx-auto">Meet the dedicated professionals behind the Center for Entrepreneurship.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-16">
        <!-- Leadership Team -->
        <section class="mb-20">
            <h2 class="text-3xl font-bold text-center mb-12">Leadership Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="bg-gray-200 h-64 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-1">Dr. Sarah Johnson</h3>
                        <p class="text-blue-800 mb-4">Center Director</p>
                        <p class="text-gray-600 mb-4">Dr. Johnson brings over 15 years of experience in entrepreneurship education and venture development.</p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-800 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-blue-800 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="bg-gray-200 h-64 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-1">Prof. Michael Okonkwo</h3>
                        <p class="text-blue-800 mb-4">Academic Director</p>
                        <p class="text-gray-600 mb-4">Prof. Okonkwo oversees curriculum development and academic programs at the center.</p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-800 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="bg-gray-200 h-64 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-1">Ms. Jennifer Lee</h3>
                        <p class="text-blue-800 mb-4">Incubator Manager</p>
                        <p class="text-gray-600 mb-4">Ms. Lee manages the center's incubator program and startup mentorship initiatives.</p>
                        <div class="flex space-x-3">
                            <a href="#" class="text-blue-800 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-blue-800 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Faculty & Staff -->
        <section class="mb-20">
            <h2 class="text-3xl font-bold text-center mb-12">Faculty & Staff</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Staff Member 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm p-6 text-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Dr. Robert Chen</h3>
                    <p class="text-blue-800 mb-2">Business Faculty</p>
                </div>

                <!-- Staff Member 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm p-6 text-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Ms. Maria Rodriguez</h3>
                    <p class="text-blue-800 mb-2">Program Coordinator</p>
                </div>

                <!-- Staff Member 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm p-6 text-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Dr. Lisa Wong</h3>
                    <p class="text-blue-800 mb-2">Technology Faculty</p>
                </div>

                <!-- Staff Member 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm p-6 text-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">Mr. James Wilson</h3>
                    <p class="text-blue-800 mb-2">Student Engagement Officer</p>
                </div>
            </div>
        </section>

        <!-- Advisory Board -->
        <section>
            <h2 class="text-3xl font-bold text-center mb-12">Advisory Board</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 text-left bg-gray-50 text-gray-600 uppercase tracking-wider border-b">Title</th>
                            <th class="py-3 px-6 text-left bg-gray-50 text-gray-600 uppercase tracking-wider border-b">Organization</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">Ms. Elizabeth Tanner</td>
                            <td class="py-4 px-6 border-b border-gray-200">CEO</td>
                            <td class="py-4 px-6 border-b border-gray-200">Global Innovation Partners</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">Mr. David Kimani</td>
                            <td class="py-4 px-6 border-b border-gray-200">Founder</td>
                            <td class="py-4 px-6 border-b border-gray-200">TechVentures Africa</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">Dr. Aisha Patel</td>
                            <td class="py-4 px-6 border-b border-gray-200">Director</td>
                            <td class="py-4 px-6 border-b border-gray-200">Innovation Research Institute</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">Mr. Carlos Mendez</td>
                            <td class="py-4 px-6 border-b border-gray-200">Managing Partner</td>
                            <td class="py-4 px-6 border-b border-gray-200">Venture Capital Group</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 border-b border-gray-200">Ms. Sophie Zhang</td>
                            <td class="py-4 px-6 border-b border-gray-200">President</td>
                            <td class="py-4 px-6 border-b border-gray-200">Alumni Entrepreneurs Association</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php include $base_path . '/components/Footer.php'; ?>
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>