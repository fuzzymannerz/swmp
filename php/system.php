<?php

require 'php/utils.php';

/**
 * Returns hostname
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @param array $errors errors in this function are written to this array
 * @return string Hostname
 */
function getSystemHostname(&$errors)
{
    return php_uname('n');
}

/**
 * Returns server IP
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @param array $errors errors in this function are written to this array
 * @return string Server local IP
 */
function getLanIp(&$errors)
{
    if (isset($_SERVER['SERVER_ADDR'])) {
        return $_SERVER['SERVER_ADDR'];
    } else if (isset($_SERVER['HTTP_HOST'])) {
        return $_SERVER['HTTP_HOST'];
    } else {
        array_push($errors, "Cannot get Server IP: [SERVER_ADDR] and [HTTP_HOST] are unset");
        return "N/A";
    }
}

/**
 * Returns CPU cores number
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @param array $errors errors in this function are written to this array
 * @return  int  Number of cores
 */
function getCpuCoresNumber(&$errors)
{
    if (!($num_cores = shell_exec('/bin/grep -c ^processor /proc/cpuinfo'))) {
        if (!($num_cores = trim(shell_exec('/usr/bin/nproc')))) {
            $num_cores = 1;

            array_push($errors, "Cannot get number of server CPU cores");
        }
    }

    if ((int)$num_cores <= 0) {
        array_push($errors, "Number of server CPU cores is <= 0");

        $num_cores = 1;
    }

    return (int)$num_cores;
}

/**
 * Returns the operating system
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  name of OS
 */
function getOperatingSystem(&$errors)
{
    if (!($os = shell_exec('/usr/bin/lsb_release -ds | cut -d= -f2 | tr -d \'"\''))) {
        if (!($os = shell_exec('cat /etc/system-release | cut -d= -f2 | tr -d \'"\''))) {
            if (!($os = shell_exec('cat /etc/os-release | grep PRETTY_NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\''))) {
                if (!($os = shell_exec('find /etc/*-release -type f -exec cat {} \; | grep PRETTY_NAME | tail -n 1 | cut -d= -f2 | tr -d \'"\''))) {
                    $os = 'N/A';

                    array_push($errors, "Name of operating system could not be determined");
                }
            }
        }
    }
    $os = trim($os, '"');
    $os = str_replace("\n", '', $os);

    return $os;
}

/**
 * Returns the kernel name
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  name of the kernel
 */
function getKernel(&$errors)
{
    if (!($kernel = shell_exec('/bin/uname -r'))) {
        $kernel = 'N/A';

        array_push($errors, "Name of kernel could not be determined");
    }

    return $kernel;
}

/**
 * Returns the current uptime in human readable format
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  the current uptime
 */
function getUptime(&$errors)
{
    if (!($totalSeconds = shell_exec('/usr/bin/cut -d. -f1 /proc/uptime'))) {
        $uptime = 'N/A';

        array_push($errors, "uptime could not be determined");
    } else {
        $uptime = getHumanTime($totalSeconds);
    }

    return $uptime;
}

/**
 * Returns the model of the first CPU
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  the cpu model
 */
function getCpuModel(&$errors)
{
    $result = "N/A";

    if ($cpuinfo = shell_exec('cat /proc/cpuinfo')) {
        $processors = preg_split('/\s?\n\s?\n/', trim($cpuinfo));

        foreach ($processors as $processor) {
            $details = preg_split('/\n/', $processor, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($details as $detail) {
                list($key, $value) = preg_split('/\s*:\s*/', trim($detail));

                switch (strtolower($key)) {
                    case 'model name':
                    case 'cpu model':
                    case 'cpu':
                    case 'processor':
                        $result = $value;
                }
            }
        }

        if ($result === "N/A") {
            array_push($errors, "CPU model could not be determined: output could not be parsed");
        }
    } else {
        array_push($errors, "CPU model could not be determined: command failed");
    }

    return $result;
}

/**
 * Returns the frequency of the first CPU
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  the cpu frequency
 */
function getCpuFrequency(&$errors)
{
    $result = "N/A";

    if ($cpuinfo = shell_exec('cat /proc/cpuinfo')) {
        $processors = preg_split('/\s?\n\s?\n/', trim($cpuinfo));

        foreach ($processors as $processor) {
            $details = preg_split('/\n/', $processor, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($details as $detail) {
                list($key, $value) = preg_split('/\s*:\s*/', trim($detail));

                switch (strtolower($key)) {
                    case 'cpu mhz':
                    case 'clock':
                        $result = $value . ' MHz';
                }
            }
        }
    }


    if ($result === "N/A") {
        // previous method failed
        if ($f = shell_exec('cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_max_freq')) {
            $f = $f / 1000;
            $result = $f . ' MHz';
        } else {
            array_push($errors, "CPU frequency could not be determined");
        }
    }

    return $result;
}

/**
 * Returns the cache size of the first CPU
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  the cpu cache size
 */
function getCpuCacheSize(&$errors)
{
    $result = "N/A";

    if ($cpuinfo = shell_exec('cat /proc/cpuinfo')) {
        $processors = preg_split('/\s?\n\s?\n/', trim($cpuinfo));

        foreach ($processors as $processor) {
            $details = preg_split('/\n/', $processor, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($details as $detail) {
                list($key, $value) = preg_split('/\s*:\s*/', trim($detail));

                switch (strtolower($key)) {
                    case 'cache size':
                    case 'l2 cache':
                        $result = $value;
                }
            }
        }

        if ($result === "N/A") {
            array_push($errors, "CPU cache size could not be determined: output could not be parsed");
        }
    } else {
        array_push($errors, "CPU cache size could not be determined: command failed");
    }

    return $result;
}

/**
 * Returns the temperature of the first CPU
 *
 * @param array $errors errors in this function are written to this array
 * @return  string  the cpu temperature
 */
function getCpuTemperature(&$errors)
{
    if (exec('/usr/bin/sensors | grep -E "^(CPU Temp|Core 0)" | cut -d \'+\' -f2 | cut -d \'.\' -f1', $t)) {
        if (isset($t[0]))
            return $t[0] . ' °c';
    } else {
        if (exec('cat /sys/class/thermal/thermal_zone0/temp', $t)) {
            return round($t[0] / 1000) . ' °C';
        }
    }

    array_push($errors, "CPU temperature could not be determined");

    return "N/A";
}

/**
 * Returns the load data of the CPU
 *
 * @param array $errors errors in this function are written to this array
 * @return  array  the cpu load data
 */
function getCpuLoadData(&$errors)
{
    if (!($load_tmp = shell_exec('cat /proc/loadavg | awk \'{print $1","$2","$3}\''))) {
        $cpuloaddata = array(0, 0, 0);

        array_push($errors, "CPU load data could not be determined");
    } else {
        // Number of cores
        $cores = getCpuCoresNumber($errors);

        $load_exp = explode(',', $load_tmp);

        $cpuloaddata = array_map(
            function ($value, $cores) {
                $value = floatval($value);
                $cores = intval($cores);

                $v = (int)($value * 100 / $cores);
                if ($v > 100)
                    $v = 100;
                return $v;
            },
            $load_exp,
            array_fill(0, 3, $cores)
        );
    }

    return $cpuloaddata;
}

/**
 * Returns the various data about the RAM
 *
 * @return  array  the ram data
 */
function getRamInfo(&$errors)
{
    $free = 0;

    if (shell_exec('cat /proc/meminfo')) {
        $free = shell_exec('grep MemFree /proc/meminfo | awk \'{print $2}\'');
        $buffers = shell_exec('grep Buffers /proc/meminfo | awk \'{print $2}\'');
        $cached = shell_exec('grep Cached /proc/meminfo | awk \'{print $2}\'');

        $free = (int)$free + (int)$buffers + (int)$cached;
    } else {
        array_push($errors, "Could not read RAM data: free memory");
    }

    // Total
    if (!($total = shell_exec('grep MemTotal /proc/meminfo | awk \'{print $2}\''))) {
        $total = 0;

        array_push($errors, "Could not read RAM data: total memory");
    }

    $total = floatval($total);
    $free = floatval($free);

    // Used
    $used = $total - $free;

    // Percent used
    $percent_used = 0;
    if ($total > 0)
        $percent_used = 100 - (round($free / $total * 100));


    $ramdata = array(
        'used' => getSize($used * 1024),
        'free' => getSize($free * 1024),
        'total' => getSize($total * 1024),
        'percent_used' => $percent_used,
    );

    return $ramdata;
}

/**
 * Returns the boot up time
 *
 * @param array $errors errors in this function are written to this array
 * @return  array  the time since last boot
 */
function getBootupTime(&$errors)
{
    if (!($upt_tmp = shell_exec('cat /proc/uptime'))) {
        array_push($errors, "Could not read date of last boot");

        $last_boot = 'N/A';
    } else {
        $upt = explode(' ', $upt_tmp);
        $last_boot = date('Y-m-d H:i:s', time() - intval($upt[0]));
    }

    return array('last_boot' => $last_boot);
}

/**
 * Returns the data about the system swap space
 *
 * @param array $errors errors in this function are written to this array
 * @return  array  the swap data
 */
function getSwapData(&$errors)
{

    // Free
    if (!($free = shell_exec('grep SwapFree /proc/meminfo | awk \'{print $2}\''))) {
        array_push($errors, "Could not read swap data: free swap");

        $free = 0;
    }

    // Total
    if (!($total = shell_exec('grep SwapTotal /proc/meminfo | awk \'{print $2}\''))) {
        array_push($errors, "Could not read swap data: total swap");

        $total = 0;
    }

    $total = floatval($total);
    $free = floatval($total);

    // Used
    $used = $total - $free;

    // Percent used
    $percent_used = 0;
    if ($total > 0)
        $percent_used = 100 - (round($free / $total * 100));

    return array(
        'used' => getSize($used * 1024),
        'free' => getSize($free * 1024),
        'total' => getSize($total * 1024),
        'percent_used' => $percent_used,
    );;
}

/**
 * Returns the data about the network usage
 *
 * @param array $errors errors in this function are written to this array
 * @return  array  the network data
 */
function getNetworkData(&$errors)
{
    $datas = array();
    $network = array();

    // Possible commands for ifconfig and ip
    $commands = array(
        'ifconfig' => array('ifconfig', '/sbin/ifconfig', '/usr/bin/ifconfig', '/usr/sbin/ifconfig'),
        'ip' => array('ip', '/bin/ip', '/sbin/ip', '/usr/bin/ip', '/usr/sbin/ip'),
    );

    // Returns command line for retrieving interfaces
    function getInterfacesCommand($commands)
    {
        $ifconfig = whichCommand($commands['ifconfig'], ' | awk -F \'[/  |: ]\' \'{print $1}\' | sed -e \'/^$/d\'');

        if (!empty($ifconfig)) {
            return $ifconfig;
        } else {
            $ip_cmd = whichCommand($commands['ip'], ' -V', false);

            if (!empty($ip_cmd)) {
                return $ip_cmd . ' -oneline link show | awk \'{print $2}\' | sed "s/://"';
            } else {
                return null;
            }
        }
    }

    // Returns command line for retrieving IP addresses from interfaces
    function getIpCommand($commands, $interface)
    {
        $ifconfig = whichCommand($commands['ifconfig'], ' ' . $interface . ' | awk \'/inet / {print $2}\' | cut -d \':\' -f2');

        if (!empty($ifconfig)) {
            return $ifconfig;
        } else {
            $ip_cmd = whichCommand($commands['ip'], ' -V', false);

            if (!empty($ip_cmd)) {
                return 'for family in inet inet6; do ' .
                $ip_cmd . ' -oneline -family $family addr show ' . $interface . ' | grep -v fe80 | awk \'{print $4}\' | sed "s/\/.*//"; ' .
                'done';
            } else {
                return null;
            }
        }
    }

    $getInterfaces_cmd = getInterfacesCommand($commands);

    if (is_null($getInterfaces_cmd) || !(exec($getInterfaces_cmd, $getInterfaces))) {
        $datas[] = array('interface' => 'N/A', 'ip' => 'N/A');

        array_push($errors, "Could not get network data: getInterfacesCommand() failed");
    } else {
        foreach ($getInterfaces as $name) {
            $ip = null;

            $getIp_cmd = getIpCommand($commands, $name);

            if (is_null($getIp_cmd) || !(exec($getIp_cmd, $ip))) {
                $network[] = array(
                    'name' => $name,
                    'ip' => 'N/A',
                );

                array_push($errors, "Could not get network data: getIpCommand() failed for " . $name);
            } else {
                if (!isset($ip[0]))
                    $ip[0] = '';

                $network[] = array(
                    'name' => $name,
                    'ip' => $ip[0],
                );
            }
        }

        foreach ($network as $interface) {
            // Get transmit and receive datas by interface
            exec('cat /sys/class/net/' . $interface['name'] . '/statistics/tx_bytes', $getBandwidth_tx);
            exec('cat /sys/class/net/' . $interface['name'] . '/statistics/rx_bytes', $getBandwidth_rx);

            $datas[] = array(
                'interface' => $interface['name'],
                'ip' => $interface['ip'],
                'transmit' => getSize($getBandwidth_tx[0]),
                'receive' => getSize($getBandwidth_rx[0]),
            );

            unset($getBandwidth_tx, $getBandwidth_rx);
        }
    }


    return $datas;
}

/**
 * Returns the data about the disk usage
 *
 * @param array $errors errors in this function are written to this array
 * @return  array  the disk data
 */
function getDiskData(&$errors)
{
    $datas = array();

    if (!(exec('/bin/df -T | awk -v c=`/bin/df -T | grep -bo "Type" | awk -F: \'{print $2}\'` \'{print substr($0,c);}\' | tail -n +2 | awk \'{print $1","$2","$3","$4","$5","$6","$7}\'', $df))) {
        $datas[] = array(
            'total' => 'N/A',
            'used' => 'N/A',
            'free' => 'N/A',
            'percent_used' => 0,
            'mount' => 'N/A',
            'filesystem' => 'N/A',
        );

        array_push($errors, "Could not get disk data");
    } else {
        $mounted_points = array();
        $key = 0;

        foreach ($df as $mounted) {
            list($filesystem, $type, $total, $used, $free, $percent, $mount) = explode(',', $mounted);

            if (strpos($type, 'tmpfs') !== false)
                continue;

            if (!in_array($mount, $mounted_points)) {
                $mounted_points[] = trim($mount);

                $datas[$key] = array(
                    'total' => getSize($total * 1024),
                    'used' => getSize($used * 1024),
                    'free' => getSize($free * 1024),
                    'percent_used' => trim($percent, '%'),
                    'mount' => $mount,
                );

                $datas[$key]['filesystem'] = $filesystem;
            }

            $key++;
        }

    }


    return $datas;
}