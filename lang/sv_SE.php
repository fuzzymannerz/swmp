<?php

// Swedish language file for SWMP.
// Help translate SWMP with pull requests for language files at github.com/fuzzymannerz/SWMP

// HOW TO MAKE A LANGUAGE FILE:
// SEE THE ENGLISH "en_GB.php" for initial phrases.

return array
(

    // Top Buttons
    "RELOAD" => "Uppdatera",
    "SETTINGS" => "Inställningar",
    "SAVE_SETTINGS" => "Spara inställningar",
    "GO_BACK" => "Tillbaka",

// MAIN PAGE

    // System Information Section
    "SYS_INFO" => "Systeminformation",
    "HOSTNAME" => "Värdnamn",
    "IP_ADDRESS" => "IP-adress",
    "OS" => "OS",
    "KERNEL" => "Kärna",
    "UPTIME" => "Drifttid",
    "BOOT_TIME" => "Starttid",
    "CPU" => "CPU",
    "TEMPERATURE" => "Temperatur",
    "CORE" => "Core",

    // RAM Usage Section
    "RAM_USAGE" => "RAM Användning",
    "USED_RAM" => "Används RAM",
    "FREE_RAM" => "Fritt RAM",
    "TOTAL_RAM" => "Totalt RAM",

    // Swap Section
    "SWAP_USAGE" => "Swap Användning",
    "USED_SWAP" => "Används Swap",
    "FREE_SWAP" => "Fritt Swap",
    "TOTAL_SWAP" => "Totalt Swap",

    // CPU Section
    "CPU_AVE_LOAD" => "CPU-genomsnittlig Belastning",
    "LAST_MIN" => "Senaste minuten",
    "LAST_5MIN" => "Senaste 5 minuter",
    "LAST_15MIN" => "Senaste 15 minuter",

    // Network Information
    "NET_INFO" => "Nätverksinformation",
    "INTERFACE" => "Gränssnitt",
    "OUTGOING" => "Utgående",
    "INCOMING" => "Inkommande",

    // Disk Information
    "DISK_INFO" => "Diskinformation",
    "FILE_SYSTEM" => "Filsystem",
    "MOUNT_POINT" => "Monteringspunkt",
    "FREE_SPACE" => "Fritt utrymme",
    "USED_SPACE" => "Används utrymme",
    "TOTAL_SPACE" => "Totalt Utrymme",

// SETTINGS PAGE

    "GENERAL_SETTINGS" => "Allmänna inställningar",
    "SETTINGS_DESC" => "Alla ändringar sparas när du klickar på Spara-knappen.",
    "SWMP_LANGUAGE" => "SWMP språk",
    "LANG_DESC" => "Språk kan läggas till i",
    "LANG_FORMAT" => "De måste vara i formatet av", // ie. "They must be in the format of en_GB.php"
    "WINDOW_TITLE" => "Fönster titel",
    "WINDOW_VARS_DESC" => "Variablerna är:", // ie. "Variables are: {hostname}, {ip}, {os} and {kernel}."
    "SHOW_ERRORS" => "Visa fel",
    "SHOW_ERRORS_DESC" => "Aktiverar visning av webbplatsfel.",
    "DEBUG" => "Felsökning",
    "DEBUG_MODE_DESC" => "Gör det möjligt att visa PHP-fel på sidorna.",
    "SITE_THEME" => "Webbplats tema",
    "SITE_THEME_DESC" => "Standard är \"simplex\". <br>Fler teman kan läggas till i", // Don't forget to \escape\ the ""'s!
    "SECS_UNTIL_REFRESH" => "Sekunder tills uppdatering",
    "SECS_UNTIL_REFRESH_DESC" => "Mängden tid (i sekunder) innan sidan uppdateras. <br>(Ställ in på 0 för att inaktivera den. Standard är ", // No need to finish the sentence!

    "HIDE_SHOW_SECT" => "Dölj/Visa sektioner",
    "HIDE_SHOW_SECT_DESC" => "Kontrollera de objekt som du vill visas. (Standard är alla markerade.)",

    "CPU_INFO" => "CPU Info",
    "RAM_INFO" => "RAM Info",
    "SWAP_INFO" => "Swap Info",
    "CPU_1MIN" => "CPU 1 Min",
    "CPU_5MIN" => "CPU 5 Min",
    "CPU_15MIN" => "CPU 15 Min",

    "SAVED" => "Sparad",
    "SAVED_DESC" => "Inställningarna sparades framgångsrikt!<br>SWMP kommer nu att uppdateras...",
    "REFRESH_SWMP" => "Uppdatera SWMP",

// ERRORS

    "THERE_WERE" => "Det fanns", // ie. There were 10 more errors that are currently not shown
    "ERRORS_NOT_SHOWN" => "fler fel som för närvarande inte visas.", // ie. There were 10 more errors that are currently not shown

// FOOTER

    "CREATED_BY" => "Skapad av",
    "FORK_SWMP" => "Fork SWMP på GitHub",
    "SHOW_SUPPORT" => "eller visa ditt stöd via", // ie. "Show your support via PayPal."
);

?>