<?php

/*
  Plugin Name: Social tweaks
  Plugin URI:
  Description: Displays youtube video views.(more to come...)
  Author: sushilkawad
  Version: 1.0
  Author URI:
 */

defined('ABSPATH') or die('No script kiddies please!');
add_shortcode('st', 'st_youtube');

function st_youtube($atts) {
    
    $yt_video_id = explode('=', explode('/', $atts['yt_url'])[3])[1];
    $JSON = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=" . $yt_video_id . "&key=AIzaSyAayUo9ruMSWTx2-VCk5ZgQQXQBegNAS5g&part=statistics");
    $JSON_Data = json_decode($JSON, true);
//    var_dump($JSON_Data['items'][0]['statistics']);
    return get_youtube_count($atts, $JSON_Data['items'][0]['statistics']);
}

function get_youtube_count($att, $data) {
    if (isset($att) && $att['0'] == 'yt_video_viewcount') {
        return $data['viewCount'];
    }if (isset($att) && $att['0'] == 'yt_video_likecount') {
        return $data['likeCount'];
    }if (isset($att) && $att['0'] == 'yt_video_dislikecount') {
        return $data['dislikeCount'];
    }if (isset($att) && $att['0'] == 'yt_video_favoritecount') {
        return $data['favoriteCount'];
    }if (isset($att) && $att['0'] == 'yt_video_commentcount') {
        return $data['commentCount'];
    }
}
