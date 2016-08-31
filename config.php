<?php

/*******************************************************************************/
/** to configure swmp copy this file to config.local.php and change the values */
/*******************************************************************************/

return array
(
    // all themes are files in the /css/ folder
    // available themes are:
    // "cerulean", "cosmo", "lumen", "paper", "readable", "sandstone",
    // "simplex", "slate", "spacelab", "superhero", "united", "yeti"
    "theme" => "simplex",

    // if set to true errors are shown for system information that could not be recieved
    // after the server is set up it is recommended to set this to false
    "show_errors" => true,

    // the windowtitle
    // available replacements are {hostname}, {ip}, {os} and {kernel}
    "window_title" => "SWMP | {hostname}",
);