<?php

if (elgg_is_logged_in())
{
forward ('activity');
}
?>
<!DOCTYPE HTML>
<!--
	
-->
<html>
	<head>
		<title>Teranga Go! - UGR - Rosana Montes</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="mod/teranga_theme/js/jquery.min.js"></script>
		<script src="mod/teranga_theme/js/jquery.dropotron.min.js"></script>
		<script src="mod/teranga_theme/js/jquery.scrollgress.min.js"></script>
		<script src="mod/teranga_theme/js/skel.min.js"></script>
		<script src="mod/teranga_theme/js/skel-layers.min.js"></script>
		<script src="mod/teranga_theme/js/init.js"></script>
		<link rel="stylesheet" type="text/css" href="mod/teranga_theme/css/form_style.css" />
		<link rel="stylesheet" href="mod/teranga_theme/css/skel.css" />
		<link rel="stylesheet" href="mod/teranga_theme/css/style.css" />
		<link rel="stylesheet" href="mod/teranga_theme/css/style-wide.css" />
		
		<!--[if lte IE 8]><link rel="stylesheet" href="mod/teranga_theme/css/ie/v8.css" /><![endif]-->
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<nav id="nav">
					<ul>
						<li><a href="register/">Registrate</a></li>
						
						<li><a href="forgotpassword/" class="button">Recordar contraseña</a></li>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				
				<h2><img src="mod/teranga_theme/images/logo.png" alt="Teranga Go!"></h2>
                                
			<section class="main">
				<form class="form-3" action="action/login" method="post">
<?php
$ts = time();
$token = generate_action_token($ts);
?>
				    <p class="clearfix">
				        <label for="login">Username</label>
				        <input type="text" name="username" id="login" placeholder="Username">
				    </p>
				    <p class="clearfix">
				        <label for="password">Password</label>
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>

<input type="hidden" name="__elgg_token" value="<?php echo $token; ?>"/>
<input type="hidden" name="__elgg_ts" value="<?php echo $ts; ?>" />
    
				    <p class="clearfix">
                                      <center>
				        <input type="submit" name="submit" value="Entrar">
                                          </center>
				    </p>       
				</form>​
			</section>
				
			</section>

		<!-- Main -->
			<section id="main" class="container">
		
				<section class="box special">
					<header class="major">
						<h2>“Siempre terminamos llegando a donde nos esperan”</br>
(Libro de los Itinerarios)	
</h2>
					
					</header>
					<span class="image featured"><img src="mod/teranga_theme/images/pic01.jpg" alt="" /></span>
				</section>
						
					
				<div class="row">
					<div class="6u">

						<section class="box special">
							<span class="image featured"><img src="mod/teranga_theme/images/pic05.jpg" alt="" /></span>

							<h3>Quiénes somos</h3>
							<p>Para que nos pongas cara, nos presentamos: somos Augustin Ndour, senegalés, y Gustavo Gómez, español. Nos conocimos rodando un corto. Nos hicimos amigos. Y juntos arrancamos este proyecto. <br>

Puedes conocer más sobre nosotros aquí <a href="http://bit.ly/1Ho9sU7" target="_blank">http://bit.ly/1Ho9sU7</a> y aquí <a href="http://linkd.in/1LJGgtU" target="_blank">http://linkd.in/1LJGgtU</a>.</p>

							<h3>Ambos, compartimos un sueño</h3>
							<p>Facilitar la movilidad de los migrantes. Por eso, hemos puesto en marcha Teranga GO!: una red social que pone en contacto a personas, migrantes fundamentalmente, que comparten vehículo en los desplazamientos entre sus países de origen y acogida.

							<ul class="actions">
								<li><a href="#" class="button alt">Leer Más</a></li>
							</ul>
						</section>
						
					</div>
					<div class="6u">

						<section class="box special">
							<span class="image featured"><img src="mod/teranga_theme/images/pic02.jpg" alt="" /></span>

							<h3>Teranga significa hospitalidad</h3>
							<p>Teranga es una palabra wolof que significa hospitalidad. Senegal es el país de la hospitalidad. Este proyecto tiene marcado en su ADN esa filosofía y le añade como apellido GO!, porque el movimiento nos condiciona. Por eso, sumamos una frase que admiramos y compartimos:
“Siempre terminamos llegando a donde nos esperan” (Libro de los Itinerarios).<br>

¿Existe un mejor ánimo para embarcarse en un viaje?</p>
							<ul class="actions">
								<li><a href="#" class="button alt">Leer Más</a></li>
							</ul>
						</section>

					</div>
				</div>

				<div class="row">
					<div class="6u">

						<section class="box special">
							<span class="image featured"><img src="mod/teranga_theme/images/pic06.jpg" alt="" /></span>

							<h3>Agustín</h3>
							<p>
“Cuando uno decide salir de su cultura y de su pueblo es por puro instinto de supervivencia. Yo suelo insistir mucho que el derecho de no tener que emigrar es el que prevalece. Pero el derecho de emigrar debe tenerlo todo el mundo. El ser humano está hecho para ser libre, no para emigrar o para no dejar de emigrar. En toda la historia de la Humanidad es lo que ha hecho el ser humano, sea asiático, africano o europeo. Siempre, por el instinto de supervivencia, sea personal o colectivo”.
“Hombre, yo, estoy agustico en Granada pero cuando me acuerdo de mi mujer y mis niños que están en Dakar…”
</p>

							<ul class="actions">
								<li><a href="#" class="button alt">Leer Más</a></li>
							</ul>
						</section>
						
					</div>
					<div class="6u">

						<section class="box special">
							<span class="image featured"><img src="mod/teranga_theme/images/pic07.jpg" alt="" /></span>

							<h3>Gustavo</h3>
							<p>“Quería juntar lo personal con lo profesional. Por un lado, siempre he admirado a los emigrantes por la fortaleza que muestran al abrirse camino en lugares tan diferentes a su tierra de origen. Por otra parte, desarrollando aplicaciones en el estudio descubrí su poder globalizador. Las nuestras se han descargado en 160 países diferentes. Por eso, no paraba de pensar qué app podría venir bien a los migrantes. </p>
							<ul class="actions">
								<li><a href="#" class="button alt">Leer Más</a></li>
							</ul>
						</section>

					</div>
				</div>

			</section>

				<section class="box special features">
					<div class="features-row">
						<section>
							<span class="icon major fa-bolt accent2"></span>
							<h3>Economía colaborativa</h3>
							<p>Participamos de una nueva revolución. La UE publicó el dictamen Consumo colaborativo o participativo: un modelo de sostenibilidad para el siglo XXI: “La población adulta, y la ciudadanía en general, a través de la búsqueda y la participación en iniciativas de consumo colaborativo o participativo de las que son destinatarios, pueden desarrollar una acción reactiva que, además, sirva para su realización personal por integración y coadyuve a la cohesión social al compartir colectivamente los bienes comunes.”</p>
						</section>
						<section>
							<span class="icon major fa-area-chart accent3"></span>
							<h3>Empresa social</h3>
							<p>Una empresa con fines sociales, TRG GLOBAL MOBILITY SL, impulsa este proyecto. Debido a su carácter, los estatutos obligan a destinar los beneficios de la mercantil a los siguientes objetivos:
– Contratación de migrantes en sus países de origen.
– Financiación de proyectos desarrollados por migrantes.
– Creación de iniciativas sociales con los migrantes como protagonistas.
– Colaboración con otras iniciativas sociales.</p>
						</section>
					</div>
					<div class="features-row">
						<section>
							<span class="icon major fa-cloud accent4"></span>
							<h3>Turismo de experiencia</h3>
							<p>Queremos incluir en nuestro proyecto a los viajeros que no sólo visitan sino que buscan sentir la piel del lugar al que llegan. Estamos convencidos de que participar en un mismo viaje es la mejor manera de conocerse, intercambiar, respetar, comprender y convivir. ¿Alguna razón más para abrir las puertas de nuestros vehículos a turistas que buscan este tipo de experiencias? A través de muchos kilómetros compartidos surgirán historias, intereses, propuestas y razones donde el otro será el gran protagonista. Juntos en un vehículo, juntos en el mundo.</p>
						</section>
						<section>
							<span class="icon major fa-lock accent5"></span>
							<h3>Equipo multidisciplinar</h3>
							<p>Un multidisciplinar equipo de expertos en diferentes disciplinas nos arropa en la puesta en marcha y desarrollo de esta iniciativa. Si hay una palabra que define a todos es compromiso. Compromiso con hacer la vida más fácil a las personas obligadas a vivir y convivir en un lugar diferente al que nacieron. En una tierra desacostrumbrada: http://bit.ly/1elAEYK</p>
						</section>
					</div>
				</section>
			
		<!-- CTA -->
			<section id="cta">
				
				<h2>El mundo se mueve: GO. Y precisa mucha hospitalidad: Teranga.</h2>
				<p>Por eso, nace Teranga GO!</p>
			      
				
			</section>
			
		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					
					<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="https://github.com/rosanamontes/teranga_elgg" target="_blank" class="icon fa-github">
						<span class="label">You Tube</span></a></li>
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					
				</ul>
				<ul class="copyright">
					<h1><a href="http://lsi.ugr.es/rosana">Rosana Montes</a> Universidad de Granada</h1>
				<li>Powered by ELGG.</li><li>Colabora: <a href="http://www.acentocomunicacion.com/">Acento Comunicación</a></li>
				</ul>
			</footer>

	</body>
</html>
