<?php

/*Podcast Downloader
 *Works with ATOM RSS
 */

/*To install this:
 *1.  save it in a folder on your server
 *2.  make a folder where you want podcasts to be saved to
 *3.  enter the folder where podcasts are saved to into the $local_parent_folder and $local_subfolder variables
 *4.  enter the url of the rss endpoint in the $rss_url variable
 *5.  select a number of downloads you would like the script to download - adjust according to how far back the script should look in time,
 *      and how often the target podcast posts. Enter this in $n_podcasts_to_download;
 *5.  make a new cron job (works best as root)
 *      43 12 * * 1 php /path/to/podcast.php
 *
 *    Be considerate with the above, don't ping their services every day if you don't have to, and try to make crons run not just at 00 (right on the hour),
 *      it helps to spread the load.
 *

 *Known Issues
 *This script searches for <link></link> tags, so if the rss file doesn't store URLs this way you will need to change the script
 
 /*Settings here - this is the only part you need to edit
  */
 
$local_parent_folder = "/path/to/podcasts/";
$local_subfolder = "mypodcast";
$rss_url = "http://www.podcastdomain.com/podcasts/mypodcast.rss";
$n_podcasts_to_download = 30;

/*---------------------------------------------------------------------
 *The rest of the code runs without any interference from here down
 */

require_once('main.php');

?>
