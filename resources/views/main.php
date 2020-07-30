<?php
/**
 * @var \App\Helpers\Image[] $images
 */
?>

<h1>Hello World</h1>

<?php foreach ($images as $image): ?>
    <div style="margin-bottom: 1rem">
        <div>
            <a href="<?=$image->getOriginalUrl()?>" target="_blank">original</a>
        </div>
        <div>
            <a href="<?=$image->getUrl()?>" target="_blank">proxy</a>
        </div>
    </div>
<?php endforeach; ?>
