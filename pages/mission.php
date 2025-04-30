<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission & Vision - Center for Entrepreneurship</title>
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
            <h1 class="text-4xl font-bold mb-4">Mission & Vision</h1>
            <p class="text-xl max-w-3xl mx-auto">Guiding principles that drive our center forward.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto">
            <!-- Mission Section -->
            <section class="mb-16">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/3 mb-8 md:mb-0">
                        <div class="bg-blue-800 text-white rounded-full w-48 h-48 flex items-center justify-center mx-auto">
                            <h2 class="text-3xl font-bold">Our Mission</h2>
                        </div>
                    </div>
                    <div class="md:w-2/3 md:pl-12">
                        <p class="text-lg mb-6">The Center for Entrepreneurship is dedicated to fostering innovation and entrepreneurial thinking among students, faculty, and the broader community. We aim to provide the knowledge, skills, and resources necessary for individuals to identify opportunities, develop viable solutions, and create sustainable ventures.</p>
                        <p class="text-lg">Through education, mentorship, and hands-on experience, we empower the next generation of entrepreneurs to make a positive impact on society.</p>
                    </div>
                </div>
            </section>

            <!-- Vision Section -->
            <section class="mb-16">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:order-2 md:w-1/3 mb-8 md:mb-0">
                        <div class="bg-blue-600 text-white rounded-full w-48 h-48 flex items-center justify-center mx-auto">
                            <h2 class="text-3xl font-bold">Our Vision</h2>
                        </div>
                    </div>
                    <div class="md:order-1 md:w-2/3 md:pr-12">
                        <p class="text-lg mb-6">We envision a world where entrepreneurial thinking is embraced as a catalyst for positive change and sustainable development. Our vision is to be a leading center of excellence in entrepreneurship education and practice.</p>
                        <p class="text-lg">By 2030, we aim to have empowered 10,000 entrepreneurs who will create ventures that address pressing social, economic, and environmental challenges both locally and globally.</p>
                    </div>
                </div>
            </section>

            <!-- Core Values -->
            <section>
                <h2 class="text-3xl font-bold text-center mb-12">Our Core Values</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div class="bg-gray-50 p-8 rounded-lg text-center shadow-md">
                        <div class="bg-blue-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Innovation</h3>
                        <p>We encourage creative thinking and novel approaches to solving problems.</p>
                    </div>
                    
                    <!-- Value 2 -->
                    <div class="bg-gray-50 p-8 rounded-lg text-center shadow-md">
                        <div class="bg-blue-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Collaboration</h3>
                        <p>We believe in the power of diverse perspectives and collaborative efforts.</p>
                    </div>
                    
                    <!-- Value 3 -->
                    <div class="bg-gray-50 p-8 rounded-lg text-center shadow-md">
                        <div class="bg-blue-800 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Integrity</h3>
                        <p>We uphold the highest ethical standards in all our endeavors.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <?php include $base_path . '/components/Footer.php'; ?>
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>