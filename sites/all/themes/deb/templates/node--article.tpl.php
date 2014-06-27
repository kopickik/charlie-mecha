<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title): ?>
    <header>
      <?php print render($title_prefix); ?>
      <?php if (!$page && $title): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <p class="submitted">
          <?php print $user_picture; ?>
          <?php print $submitted; ?>
        </p>
      <?php endif; ?>

      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_image']);
    hide($content['field_feature_video']);
    $rightRailImages = render($content['field_feature_images']);
    $rightRailVideo = render($content['field_feature_video']);
    //print render($content);
  ?>
  <div class="row">
  <?php if ($rightRailImages || $rightRailVideo): ?>
    <!-- Body content is 9 columns if there are images or videos -->
    <div class="col-sm-9">
      <?php print render($content); ?>
    </div>
    <div class="col-sm-3 omega">
      <?php if ($rightRailImages): ?>
      <div class="zoom-gallery">
        <h4 class="center">&nbsp;</h4>
        <?php print render($content['field_feature_images']); ?>
      </div>
      <?php endif; ?>
      <?php if ($rightRailVideo): ?>
      <div class="yt-gallery">
        <h4>&nbsp;</h4>
        <?php print render($content['field_feature_video']); ?>
      </div>
      <?php endif; ?>
    </div>
    <?php elseif (!$rightRailImages && !$rightRailVideo): ?>
      <!-- Body content is 12 columns if there are no images video -->
      <div class="col-sm-12">
        <?php print render($content); ?>
      </div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="statlinks">
      <?php print render($content['links']); ?>
      <?php print render($content['comments']); ?>
    </div>
  </div>

</article>
