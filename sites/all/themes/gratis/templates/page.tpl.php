<?php if ($page['top_panel']): ?>
  <div id="top-panel">
  <?php print render($page['top_panel']); ?>
</div>
<?php endif; ?>


<div id="wrapper">

<?php if ($page['top_links']): ?>
<div id="top-bar" class="top-wrapper">
<div class="grid-container top-wrapper-inner" style="max-width:<?php print $thegrid; ?>">
  <div class="grid-100 top-links">
    <?php print render($page['top_links']); ?>
  </div>
</div>
</div>
<?php endif; ?>

  <div id="header-bar">
    <header role="banner" class="grid-container banner" style="max-width:<?php print $thegrid; ?>">
      <div class="grid-25 logo-wrapper header-grid">
        <div id="brand">
          <div id="logo">
            
            <?php if ($logo): ?>
            <a href="<?php print $front_page; ?>" title="<?php print $site_name; ?> » <?php print $site_slogan; ?>">
              <img id="logo-img" src="<?php print $logo; ?>" alt="<?php print $site_name; ?> » <?php print $site_slogan; ?>"/></a>
            <?php else : ?>
     
        <h1 class="site-name">
          <a href="<?php print $front_page; ?>">
            <?php print $site_name; ?></a>
          </h1>
     
            <?php endif; ?>
          </div>
        </div>
      </div><!--//logo-wrapper-->

<div class="grid-75 branding-grid header-grid">
<?php if ($site_slogan || $site_name) : ?>
  <div id="branding-wrapper">
        <?php if ($logo): ?>
        <?php if ($site_name) : ?>
        <h1 class="site-name">
          <a href="<?php print $front_page; ?>">
            <?php print $site_name; ?></a>
          </h1>
        <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan) : ?>
        <h3 class="branding"><?php print $site_slogan; ?></h3>
        <?php endif; ?>

  </div>
  <?php endif; ?>
</div><!--//branding-grid-->

</header>
</div>

<div id="menu-wrapper">
  <div class="grid-container main-menu-wrapper" style="max-width:<?php print $thegrid; ?>">
    <div class="grid-100">
      <section id="main-menu" role="navigation">
        <?php if ($main_menu): ?>
        <a class="menu-link" href="#menu">
         <i class="icon-fixed-width menu-icon">&#xf039;</i>
        </a>
        <nav id="menu" class="main-navigation">
          <?php if (!empty($primary_nav)): ?>
          <?php print render($primary_nav); ?>
        <?php endif; ?>
      </nav>
    <?php endif; ?>

    <!-- for third party menu systems or modules-->
    <?php if ($page['thirdparty_menu']): ?>
    <?php print render($page['thirdparty_menu']); ?>
  <?php endif; ?>
</section>
</div>
</div>
</div>

<?php if ($breadcrumb): ?>
  <div id="breadcrumbs">
    <header class="grid-container" style="max-width:<?php print $thegrid; ?>">
      <div class="grid-100"><?php print $breadcrumb; ?></div>
    </header>
  </div>
<?php endif; ?>

<?php
// Define and divide the preface page regions.
if ($page['preface_first'] || $page['preface_second'] || $page['preface_third']):
  ?>

  <div id="preface-wrapper">
    <div class="grid-container" id="preface-container" style="max-width:<?php print $thegrid; ?>">

      <!--Preface -->
      <?php if (!empty($page['preface_first'])): ?>
        <div class="<?php print $pre_columns; ?> ">
          <?php print render($page['preface_first']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['preface_second'])): ?>
        <div class="<?php print $pre_columns; ?> ">
          <?php print render($page['preface_second']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['preface_third'])): ?>
        <div class="<?php print $pre_columns; ?> ">
          <?php print render($page['preface_third']); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>

<?php endif; ?>

<main role="main" class="grid-container" style="max-width:<?php print $thegrid; ?>" id="content">
  <div id = "main-content" class="<?php print $content_columns; ?>">
    <?php print $messages; ?>
    <?php if (!empty($tabs)): ?>
      <?php print render($tabs); ?>
    <?php endif; ?>
    <?php if (!empty($page['help'])): ?>

      <div class="well">
        <?php print render($page['help']); ?>
      </div>

    <?php endif; ?>
    <?php if (!empty($action_links)): ?>
      <ul class="action-links">
        <?php print render($action_links); ?>
      </ul>
    <?php endif; ?>

    <?php if (!empty($page['content_top'])): ?>
      <?php print render($page['content_top']); ?>
    <?php endif; ?>

    <?php if (!$is_node): ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="page-header">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
    <?php endif; ?>

    <?php print render($page['content']); ?>

    <?php if ($page['node_block']): ?>
      <?php print render($page['node_block']); ?>
    <?php endif; ?>

  </div>

  <!--Sidebar first-->
  <?php if (!empty($page['sidebar_first'])): ?>
    <aside id="sidebar-first" class="sidebar <?php print $sb_columns; ?>
">
      <?php if ($page['sidebar_first']): ?>
        <?php print render($page['sidebar_first']); ?>
      <?php endif; ?></aside>
  <?php endif; ?>
  <!-- // Sidebar first  (first only - grid-20 pull-80) -->

  <!--Sidebar second-->
  <?php if (!empty($page['sidebar_second'])): ?>
    <aside id="sidebar-second" class="grid-20 sidebar">
      <?php if ($page['sidebar_second']): ?>
        <?php print render($page['sidebar_second']); ?>
      <?php endif; ?></aside>
  <?php endif; ?>
  <!-- // Sidebar second-->

</main>

<?php
// Define and divide the postscript page regions.
if ($page['postscript_first'] || $page['postscript_second'] || $page['postscript_third']):
  ?>

  <div id="postscript-wrapper">
    <div class="grid-container" id="postscript-container" style="max-width:<?php print $thegrid; ?>">

      <!--Postscript -->
      <?php if (!empty($page['postscript_first'])): ?>
        <div class="<?php print $pos_columns; ?> ">
          <?php print render($page['postscript_first']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['postscript_second'])): ?>
        <div class="<?php print $pos_columns; ?> ">
          <?php print render($page['postscript_second']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($page['postscript_third'])): ?>
        <div class="<?php print $pos_columns; ?> ">
          <?php print render($page['postscript_third']); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>

<?php endif; ?>

<div class="push-sticky"></div>

</div>

<footer id="footer" role="footer">
  <section class="grid-container" style="max-width:<?php print $thegrid; ?>">
    <div class="grid-100">
      <?php if (!empty($page['footer_first'])): ?>
        <?php print render($page['footer_first']); ?>
      <?php endif; ?>
    </div>
  </section>
</footer>
