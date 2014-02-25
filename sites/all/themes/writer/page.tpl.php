<div id="wrapper" class="<?php print $wrapper_classes; ?>" <?php print $content_width_rule ?>>
  <?php print render($page['pre_header']); ?>
  <header id="site-header">
  	<div class="head-wrap clearfix">
      <?php if ($logo): ?>
        <div class="logo-wrap">
          <a href="<?php print $front_page; ?>" rel="home" id="logo">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        </div>
      <?php endif; ?>
      <?php if ($site_name || $site_slogan): ?>
        <hgroup class="site-name-wrap">
          <?php if ($site_name): ?>
    	      <h1 id="site-name">
    	        <a href="<?php print $front_page; ?>"><?php print $site_name; ?></a>
    	      </h1>
          <?php endif; ?>
          <?php if ($site_slogan): ?>
            <h2 id="site-slogan"><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        </hgroup>
      <?php endif; ?>
      <nav id="main-nav">
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu',
            'class' => array(
              'links', 'inline', 'clearfix',
            ),
          ),
          'heading' => t('Main menu'),
        )); ?>
      </nav>
	  </div>
	<?php print render($page['header']); ?>
  </header>
  <?php print render($page['post_header']); ?>
  <?php print $messages; ?>
  <section class="main-content">
    <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
  	<a id="main-content"></a>
  	<?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($tabs && ($tabs['#primary'] || $tabs['#secondary'])): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print render($page['content']); ?>
  </section>
  <footer class="page-footer">
  	<?php print render($page['footer_top']); ?>
  	<?php if($page['footer_left'] || $page['footer_right']): ?>
  	  <div class="foot-mid-wrap clearfix">
		    <?php if($page['footer_left']): ?>
		      <div id="footer_left">
		        <?php print render($page['footer_left']); ?>
		      </div>
		    <?php endif; ?>
		    <?php if($page['footer_right']): ?>
			    <div id="footer_right">
			      <?php print render($page['footer_right']); ?>
			    </div>
		    <?php endif; ?>
  		</div>
  	<?php endif; ?>
  	<?php print render($page['footer_bottom']); ?>
  	<div class="foot-wrap clearfix">
      <nav class="foot-links">
    		<?php print theme('links__system_secondary_menu', array(
          'links' => $secondary_menu,
          'attributes' => array(
            'id' => 'secondary-menu',
            'class' => array(
              'links', 'inline', 'clearfix',
            ),
          ),
          'heading' => t('Footer menu'),
        )); ?>
    	</nav>
      <?php if($page['footer_message']): ?>
        <div class="footer-msg">
          <?php print render($page['footer_message']); ?>
        </div>
      <?php endif; ?>
    </div>
  </footer>
</div> <!-- end wrapper -->
