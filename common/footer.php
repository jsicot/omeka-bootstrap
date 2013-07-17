        </div><!-- end content -->

    <div  class="container">
        <div class="row">
            <div class="span12">
            <footer>
           
            <div id="footer" class="row">  </div>
          
            
             <div class="row"  id="footer-text">

				 <?php echo html_entity_decode(get_theme_option('Footer Text')); ?>

             
			 </div>
            <div class="row">
                <div class="span12">
                    <?php fire_plugin_hook('public_footer'); ?>
                </div>
            </div>
            </footer>    
        </div><!-- end footer -->
        </div>
    </div><!-- end wrap -->
</body>
</html>
