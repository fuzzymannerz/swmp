<?php

/**
 * Returns human size
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @param  float $filesize   File size
 * @param  int   $precision  Number of decimals
 * @return string            Human size
 */
function getSize($filesize, $precision = 2)
{
    $units = array('', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');

    foreach ($units as $idUnit => $unit)
    {
        if ($filesize > 1024)
            $filesize /= 1024;
        else
            break;
    }

    return round($filesize, $precision).' '.$units[$idUnit].'B';
}

/**
 * Returns a command that exists in the system among $cmds
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @param  array  $cmds             List of commands
 * @param  string $args             List of arguments (optional)
 * @param  bool   $returnWithArgs   If true, returns command with the arguments
 * @return string                   Command
 */
function whichCommand($cmds, $args = '', $returnWithArgs = true)
{
    $return = '';

    foreach ($cmds as $cmd)
    {
        if (trim(shell_exec($cmd.$args)) != '')
        {
            $return = $cmd;

            if ($returnWithArgs)
                $return .= $args;

            break;
        }
    }

    return $return;
}


/**
 * Seconds to human readable text
 * Eg: for 36545627 seconds => 1 year, 57 days, 23 hours and 33 minutes
 * Lifted from github.com/shevabam/ezservermonitor-web
 *
 * @return string Text
 */
function getHumanTime($seconds)
{
    $seconds = intval($seconds);

    $units = array(
        'year'   => 365*86400,
        'day'    => 86400,
        'hour'   => 3600,
        'minute' => 60,
        // 'second' => 1,
    );

    $parts = array();

    foreach ($units as $name => $divisor)
    {
        $div = floor($seconds / $divisor);

        if ($div == 0)
            continue;
        else
            if ($div == 1)
                $parts[] = $div.' '.$name;
            else
                $parts[] = $div.' '.$name.'s';
        $seconds %= $divisor;
    }

    $last = array_pop($parts);

    if (empty($parts))
        return $last;
    else
        return join(', ', $parts).' and '.$last;
}