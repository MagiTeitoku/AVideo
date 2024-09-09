<?php
$hlsIsEnabled = AVideoPlugin::loadPluginIfEnabled('VideoHLS');
$type = Video::getVideoTypeFromId($videos_id, true);
if (empty($type->m3u8)) {
?>
    <div class="alert alert-warning">
        <strong>Note:</strong> This feature is only available for a video in HLS format. If you're not familiar with these requirements, please contact support for assistance.
    </div>
<?php
var_dump($type);
    return;
}
?>
<div class="row">
    <div class="col-sm-4">
        <?php
        include __DIR__ . '/dubbing.panel.php';
        ?>
    </div>
    <div class="col-sm-8">
        <?php
        include __DIR__ . '/../../../plugin/VideoHLS/languages/index.php';
        ?>
    </div>
</div>