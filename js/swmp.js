/*///////////////////////////////////////////////
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
//////////////////////////////////////////////////////////*/


// Get vars from system.php and set them for use
var jsonramdata = ramdata;
var jsoncpudata = cpudata;
var jsonbootupdata = bootupdata;
var jsonswapdata = swapdata;
var jsonnetworkdata = networkdata;
var jsondiskdata = diskdata;

// Set the RAM percentage used
var ramdef = jsonramdata.percent_used;
var usedram = jsonramdata.used;
var freeram = jsonramdata.free;
var totalram = jsonramdata.total;


// Set the CPU load precentages
var onemin = jsoncpudata[0];
var fivemin = jsoncpudata[1];
var fifteenmin = jsoncpudata[2];

// Set the last boot time
var bootup = jsonbootupdata.last_boot;

// Set the swap data
var swapdef = jsonswapdata.percent_used;
var usedswap = jsonswapdata.used;
var freeswap = jsonswapdata.free;
var totalswap = jsonswapdata.total;

// Set the network dara
var netint = jsonnetworkdata.interface;
var netip = jsonnetworkdata.ip;
var netout = jsonnetworkdata.transmit;
var netin = jsonnetworkdata.receive;


// Fill in all the info...

//////////////////////////////
///       RAM RELATED      ///
////////////////////////////// 

    // Get the RAM info into the progress bar
    var valeur = 0;
    if ( ramdef > valeur )
    {
        valeur =  ramdef;
    }
    $('.ramusedbar').css('width', valeur+'%').attr('aria-valuenow', valeur);
    $('#rampercent').html(ramdef + '%');

    // Animate the RAM percentage up from 0
    $('#rampercent').html(function () {
      var $this = $(this);
      jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
        duration: 500,
        easing: 'swing',
        step: function () {
          $this.text(Math.ceil(this.Counter));
          // Then chuck on a percent character
          $('#rampercent').append('%');
        }
      });
    });
    

    // Then shove it in the "Free RAM", "Used RAM" and "Total RAM" elements
    $('#freeram').html(freeram);
    $('#usedram').html(usedram);
    $('#totalram').html(totalram);


//////////////////////////////
///      SWAP RELATED      ///
////////////////////////////// 

    // Get the Swap info into the progress bar
    var valeur = 0;
    if ( swapdef > valeur )
    {
        valeur =  swapdef;
    }
    $('.swapusedbar').css('width', valeur+'%').attr('aria-valuenow', valeur);
    $('#swappercent').html(swapdef + '%');

    // Animate the Swap percentage up from 0
    $('#swappercent').html(function () {
      var $this = $(this);
      jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
        duration: 500,
        easing: 'swing',
        step: function () {
          $this.text(Math.ceil(this.Counter));
          // Then chuck on a percent character
          $('#swappercent').append('%');
        }
      });
    });
    

    // Then shove it in the "Free Swap", "Used Swap" and "Total Swap" elements
    $('#freeswap').html(freeswap);
    $('#usedswap').html(usedswap);
    $('#totalswap').html(totalswap);


//////////////////////////////
///       CPU RELATED      ///
////////////////////////////// 

var pricolor = $(".progress").css("background-color");
var pointercolor = $(".progress-bar").css("background-color");
var fillcolor = $(".progress-bar").css("background-color");
var labelcolor = $("body").css("color");

 // Set the CPU Load Gauge Options

 function cpu1(){
    var opts = {
      lines: 12, // The number of lines to draw
      angle: 0.0, // The length of each line
      lineWidth: 0.66, // The line thickness
      pointer: {
        length: 0.8, // The radius of the inner circle
        strokeWidth: 0.03, // The rotation offset
        color: pointercolor // Colour of the pointer
      },
      limitMax: 'true',   // If true, the pointer will not go past the end of the gauge
      colorStart: fillcolor,   // Set to the bootstrap theme colours
      colorStop: fillcolor,    // Set to the bootstrap theme colours
      strokeColor: pricolor,   // Set to the bootstrap theme colours
      generateGradient: false
    };
    var target = document.getElementById('cpu1'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 100; // set max gauge value
    gauge.animationSpeed = 32; // set animation speed (32 is default value)
    gauge.set(onemin); // set actual value

    // Fix for the needle appearing if value = 0
    if(onemin === 0){
        gauge.set(0.1);
    };

    }

    function cpu2(){
    var opts = {
      lines: 12, // The number of lines to draw
      angle: 0.0, // The length of each line
      lineWidth: 0.66, // The line thickness
      pointer: {
        length: 0.8, // The radius of the inner circle
        strokeWidth: 0.03, // The rotation offset
        color: pointercolor // Colour of the pointer
      },
      limitMax: 'true',   // If true, the pointer will not go past the end of the gauge
      colorStart: fillcolor,   // Set to the bootstrap theme colours
      colorStop: fillcolor,    // Set to the bootstrap theme colours
      strokeColor: pricolor,   // Set to the bootstrap theme colours
      generateGradient: false
    };
    var target = document.getElementById('cpu2'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 100; // set max gauge value
    gauge.animationSpeed = 32; // set animation speed (32 is default value)
    gauge.set(fivemin); // set actual value

    // Fix for the needle appearing if value = 0
    if(fivemin === 0){
        gauge.set(0.1);
    };

    }

    function cpu3(){
    var opts = {
      lines: 12, // The number of lines to draw
      angle: 0.0, // The length of each line
      lineWidth: 0.66, // The line thickness
      pointer: {
        length: 0.8, // The radius of the inner circle
        strokeWidth: 0.03, // The rotation offset
        color: pointercolor // Colour of the pointer
      },
      limitMax: 'true',   // If true, the pointer will not go past the end of the gauge
      colorStart: fillcolor,   // Set to the bootstrap theme colours
      colorStop: fillcolor,    // Set to the bootstrap theme colours
      strokeColor: pricolor,   // Set to the bootstrap theme colours
      generateGradient: false
    };
    var target = document.getElementById('cpu3'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = 100; // set max gauge value
    gauge.animationSpeed = 32; // set animation speed (32 is default value)
    gauge.set(fifteenmin); // set actual value

    // Fix for the needle appearing if value = 0
    if(fifteenmin === 0){
        gauge.set(0.1);
    };

    };

$(document).ready(function() {
    // Do the tango with the gauges ie. make them appear
    cpu1();
    cpu2();
    cpu3();

    // Set the CPU percentages from the data
    $('#cpupercent1').html(onemin);
    $('#cpupercent2').html(fivemin);
    $('#cpupercent3').html(fifteenmin);

    // Animate the CPU percentages up from 0
    $('.cpupercent').each(function () {
      var $this = $(this);
      jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
        duration: 1000,
        easing: 'swing',
        step: function () {
          $this.text(Math.ceil(this.Counter));
        }
      });
    });

});


//////////////////////////////
///     NETWORK RELATED    ///
////////////////////////////// 

function nettable(data) {
    for (var i = 0; i < data.length; i++) {
        netrow(data[i]);
    }
}

function netrow(netdata) {
    var row = $("<tr />")
    $("#networktable").append(row);
    row.append($("<td>" + netdata.interface + "</td>"));
    row.append($("<td>" + netdata.ip + "</td>"));
    row.append($("<td>" + netdata.receive + "</td>"));
    row.append($("<td>" + netdata.transmit + "</td>"));
}

$(document).ready(function() {
nettable(jsonnetworkdata);
});


//////////////////////////////
///      DISK RELATED      ///
////////////////////////////// 

// Make a table of the disk data
function disktable(data) {
    for (var i = 0; i < data.length; i++) {
        diskrow(data[i]);
    }
}

function diskrow(diskdata) {
    var row = $("<tr />")
    $("#disktable").append(row);
    row.append($("<td>" + diskdata.filesystem + "</td>"));
    row.append($("<td>" + diskdata.mount + "</td>"));
    row.append($("<td>" + diskdata.free + "</td>"));
    row.append($("<td>" + diskdata.used + " ("+ diskdata.percent_used +"%)</td>"));
    row.append($("<td>" + diskdata.total + "</td>"));
}

$(document).ready(function() {
disktable(jsondiskdata);
});


//////////////////////////////
///          MISC          ///
////////////////////////////// 

// Show the last bootup time
  $('#bootup').html(bootup);

// Remove any errors when clicking on them
function dismissError(){
  $('#errorNotice').fadeOut();
}

// Fix the tables on smaller devices
  (function( $ ) {
    $( function(){
      $( document ).trigger( "enhance.tablesaw" );
    });
  })( jQuery );

if(reload !== 0) {
    var rld = setInterval(function(){
        if(reload===0) {
            $("#reloadbtn").html('<i class="fas fa-sync-alt"></i> ..');
            location.reload();
            clearInterval(rld);
        } else {
            $("#reloadbtn").html('<i class="fas fa-sync-alt"></i> ' + --reload);
        }
    },1000);
}