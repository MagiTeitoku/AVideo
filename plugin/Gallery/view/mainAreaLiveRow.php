<?php
global $global;
if(!empty($global['mainAreaLiveRow'])){
    return;
}
if (empty($_REQUEST['catName'])) {
    $objLive = AVideoPlugin::getDataObject('Live');
    if (empty($objLive->doNotShowLiveOnVideosList)) {
?>
        <!-- For Live Videos mainArea -->
        <div id="liveVideos" class="clear clearfix" style="display: none;">
            <h3 class="galleryTitle text-danger"> <i class="fas fa-play-circle"></i> <?php echo __("Live"); ?></h3>
            <div class="extraVideos"></div>
        </div>
        <!-- For Live Schedule Videos <?php echo basename(__FILE__); ?> -->
        <div id="liveScheduleVideos" class="clear clearfix" style="display: none;">
            <h3 class="galleryTitle"> <i class="far fa-calendar-alt"></i> <?php echo __($objLive->live_schedule_label); ?></h3>
            <div class="extraVideos"></div>
        </div>
        <!-- For Live Videos End -->
<?php
    }
}
$global['mainAreaLiveRow'] = 1;
