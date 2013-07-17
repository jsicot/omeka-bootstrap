/* 
 * @copyright Garrick S. Bodine, 2012
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

jQuery(document).ready(function($){
    
    // for theming the form helper buttons with Bootstrap button defaults classes
    $("#submit_search").addClass("btn"); // for theming the search button with Bootstrap button defaults
    
    // for adding the 'active' class, which is Bootstrap's equivalent of Omeka's 'current' class for on-current-page links
    $(".current").addClass("active");
    
    $('.carousel').carousel();
    
    // making tags look like labels and adding the icons
    $('a[rel="tag"]').addClass("label label-inverse").prepend('<i class="icon-tag icon-white"></i> ');
    $(".popular").addClass("btn btn-mini").prepend('<i class="icon-tag"></i> ');
    $('.v-popular,.vv-popular,.vvv-popular').addClass("btn btn-small").prepend('<i class="icon-tag"></i> ');
    $('.vvvv-popular,.vvvvv-popular,.vvvvvv-popular').addClass("btn").prepend('<i class="icon-tag"></i> ');
    $('.vvvvvvv-popular,.vvvvvvvv-popular').addClass("btn btn-large").prepend('<i class="icon-tag"></i> ');
    
    $('.dropdown-toggle').dropdown();
    
    // activating popovers on desired page boxen
    $('.pop-box').popover();
    
    $(".tooltipper").tooltip();
    
    $("#primary-nav .active a").prepend('<i class="icon-caret-right"></i> ');
    
    $("div#search-filters > ul > li").each(function() {
    	$(this).prepend('<i class="icon-search"></i> ');
    });
$('.toolong').expander({
  slicePoint: 280,
  preserveWords: true,
  widow: 2,
  expandEffect: 'fadeIn',
  userCollapseEffect: 'fadeOut',
  expandText: '<i class="icon-plus-sign"></i> Voir plus',
  userCollapseText: '<i class="icon-minus-sign"></i> Voir moins <br /><br />'
});
})

