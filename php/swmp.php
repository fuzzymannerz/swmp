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


require 'php/system.php';

// Get system info
$hostname = getSystemHostname();
$ip = getLanIp();
$cores = getCpuCoresNumber();
$os = getOperatingSystem();
$kernel = getKernel();
$uptime = getUptime();
$bootTime = getBootupTime();

$cpumodel      = getCpuModel();
$cpufrequency  = getCpuFrequency();
$cpucache      = getCpuCacheSize();
$cputemp       = getCpuTemperature();

$cpudata = getCpuLoadData();

$ramdata = getRamInfo();


$swap = getSwapData();
$network = getNetworkData();
$disk = getDiskData();