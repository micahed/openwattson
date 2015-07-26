/*  openwattson - getconf.c
 *  
 *  Version 0.1
 *  
 *  Just read current config file and write it out to stdout
 *  
 *  Copyright 2015, Alan Wood
 *  Copyright 2010, Kary Främling, Jan Nyman
 *  This program is published under the GNU General Public license
 */

#include "rwwattson.h"
 
/********** MAIN PROGRAM ************************************************
 *
 * It takes one parameter which is the config parameter to get
 * It will look for the file on the default paths
 * See the openwattson.conf-dist file for info
 *
 ***********************************************************************/
int main(int argc, char *argv[])
{
	//WATTSON wattson;
	struct config_type config;
	char * argv1 = "Nothing";

	get_configuration(&config, NULL);

	if (argc > 1) {argv1 = argv[1];}

	if (strcmp(argv1,"temp" )==0) { 
		  printf ("%s\n", config.temp_dir);
	}
	else if (strcmp(argv1,"logdir")==0) {
		  printf ("%s\n", config.logfile_dir);
	}
	else if (strcmp(argv1,"HTMLdir")==0) {
		  printf ("%s\n", config.HTMLfile_dir);
	}
	else if (strcmp(argv1,"scriptdir")==0) {
		  printf ("%s\n", config.script_dir);
	}
	else if (strcmp(argv1,"serialdev")==0) {
		  printf ("%s\n", config.serial_device_name);
	}
	else {
		printf("Usage %s {temp, logdir, HTMLdir, scriptdir, serialdev}\n", argv[0]);
	}

	return(0);
}

