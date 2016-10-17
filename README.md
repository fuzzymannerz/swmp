[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=fuzzymannerz&url=https://github.com/fuzzymannerz/swmp&title=SWMP)
# SWMP - Server Web Monitor Page

**A responsive, eye-pleasing Linux server statistics dashboard.**
- [Screenshot](#non-fancy-fake-devices-screenshot-)
- [Requirements](#requirements)
- [Installation](#installation)
- [Themes](#themes)
- [Show Some Love <3](#show-some-love-3)
- [Contributions, Ports & Credits](#contributions)


![](http://i.imgur.com/q8XWluS.png)

### Non-"Fancy fake devices" Screenshot. ;)
![](https://i.imgur.com/zAIBKkd.png)

## Requirements
- Linux OS with...
- A Web Server. (Nginx, Apache etc...)
- PHP with **shellexec()** and **exec()** enabled.

## Installation

### The Easy Way
Simply run:
```bash
bash <(curl -s -L https://getswmp.thefuzz.xyz)
```
_or_
```bash
wget https://getswmp.thefuzz.xyz/install.sh
chmod +x install.sh
./install.sh
```
The installer will also help you to secure the install folder with a `.htpasswd` file.    
If you want to see the installer source, [it's available directly here](https://getswmp.thefuzz.xyz).    
Optionally copy the file `config.php` to `config.local.php` and adjust the settings for your web server.

### The Manual Way
1. [Download the Zip file](https://github.com/fuzzymannerz/swmp/archive/master.zip).
2. Extract the files to the web server. (You might want to secure access somehow, [.htpasswd](http://www.htaccesstools.com/htpasswd-generator/) maybe?)
3. Optionally copy the file `config.php` to `config.local.php` and adjust the settings for your web server.
4. That's it! (Unless you want to change the theme, in which case, read on!)

## Themes
SWMP includes a selection of themes. The default being **simplex**. (The red and white one above)
![](http://i.imgur.com/vlw9NyV.png)
To choose another theme, copy **config.php** to **config.local.php** and change line `"theme" => "simplex"` to the theme of your choice. All theme stylesheets are located in **~/css/themes/**.

## Show Some Love <3
If you make use of SWMP in some way, please consider a donation.    

**[PayPal](https://paypal.me/fuzzymannerz)**, **[Flattr](https://flattr.com/submit/auto?user_id=fuzzymannerz&url=https://github.com/fuzzymannerz/swmp&title=SWMP)**    
**BTC:** 1DUJH2kqccDpTHHSCXDkRGhxtvXm9PdnkN

## Contributions
**Feel free to contribute to SWMP, these guys already did:**   
[TomasKostadinov](https://github.com/TomasKostadinov) - _Darkplex Theme._    
[daison12006013](https://github.com/daison12006013) - _Bugfixes._   
[Mikescher](https://github.com/Mikescher) - _Configuration file and error messages._    
[Efreak](https://github.com/Efreak) - _Automatic reloading & URL theme switching._    

## Ports & Variations
[SWMPjs](https://github.com/Efreak/swmpjs) - _Efreak's nodejs version of SWMP._   

## Credits
**SWMP also wouldn't be possible without the use of these awesome projects:**    
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
