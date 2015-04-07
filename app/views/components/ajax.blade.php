<script type="text/javascript">
	
jQuery( document ).ready( function( $ ) {
 
    $( 'form' ).on( 'submit', function(event) {
		
		if(this.id == 'basket')
		{
			
			event.preventDefault();
			
			var post_data = $(this).serialize();
			
			$.post(
			  $( this ).prop( 'action' ), post_data,
				function( data ) {
					if(data.status == 'success') {
						//alert(data.msg);
						//var bgcol = $( '#'+data.anim ).css('backgroundColor');
						//var fgcol = $( '#animbadge' ).css('color');
						
						$( '#'+data.anim ).animate({
							backgroundColor: data.color
						}, 200);
						$( '#'+data.anim ).animate({
							backgroundColor: "#777777"
						}, 2000);
						
						if(data.inputbg != "#ffffff")
						{
							$( '#'+data.verb+'-'+data.code ).animate({
							backgroundColor: "#FFFFFF",
							color: "#000000"
							}, 10);
						}
						
						$( '#'+data.verb+'-'+data.code ).animate({
							backgroundColor: data.inputbg,
							color: data.inputfg
						}, 800);

						
						
						document.getElementById(data.anim).innerHTML = data.value;
					}
				},
				'json'
			);
		}

    } );
 
} );
</script>
