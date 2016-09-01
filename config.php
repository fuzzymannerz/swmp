<?php

/*********************************************************************************/
/** To configure SWMP copy this file to "config.local.php" and change the values */
/*********************************************************************************/

return array
(
    // All themes are files in the "css/themes" folder
    // The default theme is "simplex"
    "theme" => "simplex",

    // If set to true, errors are shown for system information that could not be retrieved
    // After the server is set up it is recommended to set this to false
    "show_errors" => true,

    // The window title
    // Available replacements are: {hostname}, {ip}, {os} and {kernel}
    "window_title" => "SWMP | {hostname}",
);
