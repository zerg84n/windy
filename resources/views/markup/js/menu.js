jQuery(document).ready(function(){
	jQuery('ul.main-ul>li').hover(function(){     
		 jQuery(this).find(".nav-drop-down").show();
		 }, 
		function () {
		 jQuery(this).find(".nav-drop-down").hide();
		 }
				 
	 ) ;
});