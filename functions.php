<?php
// for a certain role user the code will be execute
function add_inline_js_for_customer() {
    if (current_user_can('customer')) { // Check if the user has the 'customer' role
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                // Select all delete links in the table
                let deleteLinks = $("table.items-table.post td a.wpuf-posts-delete");

                // Iterate over each delete link
                deleteLinks.each(function () {
                    // Extract the 'href' attribute from the delete link
                    let originalUrl = $(this).attr("href");

                    // Extract the part after '?action=del&'
                    let extractedPart = originalUrl.split('?action=del&')[1]; // "pid=3337&_wpnonce=6e5683b11d"

                    // Define the new base URL
                    let newBaseUrl = "https://example.com/edit/?";

                    // Combine the new base URL with the extracted part to create the new URL
                    let newUrl = newBaseUrl + extractedPart;

                    // Create a new 'a' element
                    let newLink = $("<a>", {
                        class: "wpuf-posts-options wpuf-posts-edit",
                        href: newUrl,
                        html: `
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2175 0.232507L14.0736 2.08857C14.3836 2.39858 14.3836 2.90335 14.0736 3.21336L12.6189 4.66802L9.63808 1.68716L11.0927 0.232507C11.4027 -0.0775022 11.9075 -0.0775022 12.2175 0.232507ZM0 14.3061V11.3253L8.7955 2.52974L11.7764 5.5106L2.98086 14.3061H0Z" fill="#B7C4E7"></path>
                            </svg>
                        `
                    });

                    // Append the new 'a' element after the delete link
                    $(this).parent().append(newLink);
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'add_inline_js_for_customer');
