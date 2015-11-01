<!DOCTYPE html>
<html lang="es">
    <head>
        <title>DWESI Practica 1</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    </head>
    <body>
    	<nav>
    		<img src="resources/logo.ico" id="logo"/>
    		<h id="pagename">Podcast</h>
    		<div id="navlist">
    		<?php
				require './classes/AutoLoad.php';
				$sesion = new Session();
				if($sesion->isLogged()){
					echo '
					<form method="post" action="phplogout.php">
						<p class="submit"><input type="submit" name="commit" value="Logout" class="red"></p>
					</form>
    				<h><a href="upload.php">Upload</a></h>
    				<h><a href="myfiles.php">MyFiles</a></h>
					';
				} else {
					header("Location:index.php");
					exit();
				}
			?>
				<h><a href="index.php">Home</a></h>
			</div>
    		<div class="clear"></div>
    	</nav>
    	<div class="content">
    	
    		<div class="podcast">
    			<?php
					$print = false;
					$sound = scandir("./data/audio/");
					$img = scandir("./data/img/");
					for($i = 2; $i<count($sound); $i++){
						$name = explode(".", explode("_", $sound[$i])[2])[0];
						$cat = explode("_", $sound[$i])[1];
						$aut = explode("_", $sound[$i])[0];
						if(Request::get("search") == $name || Request::get("search") === null || Request::get("search") === ""){
							if($sesion->getUser() == $aut){
								if(Request::get("category") == $cat || Request::get("category") === null){
									$print = true;
								} else {
									$print = false;
								}
							} else {
								$print = false;
							}
						} else {
							$print = false;
						}
						if($print) {
							echo "
							<div class='item'>
								<h class='title'>$name</h>
								<img src='./data/img/$img[$i]'/>
								<h class='cat'><strong>Category: </strong>$cat</h>
								<h class='aut'><strong> Author: </strong>$aut</h>
								<audio controls>
									<source src='./data/audio/$sound[$i]'>
									Your browser does not support the audio element.
								</audio>
							</div>
							";
						}
					}
				?>

    		</div>
    		
    		<form class="form-style-9" method="get" action="myfiles.php">
				<ul>
					<li>
						<input type="text" name="search" class="field-style field-full align-none" placeholder="Search" />
					</li>
					
					<span class="title">Categorys:</span>
					<li>
					<input type="radio" name="category" id="radio4" class="radio" value="Uncategorized"/>
					<label for="radio4">Uncategorized</label>
					</li>
					<li>
					<input type="radio" name="category" id="radio5" class="radio" value="Heavy Metal"/>
					<label for="radio5">Heavy Metal</label>
					</li>
					<li>	
					<input type="radio" name="category" id="radio6" class="radio" value="Rock"/>
					<label for="radio6">Rock</label>
					</li>
					<li>
					<input type="radio" name="category" id="radio7" class="radio" value="Hip-Hop"/>
					<label for="radio7">Hip-Hop</label>
					</li>
					<li>
					<input type="radio" name="category" id="radio8" class="radio" value="Reggae"/>
					<label for="radio8">Reggae</label>
					</li>
					<li>	
					<input type="radio" name="category" id="radio9" class="radio" value="House"/>
					<label for="radio9">House</label>
					</li>
					
					<li>
						<input type="submit" value="Search" />
					</li>
				</ul>
			</form>
    		
    	</div>
    	
    	<footer>
    		<h class="left">DWESI Practice 1 - Podcast</h>
    		<h class="right">Designed by David Gamarra</h>
    	</footer>
    </body>
</html>