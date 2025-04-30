<?php
$base_path = dirname(__DIR__);
$web_root = "../"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Center for Entrepreneurship</title>
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
            <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl max-w-3xl mx-auto">We're here to answer your questions and help you on your entrepreneurial journey.</p>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row">
                <!-- Contact Information -->
                <div class="md:w-1/2 md:pr-8 mb-10 md:mb-0">
                    <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
                    
                    <!-- Address -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Visit Us
                        </h3>
                        <p class="text-gray-600">
                            Center for Entrepreneurship<br>
                            Innovation Building, Room 300<br>
                            University Campus<br>
                            Kigali, Rwanda
                        </p>
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email Us
                        </h3>
                        <p class="text-gray-600">
                            General Inquiries: <a href="mailto:info@entrepreneurship.edu" class="text-blue-800 hover:underline">info@entrepreneurship.edu</a><br>
                            Program Information: <a href="mailto:programs@entrepreneurship.edu" class="text-blue-800 hover:underline">programs@entrepreneurship.edu</a><br>
                            Partnerships: <a href="mailto:partners@entrepreneurship.edu" class="text-blue-800 hover:underline">partners@entrepreneurship.edu</a>
                        </p>
                    </div>
                    
                    <!-- Phone -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Call Us
                        </h3>
                        <p class="text-gray-600">
                            Main Office: +250 78 123 4567<br>
                            Incubator: +250 78 765 4321
                        </p>
                    </div>
                    
                    <!-- Hours -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Office Hours
                        </h3>
                        <p class="text-gray-600">
                            Monday - Friday: 8:00 AM - 5:00 PM<br>
                            Saturday: 9:00 AM - 1:00 PM (Incubator Only)<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="md:w-1/2 md:pl-8 bg-gray-50 p-8 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-6">Send us a Message</h2>
                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <select id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="programs">Program Information</option>
                                <option value="incubator">Incubator Application</option>
                                <option value="partnership">Partnership Opportunity</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>
                        
                        <button type="submit" class="bg-blue-800 text-white py-3 px-6 rounded-md hover:bg-blue-700 transition duration-300 font-medium">Send Message</button>
                    </form>
                </div>
            </div>
            
            <!-- Map Section -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6 text-center">Find Us</h2>
                <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center">
                    <!-- This would be replaced with an actual map integration -->
                    <div class="text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        <p class="text-lg">Interactive Map</p>
                        <p>(Map would be embedded here)</p>
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