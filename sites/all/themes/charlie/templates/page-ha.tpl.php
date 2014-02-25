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

  <header id="ha-header" class="ha-header ha-header-large">
    <div class="ha-header-perspective">
      <div class="ha-header-front row">
        <div class="col-md-4 col-sm-4">
        <h1><span>PCGCampbell</span></h1>
        </div>
        <div id="navigation" class="col-md-8 col-sm-8">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-name-main-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars fa-2x"></span>
              </button>
          </div>
          <?php print render($page['navigation']); ?>
        </div>
      </div>
    </div>
  </header>
  <div id="verge" class="container-fluid">
    <?php print render($page['verge']); ?>
    <div class="clearfix"></div>
  </div>

  <div id="main" class="container">

    <div id="content" class="row" role="main">
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
