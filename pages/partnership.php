<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnership - Center for Entrepreneurship</title>
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
        <h1 class="text-3xl font-bold text-primary mb-6">Partnership Opportunities</h1>
        
        <div class="prose max-w-none mb-8">
            <p>
                The Center for Entrepreneurship collaborates with businesses, organizations, and other academic institutions 
                to create a thriving entrepreneurial ecosystem. Our partnerships provide mutual benefits, including access to 
                resources, expertise, and opportunities for innovation.
            </p>
        </div>
        
        <!-- Partnership Types -->
        <div class="grid md:grid-cols-2 gap-8 mb-10">
            <!-- Corporate Partnerships -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-primary mb-4">Corporate Partnerships</h2>
                <ul class="space-y-2 text-gray-700 mb-4">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Sponsor entrepreneurship events and competitions
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Provide mentorship and expertise to student entrepreneurs
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Collaborate on research and innovation projects
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Recruit talent from our pool of entrepreneurial students
                    </li>
                </ul>
                <a href="../pages/contact.php?type=corporate" class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark transition duration-300">Become a Corporate Partner</a>
            </div>
            
            <!-- Academic Partnerships -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                <h2 class="text-2xl font-semibold text-primary mb-4">Academic Partnerships</h2>
                <ul class="space-y-2 text-gray-700 mb-4">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Collaborative research initiatives
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Student and faculty exchange programs
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Joint course development and delivery
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Cross-institutional entrepreneurship initiatives
                    </li>
                </ul>
                <a href="../pages/contact.php?type=academic" class="inline-block bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark transition duration-300">Explore Academic Partnerships</a>
            </div>
        </div>
        
        <!-- Current Partners -->
        <h2 class="text-2xl font-bold text-primary mb-4">Our Current Partners</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <!-- Partner logos would go here - Using placeholder blocks -->
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 1</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 2</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 3</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 4</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 5</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 6</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 7</div>
            <div class="bg-gray-100 h-24 flex items-center justify-center rounded">Partner 8</div>
        </div>
        
        <!-- Partnership Form -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold text-primary mb-4">Interested in Partnering with Us?</h2>
            <p class="text-gray-700 mb-4">
                Fill out the form below to express your interest in partnering with the Center for Entrepreneurship. 
                Our team will get back to you to discuss potential collaboration opportunities.
            </p>
            <form action="../process/partnership-inquiry.php" method="POST" class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="organization" class="block text-gray-700 mb-1">Organization Name</label>
                    <input type="text" id="organization" name="organization" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <div>
                    <label for="contact_name" class="block text-gray-700 mb-1">Contact Person</label>
                    <input type="text" id="contact_name" name="contact_name" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <div>
                    <label for="phone" class="block text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div class="md:col-span-2">
                    <label for="partnership_type" class="block text-gray-700 mb-1">Partnership Type</label>
                    <select id="partnership_type" name="partnership_type" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="corporate">Corporate Partnership</option>
                        <option value="academic">Academic Partnership</option>
                        <option value="community">Community Partnership</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="message" class="block text-gray-700 mb-1">Partnership Idea/Proposal</label>
                    <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-primary" required></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded hover:bg-primary-dark transition duration-300">Submit Inquiry</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include $base_path . '/components/Footer.php'; ?>
    <script src="<?php echo $web_root; ?>assets/script.js"></script>
</body>
</html>