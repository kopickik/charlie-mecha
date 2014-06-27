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

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page && $title): ?>
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
    </header>
  <?php endif; ?>

  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_case_study_image']);
    hide($content['field_case_study_tags']);
    hide($content['field_case_study_images']);
    hide($content['field_case_study_video']);
    hide($content['field_case_study_quote']);
    hide($content['field_case_study_quoted']);
  ?>
  <div class="col-sm-12">
    <?php if (render($content['field_case_study_images']) || (render($content['field_case_study_video']))) : ?>
    <div class="flexslider">
      <ul class="slides">
        <?php if (render($content['field_case_study_images'])) : ?>
          <?php print render($content['field_case_study_images']); ?>
        <?php endif; ?>
        <?php if (render($content['field_case_study_video'])) : ?>
          <?php print render($content['field_case_study_video']); ?>
        <?php endif; ?>
      </ul>
    </div>
    <?php endif; ?>
  </div>
  <div class="col-sm-12"><?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <h1 class="page-header"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?></div>
  <div class="col-sm-9">
    <?php print render($content['body']); ?>
  </div>
  <div class="col-sm-3">
    <div class="spacer_s1"></div>
    <blockquote>
    <?php print render($content['field_case_study_quote']); ?>
    <?php print render($content['field_case_study_quoted']); ?>
    </blockquote>
  </div>
  <div class="col-sm-12"><hr></div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>
