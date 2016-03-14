<!DOCTYPE html><html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title>
    	<?php
    	if (is_page('Home'))
     		bloginfo('name');
    	elseif (have_posts()) {
     		wp_title('', true);
     		if (wp_title('', false)) {
         		echo ' : ';
     		} bloginfo('name');
    	} else {
     		bloginfo('name');
    	}
    	?>
  </title><?php wp_head(); ?>
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,700|Titillium+Web:400,700,200,300,900,600' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class('clearfix'); ?>>
<div class="mobilecheck"></div>
  <header>
    <div class="container">
      <div class="logo">
        <a href="<?php echo site_url(); ?>" class="logo" title="<?php echo  get_bloginfo(); ?>">
          <h1><?php echo  get_bloginfo(); ?></h1>
          <h2><?php echo  get_bloginfo('description'); ?></h2>
        </a>
      </div>
      <a id="nav-toggle" href="#"><span></span></a>
    </div>   
    <div class="container">
     
      <nav>
         <?php wp_nav_menu(array('depth'=> 1)); ?> 
      </nav>
      </div> 
  </header>