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
    		<div class="form-style-2">
    		<?php
				if(Request::get("uploaded") === "correct"){
					echo '<h class="green">File uploaded successfully</h>';
				} else if(Request::get("uploaded") === "incorrect"){
					echo '<h class="red">Error in file upload</h>';
				}
			?>
			<div class="form-style-2-heading">Provide your music information</div>
			<form action="phpupload.php" method="post" enctype="multipart/form-data">
				<label><span>Name <span class="required">*</span></span>
					<input type="text" class="input-field" name="name" value="" required/>
				</label>

				<label><span>Category</span>
					<select name="category" class="select-field">
						<option value="Uncategorized">Uncategorized</option>
						<option value="Heavy Metal">Heavy Metal</option>
						<option value="Rock">Rock</option>
						<option value="Hip-Hop">Hip-Hop</option>
						<option value="Reggae">Reggae</option>
						<option value="House">House</option>
					</select>
				</label>
				
				<label><span>Music (mp3)<span class="required">*</span></span>
					<input type="file" name="music" class="input-field custom-file-input" required/>
				</label>
				
				<label><span>Image (jpg)</span>
					<input type="file" name="image" class="input-field custom-file-input"/>
				</label>

				<label><span>&nbsp;</span><input type="submit" value="Submit" /></label>
			</form>
			</div>
   	
   			<form class="form-style-9" method="get" action="index.php">
				<ul>
					<li>
						<input type="text" name="search" class="field-style field-full align-none" placeholder="Search" />
					</li>

					<span class="title">Users:</span>
					<li>
					<input type="radio" name="user" id="radio1" class="radio" value="Juanito"/>
					<label for="radio1">Juanito</label>
					</li>
					<li>
					<input type="radio" name="user" id="radio2" class="radio" value="Manolo"/>
					<label for="radio2">Manolo</label>
					</li>
					<li>	
					<input type="radio" name="user" id="radio3" class="radio" value="Pedro"/>
					<label for="radio3">Pedro</label>
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