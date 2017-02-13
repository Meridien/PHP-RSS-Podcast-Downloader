<?php
 
 //Derive Settings
$local_folder = $local_parent_folder . $local_subfolder ."/";
$rss_file = basename($rss_url);

//Download RSS File
shell_exec("wget -N " . $rss_url . " -P " . $local_folder);

//Open RSS File as XML
$rss_xml=simplexml_load_file( $local_folder . $rss_file) or die("Error opening XML");

//Get Podcast URLs from the XML
$podcasts_to_download = array();
$i=0;
foreach($rss_xml->channel->children() as $podcast) {
    if($i <= $n_podcasts_to_download){
        $podcast_url = $podcast->link[0];
        $podcast_url = preg_replace('/\?.*/', '', $podcast_url);
        array_push($podcasts_to_download, $podcast_url);
        $i++;
    }
}

//Check Podcast URLs and if they meet the criteria (correct file extension, not already downloaded), download them
foreach($podcasts_to_download as $item){
    
    //Comment these out in PROD - only for debugging
    echo $item . "\n";
    echo basename($item) . "\n";
    
    $continue = true;
    
    if(file_exists( $local_folder."/".basename($item) )){
        $continue = false;
        echo basename($item) . " already downloaded! \n";
    }else{}
    
    $ext = pathinfo( basename($item) , PATHINFO_EXTENSION);
    switch($ext){
        case "mp3":{}
        case "mp4":{}
        break;
        default: {
            $continue = false;
        }
    }
    
    if($continue == true){
        echo "downloading ". basename($item) . "\n";
        shell_exec("wget " . $item . " -P " . $local_folder);
    }else{}
}
?>