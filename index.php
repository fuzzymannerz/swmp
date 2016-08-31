<!--/////////////////////////////////////////////
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
/////////////////////////////////////////////////////////-->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Server Web Monitor Page">
    <meta name="author" content="Fuzzy">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#4b4b4b">
	<meta name="theme-color" content="#ffffff">
    <title>SWMP | <?php echo php_uname('n'); ?></title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

    <!-- *********************************************************************** -->

    <!-- Change "simplex" to one of the themes in css/themes to change the theme -->
             <!-- You can see what they look like at bootswatch.com -->
          <link href="css/themes/simplex.css" rel="stylesheet" id="themestyle">

    <!-- *********************************************************************** -->


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   	<link rel="stylesheet" href="css/tablesaw.css">
   	<script src="js/table.js"></script>
  <?php require 'php/system.php';?>
  </head>
  <body>
    <div class="container" role="main">

<div class="container">
    <div class="row">
        <div class="page-header">
              <button type="button" class="btn btn-primary pull-right" onClick="location.reload();">Reload</button>
              <h2 onClick="location.reload();" class="headertitle">SWMP | <?php echo $hostname; ?></h2>
        </div>

<div class="container">
      <div class="row">
        <div class="col-md-12">
        	<h3>System Information</h3>
          <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack">
            <thead>
              <tr>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Hostname</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">IP Address</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">OS</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Kernel</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Uptime</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Boot Time</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">CPU</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Temperature</span></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $hostname; ?></td>
                <td><?php echo $ip; ?></td>
                <td><?php echo $os; ?></td>
                <td><?php echo $kernel; ?></td>
                <td><?php echo $uptime; ?></td>
                <td id="bootup"></td>
                <td><?php echo $cpumodel.'<br>'.$cpufrequency.' - '.$cores.' Cores'; ?></td>
                <td><?php echo $cputemp; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        </div>

<div class="container">
      <div class="row">
          <div class="col-sm-7">
          	<h3><span id="rampercent"></span> RAM Usage</h3>
          <span class="progress-label">0%</span>
          <span class="progress-label pull-right">100%</span>
                <div class="progress">
                <div class="progress-bar ramusedbar" role="progressbar"></div>
                </div>
            </div>
            <div class="col-sm-5 pull-right">
            <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th><span class="label label-default center-block">Used RAM</span></th>
                        <th><span class="label label-default center-block">Free RAM</span></th>
                        <th><span class="label label-default center-block">Total RAM</span></th>
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
</div>

<div class="container">
      <div class="row">
          <div class="col-sm-7">
          	<h3><span id="swappercent"></span> Swap Usage</h3>
          <span class="progress-label">0%</span>
          <span class="progress-label pull-right">100%</span>
                <div class="progress">
                <div class="progress-bar swapusedbar" role="progressbar"></div>
                </div>
            </div>
            <div class="col-sm-5 pull-right">
            <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                  <table class="table">
                    <thead>
                      <tr>
                        <th><span class="label label-default center-block">Used Swap</span></th>
                        <th><span class="label label-default center-block">Free Swap</span></th>
                        <th><span class="label label-default center-block">Total Swap</span></th>
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
</div>

        <div class="row">
                <div class="col-sm-4">
                	<h3>CPU Average Load</h3>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Last Sixty Seconds</h3>
                    </div>
                    <div class="panel-body cpu">
                      <h4 class="middletext"><span id="cpupercent1" class="cpupercent"></span>%</h4>
                      <canvas id="cpu1" class="cpucanvas"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Last Five Minutes</h3>
                    </div>
                    <div class="panel-body cpu">
                      <h4 class="middletext"><span id="cpupercent2" class="cpupercent"></span>%</h4>
                      <canvas id="cpu2" class="cpucanvas"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                <h3>&nbsp;</h3><!-- H3 - Fix for alignment -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Last 15 Minutes</h3>
                    </div>
                    <div class="panel-body cpu">
                      <h4 class="middletext"><span id="cpupercent3" class="cpupercent"></span>%</h4>
                      <canvas id="cpu3" class="cpucanvas"></canvas>
                    </div>
                  </div>
                </div>
        </div>


      <div class="row">
        <div class="col-md-6">
        	<h3>Network Information</h3>
            <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack" id="networktable">
            <thead>
              <tr>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Interface</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">IP Address</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Outgoing</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Incoming</span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>


        <div class="col-md-6">
         	<h3>Disk Information</h3>
            <table class="table tablesaw tablesaw-stack" data-tablesaw-mode="stack" id="disktable">
            <thead>
              <tr>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">File System</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Mount Point</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Free Space</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Used Space</span></th>
                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist"><span class="label label-default center-block">Total Space</span></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
      </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"><a href="https://github.com/fuzzymannerz/swmp" target="_blank">SWMP</a> Created By <a href="https://thefuzz.xyz" target="_blank">Fuzzy</a> - 2016<br>
        Why not <a href="https://github.com/fuzzymannerz/swmp" target="_blank">Fork SWMP on GitHub</a> or show your support via <a href="https://paypal.me/fuzzymannerz" target="_blank">PayPal</a> or <a href="https://flattr.com/submit/auto?fid=rok0q2&url=https%3A%2F%2Fgithub.com%2Ffuzzymannerz%2Fswmp" target="_blank">Flattr</a>.</p>
      </div>
    </footer>
</div>
    </div>
    </div> <!-- /container -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/gauge.js"></script>
    <script src="js/swmp.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
