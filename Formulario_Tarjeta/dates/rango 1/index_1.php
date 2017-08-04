<!DOCTYPE html>
<html>
	<head>
		<title>jQuery Datepicker</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

		<link href='datapicker/jquery.datepick.css' rel='stylesheet'>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="datapicker/jquery.plugin.js"></script>
		<script src="datapicker/jquery.datepick.js"></script>

		<script>
			$(function() {
				var fecha = new Date();
				$('#in').datepick(
					{
						dateFormat: 'dd/mm/yyyy',
						minDate: fecha,
						onSelect: seleccionar_checkin,
						yearRange: fecha.getFullYear()+':'+(parseInt(fecha.getFullYear())+1),
						firstDay: 1,
						rangeSelect: true, 
						monthsToShow: [1, 1]
					}
				);
			});

			function seleccionar_checkin(date) {

				console.log( date[0] );
				console.log( date[1] );

				/*if( $('#in').val() != '' ){
					var fecha = new Date();
	                $('#out').attr('disabled', false);
	                var ini = String( $('#in').val() ).split('/');
	                var fin = String( $('#out').val() ).split('/');
	                var checkin = new Date( parseInt(ini[2]), parseInt(ini[1])-1, parseInt(ini[0]) );
	                var checkout = new Date( parseInt(fin[2]), parseInt(fin[1])-1, parseInt(fin[0]) );

	                $('#out').removeClass('is-datepick');
	                $('#out').datepick({
						dateFormat: 'dd/mm/yyyy',
						showTrigger: '#calImg',
						minDate: checkin,
						yearRange: fecha.getFullYear()+':'+(parseInt(fecha.getFullYear())+1),
						firstDay: 1
					});

	                if( Math.abs(checkout.getTime()) < Math.abs(checkin.getTime()) ){
	                    $('#out').datepick( 'setDate', $('#in').val() );
	                }
	            }else{
	                $('#out').val('');
	                $('#out').attr('disabled', true);
	            }*/
			}
		</script>

		<style>
			#item_23_8_2017,
			#item_24_8_2017
			{
				background: #FFF;
				color: #000;
			}

			#item_24_8_2017:before
			{
				content: "";
			    position: absolute;
			    top: 0;
			    left: 0;
			    width: 0;
			    height: 0;
			    border-top: 2.5em solid #C96259;
			    border-right: 2.5em solid transparent;
			    z-index: -10;
			    opacity: .75;
			}
		</style>
	</head>
	<body>
		<div id='in'></div>
	</body>
</html>