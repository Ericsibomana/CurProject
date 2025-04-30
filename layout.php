<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center for Entrepreneurship</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#003366',
                        'secondary': '#8c8fc7',
                    }
                }
            }
        }
    </script>
    <!-- Custom CSS (optional) -->
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body class="font-sans">
    <?php
    // Include all components
    include 'components/Header.php';
    include 'components/Slideshow.php';
    include 'components/DirectorMessage.php';
    include 'components/ImportantInfo.php';
    
    // Include news data and components
    include_once 'data/news.php';
    include_once 'components/NewsCard.php';
    include_once 'components/NewsSection.php'; // Added this line to include the NewsSection component
    
    // Call the renderNewsSection function
    renderNewsSection();
    include 'components/Footer.php';
    ?>

    <!-- JavaScript -->
    <script src="assets/script.js"></script>
</body>
</html>