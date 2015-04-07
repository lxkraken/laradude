    <!-- Bootstrap core CSS -->
    <!-- link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" -->
    <link media="all" type="text/css" rel="stylesheet" href="http://distributiondude.ca/bootstrap/dist/css/bootstrap.min.css">
 
    <!-- Bootstrap theme -->
    <!-- link href="../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet" -->
	<link media="all" type="text/css" rel="stylesheet" href="http://distributiondude.ca/bootstrap/dist/css/bootstrap-theme.min.css">
 
    <!-- Custom styles for this template -->
    <link media="all" type="text/css" rel="stylesheet" href="http://distributiondude.ca/theme.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://distributiondude.ca/js/jquery-1.11.2.min.js"></script>
	<script src="http://distributiondude.ca/bootstrap-touchspin-master/bootstrap-touchspin/bootstrap.touchspin.js"></script>   

<script type="text/javascript">
	
jQuery( document ).ready( function( $ ) {
 
    $( '#basket' ).on( 'submit', function() {
 
        //.....
        //show some spinner etc to indicate operation in progress
        //.....
 
        $.post(
            $( this ).prop( 'action' ),
            {
                "_token": $( this ).find( 'input[name=_token]' ).val(),
                "verb": $( '#verb' ).val(),
                "code": $( '#code' ).val(),
                "qty": $('#buy-UBIHA01' ).val()
            },
            function( data ) {
                //alert(data.msg);
            },
            'json'
        );
 
        //.....
        //do anything else you might want to do
        //.....
 
        //prevent the form from actually submitting in browser
        return false;
    } );
 
} );
</script>

<div style="width:100px;margin-left:auto;margin-right:auto;">
	Quantity: <span id="qty">0</span>
	
    {{ Form::open( array(
        'route' => 'ajax.update',
        'method' => 'post',
        'id' => 'basket'
    ) ) }}
    
    <input id="verb" name="verb" value="buy" type="hidden">
    <input id="code" name="code" value="UBIHA01" type="hidden">
    <input id="qty" type="text" class="form-control" name="buy-UBIHA01" value="1" style="width:50px;">

 <script>
	$("input[name='buy-UBIHA01']").TouchSpin({
	  min: 1
	});
  </script>   
     
    <button type="submit" id="submit" class="btn btn-success btn-sm" style="margin-top:20px;"><span class="glyphicon glyphicon-shopping-cart"></span> Acheter</button>
     
    {{ Form::close() }}


</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://distributiondude.ca/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="http://distributiondude.ca/bootstrap/assets/js/docs.min.js"></script>
