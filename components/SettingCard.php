<?php
function renderSettingCard($iconClass, $bgColor, $iconColor, $title, $description, $details, $link, $buttonText, $buttonColor) {
    echo <<<HTML
    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition duration-300">
        <div class="flex items-center mb-4">
            <div class="$bgColor p-3 rounded-full mr-4">
                <i class="$iconClass $iconColor"></i>
            </div>
            <div>
                <h2 class="text-lg font-semibold">$title</h2>
                <p class="text-gray-600">$description</p>
            </div>
        </div>
        <p class="text-gray-600 mb-4">$details</p>
        <a href="$link" 
           class="inline-block $buttonColor text-white px-4 py-2 rounded-md hover:opacity-90 transition duration-300">
            $buttonText
        </a>
    </div>
    HTML;
}
?>
