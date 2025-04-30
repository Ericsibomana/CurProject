<?php
// news-data.php - Store your news data in a separate file
function getNewsItems() {
    return [
        [
            'id' => 1,
            'date' => 'April 2, 2025',
            'title' => 'Shape Your Future Globally',
            'excerpt' => 'The Catholic University of Rwanda (CUR) is opening global doors for ambitious students!',
            'content' => '<p>The Catholic University of Rwanda (CUR) is proud to announce expanded global partnerships giving our students unprecedented opportunities for international education and career advancement.</p>
                          <p>Through new agreements with universities across Europe, North America, and Asia, CUR students can now participate in exchange programs, joint research initiatives, and global internships that prepare them for success in an increasingly connected world.</p>
                          <p>These partnerships reflect our commitment to providing world-class education that combines Catholic values with global perspectives. Students who participate in these programs report greater cultural awareness, improved language skills, and enhanced employability after graduation.</p>
                          <p>"This initiative represents a major step forward in our mission to develop well-rounded leaders who can make positive contributions on the global stage," said University President Dr. Emmanuel Ntaganda.</p>
                          <p>Applications for the next cohort of exchange students open next month. Interested students should contact the International Relations Office for more information.</p>',
            'image' => 'https://via.placeholder.com/400x300'
        ],
        [
            'id' => 2,
            'date' => 'April 2, 2025',
            'title' => 'New Research Center Opens',
            'excerpt' => 'CUR launches state-of-the-art research facility focused on sustainable development.',
            'content' => '<p>The Catholic University of Rwanda is proud to announce the opening of our new Center for Sustainable Development Research, a cutting-edge facility dedicated to finding innovative solutions to environmental and social challenges in Rwanda and beyond.</p>
                          <p>The center features advanced laboratories, collaborative workspaces, and specialized equipment that will support faculty and student researchers across multiple disciplines including environmental science, agriculture, economics, and public health.</p>
                          <p>"This center represents our commitment to integrating research excellence with our Catholic mission to care for our common home," said Dr. Marie Mukamana, Director of Research. "We aim to develop practical solutions that improve lives while protecting the environment for future generations."</p>
                          <p>The facility was made possible through a generous donation from international partners and the continued support of the Catholic Church in Rwanda.</p>
                          <p>Faculty and students interested in participating in research projects should submit proposals through the university\'s research portal.</p>',
            'image' => 'https://via.placeholder.com/400x300'
        ],
        [
            'id' => 3,
            'date' => 'April 2, 2025',
            'title' => 'Alumni Achievement Award',
            'excerpt' => 'CUR graduate recognized for outstanding contributions to healthcare in rural communities.',
            'content' => '<p>The Catholic University of Rwanda is proud to announce that Dr. Jean-Paul Habimana, a 2015 graduate of our medical program, has received the prestigious National Healthcare Innovation Award for his pioneering work bringing medical services to underserved rural communities.</p>
                          <p>Dr. Habimana developed a mobile clinic program that has provided essential healthcare to over 50,000 people in remote areas of Rwanda. His initiative combines traditional medical practices with modern technology, allowing healthcare workers to reach communities previously without access to regular medical care.</p>
                          <p>"My education at CUR taught me that excellence in medicine must be paired with compassion and a commitment to serving those most in need," said Dr. Habimana. "I\'m grateful for the foundation this university provided for my work."</p>
                          <p>The university will honor Dr. Habimana at this year\'s Alumni Gala, where he will deliver a keynote address on healthcare innovation in developing regions.</p>
                          <p>Current students interested in career paths in public health and rural medicine are encouraged to attend this special event.</p>',
            'image' => 'https://via.placeholder.com/400x300'
        ]
    ];
}

// Function to get a specific news item by ID
function getNewsById($id) {
    $news_items = getNewsItems();
    foreach ($news_items as $news) {
        if ($news['id'] == $id) {
            return $news;
        }
    }
    return null;
}
?>