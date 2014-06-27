<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<?php
      if( !empty($node->field_cover_image) && $page) {
        $cover_image = file_create_url($content['field_cover_image']['#items'][0]['uri']);
        drupal_add_js(array('MYMODULE' => array('cover_image' => $cover_image)), array('type' => 'setting'));
      }
      $subheadline = render($content['field_subheadline']);
      $postedIn = render($content['field_posted_in']);
      //dsm($content);

      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_cover_image']);
      hide($content['field_posted_in']);
      $rightRailImages = $content['field_posted_images'];
      $rightRailVideo = $content['field_posted_video'];
?>

  <div id="post-cover" class="post-cover">
    <section class="container">
      <?php if ($title_prefix || $title_suffix || $subheadline || $display_submitted || $title): ?>
      <div class="row" id="post-headlines">
        <?php print render($title_prefix); ?>
        <?php if ($title) : ?>
        <div class="col-sm-11 post-headline">
          <h1<?php print $title_attributes; ?>>
            <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
          </h1>
        <?php endif; ?>
        <?php if ($subheadline) : ?>
          <div class="post-subheadline-wrap">
            <h2 class="post-subheadline"><small><?php print $subheadline; ?></small></h2>
          </div>
        <?php endif; ?>
        </div>
        <?php print render($title_suffix); ?>
        <?php if ($display_submitted && !$page) : ?>
          <p class="submitted">
            <?php print $user_picture; ?>
            <?php print $submitted; ?>
          </p>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </section>
  </div>
  <div class="clearfix"></div>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> container clearfix"<?php print $attributes; ?>>

  <div class="row">
    <?php if ($rightRailImages || $rightRailVideo): ?>
    <!-- Body content is 9 columns if there are images or videos -->
    <div class="col-sm-9">
      <?php print render($content); ?>
    </div>
    <div class="col-sm-3">
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
      <!-- Body content is 9 columns if there are no images video -->
      <div class="col-sm-9">
        <?php print render($content); ?>
      </div>
    <?php endif; ?>
    <div class="clearfix"></div>
    <div class="statlinks">
      <?php print render($content['links']); ?>
      <?php print render($content['comments']); ?>
  </div>

</article>
