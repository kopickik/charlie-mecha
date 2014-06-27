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
      $rightRailImages = render($content['field_posted_images']);
      $subheadline = render($content['field_subheadline']);
      $rightRailVideos = render($content['field_posted_video']);
      $byline = render($content['field_byline']);
      //dsm($content);

      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_byline']);
      hide($content['field_cover_image']);
      //hide($content['field_posted_in']);
      hide($content['field_byline']);
?>
  <div id="post-cover" class="post-cover">
    <section class="container">
      <?php if ($title_prefix || $title_suffix || $display_submitted || $unpublished || $title || $subheadline): ?>
    <header class="row" id="post-headlines">
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
      <div class="col-sm-9">
        <h1<?php print $title_attributes; ?>>
          <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
        </h1>
        <div class="post-subheadline-wrap">
        <h2 class="post-subheadline"><small><?php print $subheadline; ?></small></h2>
        </div>
      </div>
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
    </section>
  </div>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> container clearfix"<?php print $attributes; ?>>

  <div class="row">
    <?php if ($rightRailImages || $rightRailVideos): ?>
    <!-- Body Content is 8 columns if there are images or videos -->
    <div class="col-md-9">
      <?php print render($content); ?>
    </div>
    <div class="col-md-3">
      <h3>Media:</h3>
      <?php if ($rightRailImages): ?>
      <div class="zoom-gallery">
      <?php print $rightRailImages; ?>
      </div>
      <?php endif; ?>
      <?php if ($rightRailVideos): ?>
      <div class="yt-gallery">
      <?php print $rightRailVideos; ?>
      </div>
      <?php endif; ?>
    </div>
  <?php elseif (!$rightRailImages && !$rightRailVideos): ?>
  <!-- Body Content is 12 columns if there are images or videos -->
    <div class="col-md-12">
      <?php
      //$term=taxonomy_term_load($node->field_posted_in['und'][0]['tid']);
      //$result=field_view_field('taxonomy_term',$term,'field_byline_image');
      //echo render($result) 
      ?>
      <?php print render($content); ?>
    </div>
  <?php endif; ?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>
  </div>

</article>
