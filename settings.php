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
   $config = require "config.php";
   $lang = require_once "lang/" . $config['lang'] . ".php";
   $wtitle = "SWMP | " . $lang['SETTINGS'];
   include "php/include/head.php";
   ?>
<link rel="stylesheet" type="text/css" href="css/abc.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

</head>
<body>
   <div class="container" role="main">
      <form id="settingsForm" name="settingsForm" method="POST" action="php/configurator.php">
         <input type="hidden" name="settingsData" value="ok">
         <div class="container">
            <div class="container page-header">
               <div class="row">
                  <div class="col-md-6">
                     <h2 onClick="location.reload();" class="headertitle">SWMP | <?php print $lang['SETTINGS']; ?></h2>
                  </div>
                  <div class="col-md-6">
                     <ul class="nav justify-content-end">
                        <li class="nav-item">
                           <button name="submit" type="submit" class="btn btn-primary" id="savesettingsbtn"><i class="fas fa-check"></i> <?php print $lang['SAVE_SETTINGS']; ?></button>
                        </li>
                        <li class="nav-item">
                           <button type="button" class="btn btn-primary" onClick="window.location.href='index.php'" id="cancelsettingsbtn"><i class="fas fa-times"></i> <?php print $lang['GO_BACK']; ?></button>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6">
                           <h2><?php print $lang['GENERAL_SETTINGS']; ?></h2>
                           <p><?php print $lang['SETTINGS_DESC']; ?></p>
                           <hr>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="language">
                                 <h4><?php print $lang['SWMP_LANGUAGE']; ?></h4>
                              </label>
                              <select class="form-control selectpicker" id="language" name="language">
                              <?php
                                 $currentLang = $config['lang'];
                                 $files = glob('lang/*_*.{php}', GLOB_BRACE);
                                 $files = str_replace(".php","",$files);
                                 $files = str_replace("lang/","",$files);
                                 foreach($files as $langOption) {
                                   if ($langOption == $currentLang){
                                     echo '<option selected>' . $langOption . '</option>';
                                   }else{
                                     echo '<option>' . $langOption . '</option>';
                                   }
                                 }
                                 ?>
                              </select>
                              <small class="form-text text-muted">
                              <?php print $lang['LANG_DESC']; ?> <code>lang/</code>.<br>
                              (<?php print $lang['LANG_FORMAT']; ?> <code>en_GB.php</code>)</small>
                           </div>

                           <div class="form-group">
                              <h4><?php print $lang['WINDOW_TITLE']; ?></h4>
                              <input type="text" class="form-control" id="windowTitle" name="windowTitle" value="<?php print $config['windowtitle']; ?>">
                              <small class="form-text text-muted">
                              <?php print $lang['WINDOW_VARS_DESC']; ?> <code>{hostname}</code>, <code>{ip}</code>, <code>{os}</code> & <code>{kernel}</code>.
                              </small>
                           </div>

                           <div class="form-group">
                              <label for="refreshtime"><h4><?php print $lang['SECS_UNTIL_REFRESH']; ?></h4></label>
                              <input type="text" class="form-control" id="refreshtime" name="refreshtime" value="<?php print $config['reload']; ?>">
                              <small class="form-text text-muted">
                              <?php print $lang['SECS_UNTIL_REFRESH_DESC']; ?> <code>60</code>.)
                              </small>
                            </div>
                           
                           
                        </div>
                        <div class="col-md-6">

                          <div class="form-group">
                              <label for="themeSelect">
                                 <h4><?php print $lang['SITE_THEME']; ?></h4>
                              </label>
                              <select class="form-control selectpicker" id="themeSelect" name="themeSelect">
                              <?php
                                 $currentTheme = $config['theme'];
                                 $files = glob('css/themes/*.{css}', GLOB_BRACE);
                                 $files = str_replace(".css","",$files);
                                 $files = str_replace("css/themes/","",$files);
                                 foreach($files as $themeCSS) {
                                   if ($themeCSS == $currentTheme){
                                     echo '<option selected>' . $themeCSS . '</option>';
                                   }else{
                                     echo '<option>' . $themeCSS . '</option>';
                                   }
                                 }
                                 ?>
                              </select>
                              <small class="form-text text-muted">
                              <?php print $lang['SITE_THEME_DESC']; ?> <code>css/themes</code>.
                              </small>
                           </div>

                           
                           <div class="form-group">
                                 <h4><?php print $lang['SHOW_ERRORS']; ?></h4>
                              <div class="form-check abc-checkbox abc-checkbox-circle">
                              <?php
                                 if ($config['showerrors'] == true){
                                   echo '<input id="showErrors" name="showErrors" type="checkbox" class="form-check-input" checked>';
                                 }else{
                                   echo '<input id="showErrors" name="showErrors" type="checkbox" class="form-check-input">';
                                 }
                                 ?>
                                 <label for="showErrors" class="form-check-label"><?php print $lang['SHOW_ERRORS_DESC']; ?></label>
                               </div>
                             </div>


                             <div class="form-group">
                                 <h4><?php print $lang['DEBUG']; ?></h4>
                              <div class="form-check abc-checkbox abc-checkbox-circle">
                              <?php
                                 if ($config['debug'] == true){
                                   echo '<input id="debugMode" name="debugMode" type="checkbox" class="form-check-input" checked>';
                                 }else{
                                   echo '<input id="debugMode" name="debugMode" type="checkbox" class="form-check-input">';
                                 }
                                 ?>
                                 <label for="debugMode" class="form-check-label"><?php print $lang['DEBUG_MODE_DESC']; ?></label>
                               </div>
                             </div>

                             
                        </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <h2><?php print $lang['HIDE_SHOW_SECT']; ?></h2>
                              <p><?php print $lang['HIDE_SHOW_SECT_DESC']; ?></p>
                              <hr>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                                    <div class="form-group">

                                       <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                          <?php
                                             if ($config['hostname'] == true){
                                               echo '<input id="showHostname" name="showHostname" type="checkbox" class="form-check-input" checked>';
                                             }else{
                                               echo '<input id="showHostname" name="showHostname" type="checkbox" class="form-check-input">';
                                             }
                                             ?>
                                       <label for="showHostname" class="form-check-label"><?php print $lang['HOSTNAME']; ?></label>
                                       </div>

                                       <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                          <?php
                                             if ($config['ip'] == true){
                                               echo '<input id="showIP" name="showIP" type="checkbox" class="form-check-input" checked>';
                                             }else{
                                               echo '<input id="showIP" name="showIP" type="checkbox" class="form-check-input">';
                                             }
                                             ?>
                                             <label for="showIP" class="form-check-label"><?php print $lang['IP_ADDRESS']; ?></label>
                                       </div>

                                       <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                          
                                          <?php
                                             if ($config['os'] == true){
                                               echo '<input id="showOS" name="showOS" type="checkbox" class="form-check-input" checked>';
                                             }else{
                                               echo '<input id="showOS" name="showOS" type="checkbox" class="form-check-input">';
                                             }
                                             ?>
                                             <label for="showOS" class="form-check-label"><?php print $lang['OS']; ?></label>
                                       </div>

                                       <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['kernel'] == true){
                                            echo '<input id="showKernel" name="showKernel" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showKernel" name="showKernel" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showKernel" class="form-check-label"><?php print $lang['KERNEL']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['uptime'] == true){
                                            echo '<input id="showUptime" name="showUptime" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showUptime" name="showUptime" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showUptime" class="form-check-label"><?php print $lang['UPTIME']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['boottime'] == true){
                                            echo '<input id="showBootTime" name="showBootTime" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showBootTime" name="showBootTime" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showBootTime" class="form-check-label"><?php print $lang['BOOT_TIME']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['cpuinfo'] == true){
                                            echo '<input id="showCPU" name="showCPU" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showCPU" name="showCPU" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showCPU" class="form-check-label"><?php print $lang['CPU_INFO']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['temp'] == true){
                                            echo '<input id="showTemp" name="showTemp" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showTemp" name="showTemp" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showTemp" class="form-check-label"><?php print $lang['TEMPERATURE']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['ram'] == true){
                                            echo '<input id="showRAM" name="showRAM" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showRAM" name="showRAM" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showRAM" class="form-check-label"><?php print $lang['RAM_INFO']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['swap'] == true){
                                            echo '<input id="showSwap" name="showSwap" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showSwap" name="showSwap" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showSwap" class="form-check-label"><?php print $lang['SWAP_INFO']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['1min'] == true){
                                            echo '<input id="show1min" name="show1min" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="show1min" name="show1min" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="show1min" class="form-check-label"><?php print $lang['CPU_1MIN']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['5min'] == true){
                                            echo '<input id="show5min" name="show5min" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="show5min" name="show5min" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="show5min" class="form-check-label"><?php print $lang['CPU_5MIN']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['15min'] == true){
                                            echo '<input id="show15min" name="show15min" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="show15min" name="show15min" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="15min" class="form-check-label"><?php print $lang['CPU_15MIN']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['netinfo'] == true){
                                            echo '<input id="showNet" name="showNet" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showNet" name="showNet" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showNet" class="form-check-label"><?php print $lang['NET_INFO']; ?></label>
                                    </div>

                                    <div class="form-check abc-checkbox abc-checkbox-circle form-check-inline">
                                       
                                       <?php
                                          if ($config['diskinfo'] == true){
                                            echo '<input id="showDisk" name="showDisk" type="checkbox" class="form-check-input" checked>';
                                          }else{
                                            echo '<input id="showDisk" name="showDisk" type="checkbox" class="form-check-input">';
                                          }
                                          ?>
                                          <label for="showDisk" class="form-check-label"><?php print $lang['DISK_INFO']; ?></label>
                                    </div>
    
                                 </div>

                                    
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php include 'php/include/footer.php'; ?>
               </div>
            </div>
         </div>
      </form>
   </div>
   <!-- /container -->
   <!-- Settings Saved Modal -->
   <div class="modal fade" id="savedSettings" tabindex="-1" role="dialog" aria-labelledby="savedSettings" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="saveSuccess"><?php print $lang['SAVED']; ?></h5>
            </div>
            <div class="modal-body">
               <?php print $lang['SAVED_DESC']; ?>
            </div>
         </div>
      </div>
   </div>

   <!-- Settings Error Modal -->
   <div class="modal fade" id="settingsError" tabindex="-1" role="dialog" aria-labelledby="savedSettings" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="saveSuccess"><?php print $lang['ERROR_OCCURED_TITLE']; ?></h5>
            </div>
            <div class="modal-body" id="settings_error_content"></div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.href='index.php'"><?php print $lang['REFRESH_SWMP']; ?></button>
            </div>
         </div>
      </div>
   </div>
   <!-- Save Data JS -->
   <script type="text/javascript" src="js/savedata.js"></script>
</body>
</html>
