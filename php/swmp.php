<?php

/*///////////////////////////////////////////////
///                                           ///
///     SWMP - Server Web Monitoring Page     ///
///       By Fuzzy - thefuzz.xyz - 2016       ///
///                                           ///
/////////////////////////////////////////////////
///                                           ///
///    Credits, downloads and usage info:     ///
///    https://github.com/fuzzymannerz/swmp   ///
///                                           ///
////////////////////////////////////////////////////////////
///                                                      ///
///    If you make use of SWMP please consider to        ///
///    show some love via PayPal, Flattr or BTC. <3      ///
///   (Details are on the GitHub page or my website.)    ///
///                                                      ///
//////////////////////////////////////////////////////////*/

// ================  Load settings ================

$config = require "config.php";
if(file_exists('config.local.php')){
    $config = array_merge($config,  require 'config.local.php');
};

//===================================================

require 'php/system.php';

$all_errors = array();

// ================  Get system info ================

$hostname = getSystemHostname($all_errors);
$ip = getLanIp($all_errors);
$cores = getCpuCoresNumber($all_errors);
$os = getOperatingSystem($all_errors);
$kernel = getKernel($all_errors);
$uptime = getUptime($all_errors);
$bootTime = getBootupTime($all_errors);

$cpumodel      = getCpuModel($all_errors);
$cpufrequency  = getCpuFrequency($all_errors);
$cpucache      = getCpuCacheSize($all_errors);
$cputemp       = getCpuTemperature($all_errors);

$cpudata = getCpuLoadData($all_errors);

$ramdata = getRamInfo($all_errors);


$swap = getSwapData($all_errors);
$network = getNetworkData($all_errors);
$disk = getDiskData($all_errors);

//===================================================

// Limit shown errors to max 8

$error_count = count($all_errors);
if ($error_count > 8) {
    $all_errors = array_slice($all_errors, 0, 7);
    $all_errors[] = "There were " . ($error_count - 7) . " more errors that are currently not shown";
}

$wtitle = $config["window_title"];
$wtitle = str_replace("{hostname}", $hostname, $wtitle);
$wtitle = str_replace("{ip}", $ip, $wtitle);
$wtitle = str_replace("{os}", $os, $wtitle);
$wtitle = str_replace("{kernel}", $kernel, $wtitle);

//===================================================

// Allow the user to specify the theme in the address

if ($_GET['theme']) {
    $config['theme'] = $_GET['theme'];
}
