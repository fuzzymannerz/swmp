# SWMP - Server Web Monitor Page

## Important Notice
SWMP is no longer being maintained and hasn't been for a while.
You are free to fork and use however you wish under the MIT license.
The previous domain (swmp.ml) is no longer owned or operated by me. Do not use any of the installation script methods related to that domain name!
--------------------------------------------------------------------

**A responsive, eye-pleasing Linux server statistics dashboard.**
- [Requirements](#requirements)
- [Installation](#installation)
- [Settings](#settings)
- [Show Some Love <3](#show-some-love-3)
- [Contributions, Ports & Credits](#contributions)


![](http://i.imgur.com/q8XWluS.png)    

## Requirements
- Linux OS with...
- A Web Server. (Nginx, Apache etc...)
- PHP with **shellexec()** and **exec()** enabled.

## Installation

### The Easy Way
Run the installation script from:
https://github.com/fuzzymannerz/swmp/blob/gh-pages/install.sh

### The Manual Way
1. [Download the Zip file](https://github.com/fuzzymannerz/swmp/archive/master.zip).
2. Extract the files to the web server. (You might want to secure access somehow, [.htpasswd](http://www.htaccesstools.com/htpasswd-generator/) maybe?)
3. That's it!

![](https://camo.githubusercontent.com/b5d5b9c5b91d43c3352ac1cd7eb31b73116a4bee/687474703a2f2f692e696d6775722e636f6d2f766c77394e79562e706e67)
## Settings
SWMP includes a settings page. This enables you to configure some things with your SWMP installation.    
This includes choosing from a selection of themes, choosing the language (See [Languages](#languages) for more information), changing the window title and showing and hiding elements on the main page as well as some debugging options.
(All theme stylesheets are located in `~/css/themes/`.)

## Languages
To better make SWMP available to everyone it can be translated into any language.    
On the settings page there is a language dropdown box. This automatically picks up any language file in the locale tag format of `en_GB.php`. These files can be found in the `/lang` folder.

## Show Some Love <3
If you make use of SWMP in some way, please consider a donation.    
     
**BTC:** 1DUJH2kqccDpTHHSCXDkRGhxtvXm9PdnkN

## Contributions
**Feel free to contribute to SWMP, these guys already did:**   
[TomasKostadinov](https://github.com/TomasKostadinov) - _Darkplex Theme._    
[daison12006013](https://github.com/daison12006013) - _Bugfixes._   
[Mikescher](https://github.com/Mikescher) - _Configuration file and error messages._    
[Efreak](https://github.com/Efreak) - _Automatic reloading & URL theme switching._   
[liamjack](https://github.com/liamjack) - _Fixed vulnerability issue with themes._

## Ports & Variations
[SWMPjs](https://github.com/Efreak/swmpjs) - _Efreak's nodejs version of SWMP._   

## Credits
**SWMP also wouldn't be possible without the use of these awesome projects:**    

DigitalOcean:    
https://m.do.co/c/b6c4ddc534a6    
eZ Server Monitor Web:    
https://github.com/shevabam/ezservermonitor-web    
Gauge JS:    
http://github.com/bernii/gauge.js   
Tablesaw:    
https://github.com/filamentgroup/tablesaw    
Twitter Bootstrap:    
https://github.com/twbs/bootstrap    
Bootswatch:    
https://github.com/thomaspark/bootswatch    
jQuery:    
https://github.com/jquery/jquery    
Awesome Bootstrap Checkbox:    
https://github.com/flatlogic/awesome-bootstrap-checkbox    
