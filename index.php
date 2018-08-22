<!--/////////////////////////////////////////////
///                                           ///
///    SWMP - Server Web Monitoring Page      ///
///         By Fuzzy - 2016 - 2018            ///
///                                           ///
/////////////////////////////////////////////////
///                                           ///
///    Credits, downloads and usage info:     ///
///    https://github.com/fuzzymannerz/swmp   ///
///                                           ///
////////////////////////////////////////////////////////////
///                                                      ///
///    If you make use of SWMP please consider to        ///
///    show some love via PayPal or BTC. <3              ///
///   (Details are on the GitHub page or my website.)    ///
///                                                      ///
/////////////////////////////////////////////////////////-->

<?php
require 'php/swmp.php';
$lang = require_once "lang/" . $config['lang'] . ".php";
include 'php/include/head.php';

?>
    <script src="js/table.js"></script>
    <script>
        var reload = <?php print json_encode($config["reload"]); ?>;
        var cpudata = <?php print json_encode($cpudata); ?>;
        var ramdata = <?php print json_encode($ramdata); ?>;
        var bootupdata = <?php print json_encode($bootTime); ?>;
        var swapdata = <?php print json_encode($swap); ?>;
        var networkdata = <?php print json_encode($network); ?>;
        var diskdata = <?php print json_encode($disk); ?>;
    </script>
</head>

<body>
<div class="container" role="main">

    <div class="container">

        <div class="container page-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 onClick="location.reload();" class="headertitle"><?php echo $wtitle; ?></h2>
                </div>

                <div class="col-md-6">
                    <ul class="nav justify-content-end">
                      <li class="nav-item">
                        <button type="button" class="btn btn-primary" onClick="location.reload();" id="reloadbtn"><i class="fas fa-sync-alt"></i></button>
                      </li>

                      <li class="nav-item">
                        <button type="button" class="btn btn-primary" onClick="window.location.href='settings.php'" id="settingsbtn"><i class="fas fa-cog"></i></button>
                      </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">

            <div class="container">
                <?php
                if ($config["showerrors"]) {
                    foreach ($all_errors as $error) {
                        echo '<div class="alert alert-danger" id="errorNotice" onClick="dismissError();">' . $error . ' </div>' . "\n";
                    }
                }
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if ($config["hostname"] || $config["ip"] || $config["os"] || $config["kernel"] || $config["uptime"] || $config["boottime"] || $config["cpuinfo"] || $config["temp"]){
                            print '<h3>' . $lang['SYS_INFO'] . '</h3>';
                        }

                        ?>
                        <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack">
                            <thead>
                            <tr>
                                <?php

                                if ($config["hostname"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['HOSTNAME'] . '</span></th>';
                                }

                                if ($config["ip"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                            class="label label-default d-block m-x-auto">' . $lang['IP_ADDRESS'] . '</span></th>';
                                }
                                    
                                if ($config["os"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['OS'] . '</span></th>';
                                    }

                                if ($config["kernel"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['KERNEL'] . '</span></th>';
                                    }

                                if ($config["uptime"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['UPTIME'] . '</span></th>';
                                    }

                                 if ($config["boottime"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['BOOT_TIME'] . '</span></th>';
                                    }

                                 if ($config["cpuinfo"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['CPU'] . '</span></th>';
                                    }

                                 if ($config["temp"]){
                                    echo '<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['TEMPERATURE'] . '</span></th>';
                                    }

                                ?>                               
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php

                                if ($config["hostname"]){
                                    echo '<td>' . $hostname . '</td>';}

                                if ($config["ip"]){
                                    echo '<td>' . $ip . '</td>';}

                                if ($config["os"]){
                                    echo '<td>' . $os . '</td>';}

                                if ($config["kernel"]){
                                    echo '<td>' . $kernel . '</td>';}

                                if ($config["uptime"]){
                                    echo '<td>' . $uptime . '</td>';}

                                if ($config["boottime"]){
                                    echo '<td id="bootup"></td>';}

                                if ($config["cpuinfo"]){
                                    echo '<td>' . $cpumodel . '<br>' . $cpufrequency . ' - ' . $cores . ' ' . $lang['CORE'] . '</td>';}

                                if ($config["temp"]){
                                    echo '<td>' . $cputemp . '</td>';}
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                    if ($config["ram"]){
                        echo '<div class="container">
                    <div class="row">
                        <div class="col-sm-7">
                            <h3><span id="rampercent"></span> ' . $lang['RAM_USAGE'] . '</h3>
                            <span class="progress-label">0%</span>
                            <span class="progress-label float-right">100%</span>
                            <div class="progress">
                                <div class="progress-bar ramusedbar" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-sm-5 float-right">
                        <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['USED_RAM'] . '</span></th>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['FREE_RAM'] . '</span></th>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['TOTAL_RAM'] . '</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span id="usedram"></span></td>
                                    <td><span id="freeram"></span></td>
                                    <td><span id="totalram"></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';}


                if ($config["swap"]){
                    echo '<div class="container">
                    <div class="row">
                        <div class="col-sm-7">
                            <h3><span id="swappercent"></span> ' . $lang['SWAP_USAGE'] . '</h3>
                            <span class="progress-label">0%</span>
                            <span class="progress-label float-right">100%</span>
                            <div class="progress">
                                <div class="progress-bar swapusedbar" role="progressbar"></div>
                            </div>
                        </div>
                        <div class="col-sm-5 float-right">
                            <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['USED_SWAP'] . '</span></th>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['FREE_SWAP'] . '</span></th>
                                    <th><span class="label label-default d-block m-x-auto">' . $lang['TOTAL_SWAP'] . '</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><span id="usedswap"></span></td>
                                    <td><span id="freeswap"></span></td>
                                    <td><span id="totalswap"></span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>';}

                ?>
            

            <?php if($config["1min"] || $config["5min"] || $config["15min"]){
                print '<div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>' . $lang['CPU_AVE_LOAD'] . '</h3>
                        <hr>
                    </div>
                </div>
            </div>';
            }
            ?>

                
            <div class="container">
                <div class="row">

                    <?php

                    if ($config["1min"]){
                        echo '<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">' . $lang['LAST_MIN'] . '</h3>
                            </div>
                            <div class="panel-body cpu">
                                <h4 class="middletext"><span id="cpupercent1" class="cpupercent"></span>%</h4>
                                <canvas id="cpu1" class="cpucanvas"></canvas>
                            </div>
                        </div>
                    </div>';
                    }

                    if ($config["5min"]){
                        echo '<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">' . $lang['LAST_5MIN'] . '</h3>
                            </div>
                            <div class="panel-body cpu">
                                <h4 class="middletext"><span id="cpupercent2" class="cpupercent"></span>%</h4>
                                <canvas id="cpu2" class="cpucanvas"></canvas>
                            </div>
                        </div>
                    </div>';
                    }

                    if ($config["15min"]){
                        echo '<div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center">' . $lang['LAST_15MIN'] . '</h3>
                            </div>
                            <div class="panel-body cpu">
                                <h4 class="middletext"><span id="cpupercent3" class="cpupercent"></span>%</h4>
                                <canvas id="cpu3" class="cpucanvas"></canvas>
                            </div>
                        </div>
                    </div>';
                    } ?>

                </div>
            </div>


            <div class="container">
                <div class="row">

                <?php
                if ($config["netinfo"]){
                    echo '<div class="col-md-6">
                        <h3>' . $lang['NET_INFO'] . '</h3>
                        <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack" id="networktable">
                            <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['INTERFACE'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['IP_ADDRESS'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['OUTGOING'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['INCOMING'] . '</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>';
                }


                if ($config["diskinfo"]){
                    echo '<div class="col-md-6">
                        <h3>' . $lang['DISK_INFO'] . '</h3>
                        <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack" id="disktable">
                            <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['FILE_SYSTEM'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['MOUNT_POINT'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['FREE_SPACE'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['USED_SPACE'] . '</span></th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span
                                        class="label label-default d-block m-x-auto">' . $lang['TOTAL_SPACE'] . '</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>';
                }

                ?>

                </div>
            </div>

                <?php include 'php/include/footer.php'; ?>
            </div>
        </div>
    </div>
    </div> <!-- /container -->

<script src="js/gauge.js"></script>
<script src="js/swmp.js"></script>
</body>
</html>