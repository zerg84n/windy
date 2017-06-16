jQuery(document).ready(function(){ UIkit.modal();
UIkit.icon(element, options);
});

//для полей цена и мощность http://api.jqueryui.com/slider/
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 1000,
      max: 10000,
      values: [ 4000, 7000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " p. - " + ui.values[ 1 ] + " p." );
      }
    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) + " p." +
      " - " + $( "#slider-range" ).slider( "values", 1 ) + "p." );
	  
	 $( "#slider-range-mosh" ).slider({
      range: true,
      min: 800,
      max: 3000,
      values: [ 1000, 2500 ],
      slide: function( event, ui ) {
        $( "#amount-mosh" ).val( ui.values[ 0 ] + " Вт. - " + ui.values[ 1 ]+ " Вт.");
      }
    });
    $( "#amount-mosh" ).val(  $( "#slider-range-mosh" ).slider( "values", 0 ) + " Вт." +
      " - " + $( "#slider-range-mosh" ).slider( "values", 1 ) + " Вт." );
	  
  } );
 