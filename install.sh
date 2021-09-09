#!/bin/bash

# Installs SWMP from the command line.

# Set some text display variables first because... pretty.
bold=`tput bold`
red=`tput setaf 1`
green=`tput setaf 2`
reset=`tput sgr0`
redbg=`tput setab 1`
greenbg=`tput setab 2`

# Check the user isn't root
if [[ $EUID -eq 0 ]]; then
   echo -e "\n${bold}${redbg}SWMP setup must not be run as root or with sudo.${reset}\n" 1>&2
   exit 1
fi

# If the user CTRL+C to exit, be polite and say goodbye.
trap ctrl_c INT

function ctrl_c() {
		clear
        echo -e "\nThanks for checking out SWMP!\n"
        exit
}

# Clear screen
clear

# Ascii txt
cat << "EOF"


 .d8888b.  888       888 888b     d888 8888888b.  
d88P  Y88b 888       888 8888b   d8888 888   Y88b 
Y88b.      888  d8b  888 88888b.d88888 888    888 
 <Y888b>   888 d888b 888 888Y88888P888 888   d88P 
    <Y88b. 888d88888b888 888 Y888P 888 8888888P>  
      0888 88888P Y88888 888  Y8P  888 888        
Y88b  d88P 8888P   Y8888 888       888 888        
 <Y8888P>  888P     Y888 888       888 888     


EOF

# Set important variable for later
notoffered=true

# Welcome the user
echo -e "${bold}Welcome to the SWMP installation.\n${reset}"
read -p "Press ${bold}Enter${reset} to begin the setup process..."

#####################################
##### CHECK FOR OS DISTRIBUTION #####
#####################################

# ARCH
if [ -f "/etc/arch-release" ];
	then
	dist="arch"

# DEBIAN/UBUNTU/MINT ETC...
elif grep -q ubuntu "/etc/os-release" || grep -q debian "/etc/os-release";
	then
	dist="debian"

# CENTOS
elif grep -q centos "/etc/os-release";
	then
	dist="centos"

# FEDORA / REDHAT
elif grep -q fedora "/etc/os-release" || grep -q rhel "/etc/os-release";
	then
	dist="fedora"

# IF OTHER / NOT DETECTED
else
	clear
    echo -e "\n${redbg}The SWMP installer does not support your operating system.${reset}"
    echo -e "Please refer to the manual installation method or create an issue on GitHub."
    echo -e "${bold}https://github.com/fuzzymannerz/swmp${reset}\n\n"
    exit
fi


####################################
##### CHECK FOR OR INSTALL GIT #####
####################################

# Set the repo variable
repository="git://github.com/fuzzymannerz/swmp.git"

# Inform user of GIT check and possible install
echo -e "\nChecking if ${bold}Git${reset} is installed..."
sleep 1s


# Detect the Linux distro

# ARCH
if [[ $dist = "arch" ]];
	then
	if (pacman -Qi git &> /dev/null);
	then
		echo -e "\n${bold}${greenbg}All good!${reset}"
		sleep 1s
	else
		echo -e "\n${bold}${redbg}Git is not installed.${reset}\n"
		read -p "Press ${bold}Enter${reset} to install it..."
		sudo pacman -Sy git;
	# If SUDO fails, tell the user
	if [[ $? -ne 0 ]]; then
		echo -e "\n${redbg}Please make sure ${bold}SUDO${reset}${redbg} is installed and your user is able to use it.${reset}\n"
		read -p "Press ${bold}Enter${reset} to exit the installer..."
		echo
		exit
	fi
	# If all went well, continue the setup
		echo -e "\n\n${bold}${green}Continuing SWMP setup...${reset}"
		sleep 1s
	fi

# DEBIAN or UBUNTU
elif [[ $dist = "debian" ]];
	then
	if [ $(dpkg-query -W -f='${Status}' git 2>/dev/null | grep -c "ok installed") -eq 0 ];
	then
	echo -e "\n${bold}${redbg}Git is not installed.${reset}\n"
	read -p "Press ${bold}Enter${reset} to install it..."
	echo
	sudo apt-get install git -y;
		# If SUDO fails, tell the user
	if [[ $? -ne 0 ]]; then
		echo -e "\n${redbg}Please make sure ${bold}SUDO${reset}${redbg} is installed and your user is able to use it.${reset}\n"
		read -p "Press ${bold}Enter${reset} to exit the installer..."
		echo
		exit
	fi
	# If all went well, continue the setup
	echo -e "\n\n${bold}${green}Continuing SWMP setup...${reset}\n"	
	else
	echo -e "\n${bold}${greenbg}All good!${reset}"
	fi
	sleep 1s

# FEDORA, CENTOS

elif [[ $dist = "fedora" ]] || [[ $dist = "centos" ]]; then
	# Function for checking installations on fedora based OS
	function yuminstalled {
	  if yum list installed "$@" >/dev/null 2>&1; then
	    true
	  else
	    false
	  fi
	}

	if yuminstalled $git-*; then
	echo -e "\n${bold}${redbg}Git is not installed.${reset}\n"
	read -p "Press ${bold}Enter${reset} to install it..."
	echo
	sudo yum install git -y;
	# If SUDO fails, tell the user
	if [[ $? -ne 0 ]]; then
		echo -e "\n${redbg}Please make sure ${bold}SUDO${reset}${redbg} is installed and your user is able to use it.${reset}\n"
		read -p "Press ${bold}Enter${reset} to exit the installer..."
		echo
		exit
	fi
	# If all went well, continue the setup	
	echo -e "\n\n${bold}${green}Continuing SWMP setup...${reset}\n"	
	else
	echo -e "\n${bold}${greenbg}All good!${reset}"
	fi
	sleep 1s

fi


##############################
##### INSTALL SWMP FILES #####
##############################

# Ask where to install swmp
echo -e "\nWhere would you like to install the SWMP folder? ${bold}[/var/www]${reset}"
read -er installdir

# If user just presses enter, set as default DIR
if [ -z "$installdir" ]
then 
installdir="/var/www"
fi

echo -e "\n${bold}${green}OK, SWMP will install to \"$installdir/swmp\".${reset}\n"
read -p "Press ${bold}Enter${reset} to install..."
echo # Lone echo to make new line
# Download and install the files to the location
git clone "$repository" "$installdir/swmp/"
# Show success or error
if [[ $? -ne 0 ]]; then
    echo -e "\n${bold}${redbg}Make sure you have permission to write to \"$installdir\" and that a folder named \"swmp\" doesn't already exist inside it then try running the script again.${reset}\n"
    exit
fi
echo -e "\n${bold}${greenbg}Success!${reset}"
sleep 1s

################################
#####     WHEN COMPLETE    #####
################################

success(){
# Clear screen
clear

# Ascii txt
cat << "EOF"

  ____                              _ 
 / ___| _   _  ___ ___ ___  ___ ___| |
 \___ \| | | |/ __/ __/ _ \/ __/ __| |
  ___) | |_| | (_| (_|  __/\__ \__ \_|
 |____/ \__,_|\___\___\___||___/___(_)
                                      

EOF

    echo -e "${bold}Don't forget to point your web server software to ${green}\"$installdir/swmp\"${reset}${bold}!\n${reset}"

	if [[ $dist = "arch" ]]; then
		echo -e "${bold}${redbg}PLEASE NOTE:${reset}\n${bold}\"htpasswd\" tools for Arch Linux are not yet supported by this installer.${reset}"
		echo -e "Please generate a htpasswd file at ${bold}http://htpasswdgenerator.net${reset} or with ${bold}Apache${reset}.\n${bold}See the GitHub README.md for more information.${reset}\n"
	fi

    echo -e "Due to the variation in server configurations, this setup tool does not search for a valid PHP installation.\n${bold}Remember to install PHP if you don't already have it installed.${reset}\n\n${bold}See the GitHub README.md for more information.${reset}\n\nThanks for checking out SWMP!\n\n"
    exit
}


################################
##### SECURE THE DIRECTORY #####
################################

# Function to secure with htpasswd using apache2-utils
utilsSecure(){
	# Ask for a user name
	echo -e "\nWhat would you like your username to be? ${bold}[admin]${reset}"
	read -er username
	# If user just presses enter, set username as admin
	if [ -z "$username" ]
	then 
	username="admin"
	fi
	echo -e "\n${bold}${green}Creating a .htpasswd file for user \"$username\"...${reset}\n"
	# Create the password file
	htpasswd -c $installdir/swmp/.htpasswd $username
	echo -e "\n${bold}${greenbg}All good!${reset}\n"
	read -p "Press ${bold}Enter${reset} to continue..."
	clear
	echo -e "\nPlease be sure to reference your .htpasswd file in the correct way depending on your web server."
	echo -e "Your file is located at: ${bold}$installdir/swmp/.htpasswd${reset}\n"
	echo -e "For ${bold}Apache${reset} see: https://wiki.apache.org/httpd/PasswordBasicAuth"
	echo -e "For ${bold}Nginx${reset} see: http://nginx.org/en/docs/http/ngx_http_auth_basic_module.html\n"
	echo -e "For other server software, refer to your server documentation on how to use ${bold}.htpasswd${reset} files.\n"
	echo 
	read -p "Press ${bold}Enter${bold} to finish the setup."
	success
}


############################################################
##### CHECK FOR OR INSTALL APACHE2-UTILS / HTTPD-TOOLS #####
############################################################

echo -e "\nChecking if a compatible htpasswd package is installed..."

# Function to install apache2-utils
utilsInstall(){

	if [[ $dist = "debian" ]]; then
		echo # Lone echo to make blank line
		echo -e "${bold}${green}Updating the package list...${reset}\n"
		sudo apt-get update -y
		echo -e "\n${bold}${green}Installing apache2-utils${reset}...\n"
		sudo apt-get install apache2-utils -y

	elif [[ $dist = "fedora" ]] || [[ $dist = "centos" ]]; then
		echo -e "${bold}${green}Installing httpd-tools${reset}...\n"
		sudo yum install httpd-tools -y
	fi
	
	echo # Lone echo to make blank line
	echo -e "${bold}${greenbg}Installed!${reset}"
	# When installed, secure with htpasswd
	utilsSecure
}

# Function to secure with .htpasswd
secureinstall(){
# Set notoffered to false to prevent asking loop
notoffered=false

# Function for if apache2-utils IS NOT installed...
apachenotinstalled(){
	echo -e "\n${bold}${redbg}Setup had detected that a compatible htpasswd package is not installed.${reset}\n"
	echo -e "Would you like to install one and generate a ${bold}.htpasswd${reset} file to secure access? ${green}(Recommended)${reset}"

		select yn in "Yes" "No"; do
		    case $yn in
		        Yes ) utilsInstall;;
		        No )  echo -e "\n${red}It is highly recommended to secure \"$installdir/swmp\" to prevent public web access.\n(A \".htpasswd\" file for example.)${reset}\n";
					  read -p "Please press Enter to continue...";
					  echo;
					  break;
		    esac
		done
}

## Function for if apache2-utils IS installed...
apacheinstalled(){
		echo -e "\n${greenbg}Setup has detected that a compatible ${bold}htpasswd${reset}${greenbg} package is installed.${reset}\n"
		echo -e "Would you like to use it to generate a ${bold}.htpasswd${reset} file to secure access? ${green}(Recommended)${reset}"
		
		select yn in "Yes" "No"; do
		    case $yn in
		        Yes ) utilsSecure;;
		        No )  echo -e "\n${red}It is highly recommended to secure \"$installdir/swmp\" to prevent public web access.\n(A \".htpasswd\" file for example.)${reset}\n";
					  read -p "Please press Enter to continue...";
					  echo;
					  break;
		    esac
		done
}

# Check to see if Apache2-utils is already installed and offer the relevent function from above
if [[ $dist = "debian" ]]; then
	if [ $(dpkg-query -W -f='${Status}' apache2-utils 2>/dev/null | grep -c "ok installed") -eq 0 ]; then
		apachenotinstalled
	else
		apacheinstalled
	fi

elif [[ $dist = "fedora" ]] || [[ $dist = "centos" ]]; then

	# Function for checking installations on fedora based OS
	function yuminstalled {
	  if yum list installed "$@" >/dev/null 2>&1; then
	    true
	  else
	    false
	  fi
	}

	if yuminstalled $httpd-tools*; then
		apachenotinstalled
	else
		apacheinstalled
	fi

fi
}


# Offer to secure with .htpasswd ONLY if it hasn't been offered already
if [[ notoffered ]]; then
    secureinstall
fi

success
