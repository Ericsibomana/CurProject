<?php
$courses = [
    'foundation' => [
        [
            'title' => 'Introduction to Entrepreneurship',
            'description' => 'Learn the fundamental concepts, mindsets, and practices of successful entrepreneurs through case studies and hands-on projects.',
            'level' => 'Beginner',
            'duration' => '8 weeks',
            'image' => '/images/courses/intro-entrepreneurship.jpg',
            'id' => 1
        ],
        [
            'title' => 'Business Model Development',
            'description' => 'Discover how to create, test, and refine business models that deliver value to customers and generate sustainable revenue.',
            'level' => 'Beginner',
            'duration' => '10 weeks',
            'image' => '/images/courses/business-model.jpg',
            'id' => 2
        ],
        [
            'title' => 'Market Research Fundamentals',
            'description' => 'Master techniques to identify market opportunities, analyze competitors, and understand customer needs and behaviors.',
            'level' => 'Beginner',
            'duration' => '6 weeks',
            'image' => '/images/courses/market-research.jpg',
            'id' => 3
        ],
        [
            'title' => 'Financial Literacy for Entrepreneurs',
            'description' => 'Build essential financial knowledge to manage your business finances, understand statements, and make sound financial decisions.',
            'level' => 'Beginner',
            'duration' => '8 weeks',
            'image' => '/images/courses/financial-literacy.jpg',
            'id' => 4
        ]
    ],
    'advanced' => [
        [
            'title' => 'Venture Capital & Fundraising',
            'description' => 'Learn strategies for attracting investment, preparing pitch decks, and navigating the fundraising process effectively.',
            'level' => 'Advanced',
            'duration' => '12 weeks',
            'image' => '/images/courses/venture-capital.jpg',
            'id' => 5
        ],
        [
            'title' => 'Growth Strategy & Scaling',
            'description' => 'Develop frameworks for scaling your business operations, expanding into new markets, and managing rapid growth.',
            'level' => 'Advanced',
            'duration' => '14 weeks',
            'image' => '/images/courses/growth-strategy.jpg',
            'id' => 6
        ],
        [
            'title' => 'Innovation Management',
            'description' => 'Learn methods to foster innovation within organizations and bring new products or services to market successfully.',
            'level' => 'Intermediate',
            'duration' => '10 weeks',
            'image' => '/images/courses/innovation-management.jpg',
            'id' => 7
        ],
        [
            'title' => 'Global Business Expansion',
            'description' => 'Explore strategies and challenges in expanding businesses across international markets and cultures.',
            'level' => 'Advanced',
            'duration' => '12 weeks',
            'image' => '/images/courses/global-expansion.jpg',
            'id' => 8
        ]
    ],
    'specialized' => [
        [
            'title' => 'Social Entrepreneurship',
            'description' => 'Learn how to create ventures that address social or environmental challenges while maintaining financial sustainability.',
            'level' => 'All Levels',
            'duration' => '12 weeks',
            'image' => '/images/courses/social-entrepreneurship.jpg',
            'id' => 9
        ],
        [
            'title' => 'Tech Startup Bootcamp',
            'description' => 'Intensive program covering the unique challenges and opportunities in launching and growing technology startups.',
            'level' => 'Intermediate',
            'duration' => '16 weeks',
            'image' => '/images/courses/tech-startup.jpg',
            'id' => 10
        ],
        [
            'title' => 'Creative Entrepreneurship',
            'description' => 'Designed for artists, designers, and creators looking to build sustainable businesses from their creative talents.',
            'level' => 'All Levels',
            'duration' => '10 weeks',
            'image' => '/images/courses/creative-entrepreneurship.jpg',
            'id' => 11
        ],
        [
            'title' => 'Healthcare Innovation',
            'description' => 'Focused on entrepreneurial opportunities and challenges specific to the healthcare industry.',
            'level' => 'Intermediate',
            'duration' => '14 weeks',
            'image' => '/images/courses/healthcare-innovation.jpg',
            'id' => 12
        ]
    ]
];

// Data for course categories display
$categories = [
    [
        'name' => 'Foundational',
        'id' => 1,
        'description' => 'Essential courses for those beginning their entrepreneurial journey.'
    ],
    [
        'name' => 'Advanced',
        'id' => 2,
        'description' => 'For entrepreneurs ready to scale and grow their ventures.'
    ],
    [
        'name' => 'Specialized',
        'id' => 3,
        'description' => 'Focus on specific industries or entrepreneurial skills.'
    ]
];

// Function to get courses by category
function getCoursesByCategory($category) {
    global $courses;
    return isset($courses[$category]) ? $courses[$category] : [];
}

// Function to get all categories
function getCategories() {
    global $categories;
    return $categories;
}

// Function to get a single course by ID
function getCourseById($courseId) {
    global $courses;
    
    foreach ($courses as $category => $categoryCourses) {
        foreach ($categoryCourses as $course) {
            if ($course['id'] === $courseId) {
                return $course;
            }
        }
    }
    
    return null;
}
?>
