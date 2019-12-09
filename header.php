<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> </title>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/fontawesome.js"></script>
</head>
<body>


<!-- Nav - Меню и шапка сайта -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" style="height: 150px;">
	<div class="container-fluid">
		<a href="index.php" class="navbar-brand"><img src="img/logo.gif" style="height: 100px;"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive"> 
			<!-- прятает меню на маленьких устройствах и при сужении экрана -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">	
				<a href="manage_store.php" class="nav-link"><br>На случай форс-мажора</a>								
				</li>								
				<li class="nav-item" style="width: 200px;">				
					<center> <br>Сегодня 
					<?php		
						$time = time();								
						echo date("d.m.Y").'<br>';						
							function getDayRus(){								
								$days = array( 'Воскресенье', 'Понедельник', 'Вторник', 'Среда','Четверг', 'Пятница', 'Суббота');
								return $days[(date('w'))];
							}
							echo getDayRus();						
					?>
					</center>				
				</li>											
				<li class="nav-item active">				
					<center> <br> Привет <font color="GREEN">
					<?php
						include_once("bd.php");
						if (empty($login)){ echo 'гость';}
							else{echo $login;
					}
					?>
					</font></center>				
				</li>
				<?php
				if (empty($login)){	
					?>
				<li class="nav-item">					
					<a href="form_auth.php" class="nav-link"><br>АВТОРИЗАЦИЯ</a>
				</li>
				<?php
			}
				include_once("bd.php");
				if (empty($login)){	
				?>				
				<li class="nav-item">
					<a href="form_reg.php" class="nav-link">РЕГИСТРАЦИЯ</a>
				</li>
				<?php
				}
				else
				{
				?>
				<li class="nav-item">
					<a href="form_reg.php" class="nav-link">ЗАРЕГИСТРИРОВАТЬ<br>НОВОГО<br>ПОЛЬЗОВАТЕЛЯ</a>
				</li>
				<?php
				}

				if (!empty($login)){	

				?>				
				<li class="nav-item">
					<a href="manage_store.php" class="nav-link">СКЛАД</a>
				</li>				
				<?php
				}
						if (!empty($login)){					
					?>
				<li class="nav-item">
					<a href="exit.php" class="nav-link">Выход</a>
				</li>
				<?php 
			}
			?>
			</ul>
		</div>
	</div>
	</nav>

<!-- Scripts -->
            <script src="js/jquery-1.9.1.min.js"></script>
            <script src="bootstrap/js/bootstrap.min.js"></script>
            <script src="js/less.min.js"></script>
            <script src="js/owl-carousel/owl.carousel.min.js"></script>
            <script src="js/sns-extend.js"></script>
            <script src="js/custom.js"></script>
   </body>
</html>