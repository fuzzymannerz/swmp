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


// Include the class
require 'class.php';

// Set some variables
$hostname = mainclass::getHostname();
$ip = mainclass::getLanIp();
$cores = mainclass::getCpuCoresNumber();


/////////////////////////////
///      OS  RELATED      ///
/////////////////////////////

// Operating System
if (!($os = shell_exec('/usr/bin/lsb_release -ds | cut -d= -f2 | tr -d \'"\'')))
{
    if (!($os = shell_exec('cat /etc/system-release | cut -d= -f2 | tr -d \'"\'')))
    {
        if (!($os = shell_exec('cat /etc/os-release | grep PRETTY_NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\'')))
        {
            if (!($os = shell_exec('find /etc/*-release -type f -exec cat {} \; | grep PRETTY_NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\'')))
            {
                $os = 'N/A';
            }
        }
    }
}
$os = trim($os, '"');
$os = str_replace("\n", '', $os);

// Kernel
if (!($kernel = shell_exec('/bin/uname -r')))
{
    $kernel = 'N/A';
}

// Uptime
if (!($totalSeconds = shell_exec('/usr/bin/cut -d. -f1 /proc/uptime')))
{
    $uptime = 'N/A';
}
else
{
    $uptime = mainclass::getHumanTime($totalSeconds);
}


/////////////////////////////
///      CPU RELATED      ///
/////////////////////////////

$cpumodel      = 'N/A';
$cpufrequency  = 'N/A';
$cpucache      = 'N/A';
$cputemp       = 'N/A';

if ($cpuinfo = shell_exec('cat /proc/cpuinfo'))
{
    $processors = preg_split('/\s?\n\s?\n/', trim($cpuinfo));

    foreach ($processors as $processor)
    {
        $details = preg_split('/\n/', $processor, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($details as $detail)
        {
            list($key, $value) = preg_split('/\s*:\s*/', trim($detail));

            switch (strtolower($key))
            {
                case 'model name':
                case 'cpu model':
                case 'cpu':
                case 'processor':
                    $cpumodel = $value;
                break;

                case 'cpu mhz':
                case 'clock':
                    $cpufrequency = $value.' MHz';
                break;

                case 'cache size':
                case 'l2 cache':
                    $cpucache = $value;
                break;
            }
        }
    }
}

// Frequency
if ($cpufrequency == 'N/A')
{
    if ($f = shell_exec('cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq'))
    {
        $f = $f / 1000;
        $cpufrequency = $f.' MHz';
    }
}


// CPU Temp
    if (exec('/usr/bin/sensors | grep -E "^(CPU Temp|Core 0)" | cut -d \'+\' -f2 | cut -d \'.\' -f1', $t))
    {
        if (isset($t[0]))
            $cputemp = $t[0].' °c';
    }
    else
    {
        if (exec('cat /sys/class/thermal/thermal_zone0/temp', $t))
        {
            $cputemp = round($t[0] / 1000).' °C';
        }
    }


$datas = array(
    'model'      => $cpumodel,
    'frequency'  => $cpufrequency,
    'cache'      => $cpucache,
    'temp'       => $cputemp,
);


// CPU Load Averages
function cpuloads()
{
	if (!($load_tmp = shell_exec('cat /proc/loadavg | awk \'{print $1","$2","$3}\'')))
	{
	    $cpuloaddata = array(0, 0, 0);
	}
	else
	{
	    // Number of cores
	    $cores = mainclass::getCpuCoresNumber();

	    $load_exp = explode(',', $load_tmp);

	    $cpuloaddata = array_map(
	        function ($value, $cores) {
	            $v = (int)($value * 100 / $cores);
	            if ($v > 100)
	                $v = 100;
	            return $v;
	        }, 
	        $load_exp,
	        array_fill(0, 3, $cores)
	    );
	}

    return json_encode($cpuloaddata);
}

// Set CPU load variable
$cpudata = cpuloads();


/////////////////////////////
///      RAM RELATED      ///
///////////////////////////// 

function raminfo(){

    $free = 0;

    if (shell_exec('cat /proc/meminfo'))
    {
        $free    = shell_exec('grep MemFree /proc/meminfo | awk \'{print $2}\'');
        $buffers = shell_exec('grep Buffers /proc/meminfo | awk \'{print $2}\'');
        $cached  = shell_exec('grep Cached /proc/meminfo | awk \'{print $2}\'');

        $free = (int)$free + (int)$buffers + (int)$cached;
    }

    // Total
    if (!($total = shell_exec('grep MemTotal /proc/meminfo | awk \'{print $2}\'')))
    {
        $total = 0;
    }

    // Used
    $used = $total - $free;

    // Percent used
    $percent_used = 0;
    if ($total > 0)
        $percent_used = 100 - (round($free / $total * 100));


    $ramdata = array(
        'used'          => mainclass::getSize($used * 1024),
        'free'          => mainclass::getSize($free * 1024),
        'total'         => mainclass::getSize($total * 1024),
        'percent_used'  => $percent_used,
    );

    return json_encode($ramdata);
}

// Set RAM data variable
$ramdata = raminfo();


/////////////////////////////
///      BOOTUP TIME      ///
///////////////////////////// 

function bootup(){
    if (!($upt_tmp = shell_exec('cat /proc/uptime')))
    {
        $last_boot = 'N/A';
    }
    else
    {
        $upt = explode(' ', $upt_tmp);
        $last_boot = date('Y-m-d H:i:s', time() - intval($upt[0]));
    }
    $bootTime = array(
        'last_boot'     => $last_boot
    );

    return json_encode($bootTime);
}

// Set bootup variable
$bootTime = bootup();


//////////////////////////////
///      SWAP RELATED      ///
////////////////////////////// 

function swap(){

    // Free
    if (!($free = shell_exec('grep SwapFree /proc/meminfo | awk \'{print $2}\'')))
    {
        $free = 0;
    }

    // Total
    if (!($total = shell_exec('grep SwapTotal /proc/meminfo | awk \'{print $2}\'')))
    {
        $total = 0;
    }

    // Used
    $used = $total - $free;

    // Percent used
    $percent_used = 0;
    if ($total > 0)
        $percent_used = 100 - (round($free / $total * 100));


    $datas = array(
        'used'          => mainclass::getSize($used * 1024),
        'free'          => mainclass::getSize($free * 1024),
        'total'         => mainclass::getSize($total * 1024),
        'percent_used'  => $percent_used,
    );

    return json_encode($datas);
}

// Set swap variable
$swap = swap();


//////////////////////////////
///     NETWORK RELATED    ///
////////////////////////////// 

function network(){
    $datas    = array();
    $network  = array();

    // Possible commands for ifconfig and ip
    $commands = array(
        'ifconfig' => array('ifconfig', '/sbin/ifconfig', '/usr/bin/ifconfig', '/usr/sbin/ifconfig'),
        'ip'       => array('ip', '/bin/ip', '/sbin/ip', '/usr/bin/ip', '/usr/sbin/ip'),
    );

    // Returns command line for retrieving interfaces
    function getInterfacesCommand($commands)
    {
        $ifconfig = mainclass::whichCommand($commands['ifconfig'], ' | awk -F \'[/  |: ]\' \'{print $1}\' | sed -e \'/^$/d\'');

        if (!empty($ifconfig))
        {
            return $ifconfig;
        }
        else
        {
            $ip_cmd = mainclass::whichCommand($commands['ip'], ' -V', false);

            if (!empty($ip_cmd))
            {
                return $ip_cmd.' -oneline link show | awk \'{print $2}\' | sed "s/://"';
            }
            else
            {
                return null;
            }
        }
    }

    // Returns command line for retrieving IP addresses from interfaces
    function getIpCommand($commands, $interface)
    {
        $ifconfig = mainclass::whichCommand($commands['ifconfig'], ' '.$interface.' | awk \'/inet / {print $2}\' | cut -d \':\' -f2');

        if (!empty($ifconfig))
        {
            return $ifconfig;
        }
        else
        {
            $ip_cmd = mainclass::whichCommand($commands['ip'], ' -V', false);

            if (!empty($ip_cmd))
            {
                return 'for family in inet inet6; do '.
                   $ip_cmd.' -oneline -family $family addr show '.$interface.' | grep -v fe80 | awk \'{print $4}\' | sed "s/\/.*//"; ' .
                'done';
            }
            else
            {
                return null;
            }
        }
    }


    $getInterfaces_cmd = getInterfacesCommand($commands);

    if (is_null($getInterfaces_cmd) || !(exec($getInterfaces_cmd, $getInterfaces)))
    {
        $datas[] = array('interface' => 'N/A', 'ip' => 'N/A');
    }
    else
    {
        foreach ($getInterfaces as $name)
        {
            $ip = null;

            $getIp_cmd = getIpCommand($commands, $name);        

            if (is_null($getIp_cmd) || !(exec($getIp_cmd, $ip)))
            {
                $network[] = array(
                    'name' => $name,
                    'ip'   => 'N/A',
                );
            }
            else
            {
                if (!isset($ip[0]))
                    $ip[0] = '';

                $network[] = array(
                    'name' => $name,
                    'ip'   => $ip[0],
                );
            }
        }

        foreach ($network as $interface)
        {
            // Get transmit and receive datas by interface
            exec('cat /sys/class/net/'.$interface['name'].'/statistics/tx_bytes', $getBandwidth_tx);
            exec('cat /sys/class/net/'.$interface['name'].'/statistics/rx_bytes', $getBandwidth_rx);

            $datas[] = array(
                'interface' => $interface['name'],
                'ip'        => $interface['ip'],
                'transmit'  => mainclass::getSize($getBandwidth_tx[0]),
                'receive'   => mainclass::getSize($getBandwidth_rx[0]),
            );

            unset($getBandwidth_tx, $getBandwidth_rx);
        }
    }


    return json_encode($datas);
}

// Set network variable
$network = network();


//////////////////////////////
///      DISK RELATED      ///
//////////////////////////////

function disk(){
    $datas = array();

    if (!(exec('/bin/df -T | awk -v c=`/bin/df -T | grep -bo "Type" | awk -F: \'{print $2}\'` \'{print substr($0,c);}\' | tail -n +2 | awk \'{print $1","$2","$3","$4","$5","$6","$7}\'', $df)))
    {
        $datas[] = array(
            'total'         => 'N/A',
            'used'          => 'N/A',
            'free'          => 'N/A',
            'percent_used'  => 0,
            'mount'         => 'N/A',
            'filesystem'    => 'N/A',
        );
    }
    else
    {
        $mounted_points = array();
        $key = 0;

        foreach ($df as $mounted)
        {
            list($filesystem, $type, $total, $used, $free, $percent, $mount) = explode(',', $mounted);

            if (strpos($type, 'tmpfs') !== false)
                continue;

            if (!in_array($mount, $mounted_points))
            {
                $mounted_points[] = trim($mount);

                $datas[$key] = array(
                    'total'         => mainclass::getSize($total * 1024),
                    'used'          => mainclass::getSize($used * 1024),
                    'free'          => mainclass::getSize($free * 1024),
                    'percent_used'  => trim($percent, '%'),
                    'mount'         => $mount,
                );

                    $datas[$key]['filesystem'] = $filesystem;
            }

            $key++;
        }

    }


    return json_encode($datas);
}

// Set disk variable
$disk = disk();


?>

<!-- Set the variables for the javascript files -->
<script>
    var cpudata = <?php print json_encode($cpudata); ?>;
    var ramdata = <?php print json_encode($ramdata); ?>;
    var bootupdata = <?php print json_encode($bootTime); ?>;
    var swapdata = <?php print json_encode($swap); ?>;
    var networkdata = <?php print json_encode($network); ?>;
    var diskdata = <?php print json_encode($disk); ?>;
</script>
