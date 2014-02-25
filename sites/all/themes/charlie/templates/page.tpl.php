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
  <header id="theheader" class="theheader theheader-large clearfix" role="banner">
    <div class="theheader-perspective container">
      <div class="theheader-front row">
        <?php if ($logo): ?>
        <div class="col-md-3 col-sm-4 col-xs-6 branding alpha">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" class="navbar-brand" id="logo"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" class="header__logo-image" /></a>
        </div>
        <?php endif; ?>
        <div id="navigation" class="col-md-7 col-sm-12">
      <div class="navbar-header">
        <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-name-main-menu">
          <span class="sr-only">Toggle navigation</span>
          <span class="fa fa-bars fa-2x"></span>
        </button>
      </div>
      </div>

      <?php print render($page['navigation']); ?>

    </div>
      </div>
    </div>
  </header>

  <?php $verge = render($page['sidebar_first']); ?>
  <?php if ($verge): ?>
  <div id="verge" class="container-fluid">
    <?php print $verge; ?>
    <div class="clearfix"></div>
  </div>
  <?php endif; ?>

  <div id="main" class="container">

    <div id="content" class="row" role="main" data-animate-down="ha-header-hide" data-animate-up="ha-header-small">
      <?php print render($page['highlighted']); ?>
      <div class="col-sm-12">
      <div class="col-sm-push-8 col-sm-4">
      <?php print $breadcrumb; ?>
      </div>
      </div>
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
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
    </div>

    <?php
      // Render the sidebars to see if there's anything in them.
      $sidebar_first  = render($page['sidebar_first']);
      $sidebar_second = render($page['sidebar_second']);
    ?>

    <?php if ($sidebar_first || $sidebar_second): ?>
      <aside class="sidebars">
        <?php print $sidebar_first; ?>
        <?php print $sidebar_second; ?>
      </aside>
    <?php endif; ?>

  </div>

  <?php print render($page['footer']); ?>

</div>

<?php print render($page['bottom']); ?>
