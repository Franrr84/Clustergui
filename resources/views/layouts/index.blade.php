@extends ('layouts.admin')
@section ('contenido')
<html>
  <head>
  	<?php
  		use Leanxcale\ConjuntoMaquinas;
  		use Leanxcale\ConjuntoComponentes;

      	$gm = new ConjuntoMaquinas();
      	$gc = new ConjuntoComponentes();
      	$operacion = $gm->iniciarConjunto();

      	if($operacion != "FALSE"){
      		$operacion = $gc->iniciarConjunto($gm);
      		if($operacion != "FALSE"){
      			$cont_ok=0.0;
      			$cont_war=0.0;
      			$cont_err=0.0;
      			$cont=0.0;
      			for($i=0;$i<$gm->num_maquinas;$i++){
      				$estado=$gm->getPorcentajeMaquinas($i,$gc);
      				if($estado == 1.0){
      					$cont_ok++;
      				}
      				else{
      					if($estado == 0.0){
      						$cont_err++;
      					}
      					else{
      						$cont_war++;
      					}
      				}
      				$cont++;
      			}
      			if($cont > 0.0){
      				$maq_ok= ($cont_ok/$cont) * 100;
      				$maq_war= ($cont_war/$cont) * 100;
      				$maq_err= ($cont_err/$cont) * 100;
      				$com_ok= $gc->getPorcentajeComponentes() * 100;
      				$com_err= 100 - ($gc->getPorcentajeComponentes() * 100);
      			}
      			//Si todas las maquinas están apagadas
      			else{
      				$maq_ok=0;
      				$maq_war=0;
      				$maq_err=100;
      				$com_ok=0;
      				$com_err=100;
      			}
      			
      		}
      		//Si falla la lectura de checkcluster.out
      		else{
      			$maq_ok=0;
      			$maq_war=0;
      			$maq_err=100;
      			$com_ok=0;
      			$com_err=100;
      		}
      	}
      	//Si falla la lectura de inventory
      	else{
      		$maq_ok=0;
      		$maq_war=0;
      		$maq_err=100;
      		$com_ok=0;
      		$com_err=100;
      	}
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);



      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Estado maquinas'],
          ['ON', <?php echo $maq_ok; ?> ],
          ['WARNING', <?php echo $maq_war; ?> ],
          ['OFF', <?php echo $maq_err; ?> ]
        ]);

        var options = {
          title: 'Maquinas',
          'width':400,
          'height':300,
          legend: { position: 'bottom', alignment: 'center' },
          slices: {

            0: { color: '#33cc33' },
            1: { color: '#ffcc00' },
            2: { color: '#770000' }
          },
          titleTextStyle: {
        	fontSize: 18
    	  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('maquinas'));
        chart.draw(data, options);

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Estado componentes'],
          ['ON', <?php echo $com_ok; ?> ],
          ['OFF', <?php echo $com_err; ?> ]
        ]);

        var options = {
          title: 'Componentes',
          'width':400,
          'height':300,
          legend: { position: 'bottom', alignment: 'center' },
          slices: {
            0: { color: '#33cc33' },
            1: { color: '#770000' }
          },
          titleTextStyle: {
        	fontSize: 18
    	  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('componentes'));
        chart.draw(data, options);
      }
    </script>

  </head>

  <body>
    <div class="container">
    	<div class="row">
      		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      			<div id="maquinas"></div>
      		</div>
      		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      			<div id="componentes"></div>
      		</div>
    	</div>
    </div>
  </body>
</html>

@stop