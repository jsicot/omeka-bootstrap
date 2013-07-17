<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = get_theme_option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php  endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>
    <?php echo auto_discovery_link_tags(); ?>
    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>    
    <?php
        queue_css_file(array('bootstrap.min','bootstrap-responsive.min','site'));
        echo head_css();
    ?>
    <link rel="shortcut icon" href="<?php echo img('favicon.ico'); ?>" />
    <link href="//fonts.googleapis.com/css?family=Exo:400,500,700|Raleway:100,300,200" rel="stylesheet" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    
    <?php 
        queue_js_file(array('bootstrap.min','jquery.expander','site'),$dir='js');
        echo head_js(); 
    ?>
     <?php if (get_theme_option('Use Google Analytics') == 1): ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo html_entity_decode(get_theme_option('Google Analytics Account')); ?>']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>

<?php endif; ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
<div class="jumbotron masthead">
  <div class="container">
      <div class="row">
   	<div class="span12">
            <div id="site-title">
                <?php echo link_to_home_page(theme_logo()); ?>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="span12">
            <div id="headerPluginHook">
                <?php fire_plugin_hook('public_header'); ?>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">

   			<div class="navbar">
					  <div id="primary-nav" class="navbar-inner">
					    <div class="container">
					      <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </a>
					 <ul class="nav">
					       <li><a href="/"><i class="icon-home icon-white"></i> </a></li>
					</ul>
					      <div class="nav-collapse">
							<?php $nav = public_nav_main(); echo $nav->setUlClass('nav') ?>
                    
		        <ul class="nav pull-right">
		        	<li>                   
                    <?php echo search_form(array('show_advanced' => true)); ?>
					</li>
		        </ul>
			      </div><!-- /.nav-collapse -->
			    </div><!-- /.container -->
        </div>
    </div>
</div>
<div id="content" class="container">
    <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
