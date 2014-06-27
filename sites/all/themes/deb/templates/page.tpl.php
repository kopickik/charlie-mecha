<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>

<div id="page">

  <header class="header" role="banner">
    <div id="theheader" class="navbar navbar-default navbar-fixed-top theheader-large" role="navigation">
      <div class="container">
        <div class="row">
        <?php if ($logo): ?>
        <div class="navbar-header col-xs-4" id="logo">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="brand site-logo"><img src="<?php print $logo; ?>" alt="<?php print t('Ecomotors Home'); ?>" /></a>
        </div>
        <?php endif; ?>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars fa-2x"></span>
          </button>
        <div class="navbar-collapse collapse">
          <?php $block = module_invoke('menu_block', 'block_view', 2);
                print render($block['content']); ?>
          <?php /*print render($page['navigation']);*/ ?>
        </div>

        <?php if ($site_name || $site_slogan): ?>
          <?php if ($site_name): ?>
            <h1 class="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <h2 class="site-slogan"><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <div id="waypointsCtrl" class="waypoint" data-animate-down="theheader-small" data-animate-up="theheader-large"></div>

  <div id="main">

    <div id="content" role="main">
      <div class="container">
        <?php print render($page['highlighted']); ?>
        <?php print $breadcrumb; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>
        <div class="row">
          <?php if (!empty($page['sidebar_first'])): ?>
          <aside class="col-sm-2" role="complementary">
            <?php print render($page['sidebar_first']); ?>
          </aside>  <!-- /#sidebar-first -->
          <?php endif; ?>

          <section<?php print $content_column_class; ?>>
            <?php print render($page['content']); ?>
            <?php print $feed_icons; ?>
          </section>

          <?php if (!empty($page['sidebar_second'])): ?>
          <aside class="col-sm-2" role="complementary">
            <?php print render($page['sidebar_second']); ?>
          </aside>  <!-- /#sidebar-second -->
          <?php endif; ?>
        </div>
      </div>
    </div>  <!-- #content -->
  </div>  <!-- #main -->
  <?php print render($page['footer']); ?>
</div>  <!-- #page -->

<?php print render($page['bottom']); ?>
