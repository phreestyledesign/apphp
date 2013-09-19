<?php
/**
* @project ApPHP MicroCMS
* @copyright (c) 2009 - 2013 ApPHP
* @author ApPHP <info@apphp.com>
* @license http://www.gnu.org/licenses/
*/

// *** Make sure the file isn't accessed directly
defined('APPHP_EXEC') or die('Restricted Access');
//--------------------------------------------------------------------------

header('content-type: text/html; charset=utf-8');
?>

<!DOCTYPE HTML>
<head>
<base href="http://192.168.1.104/staticDesign/" />

<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="PhreestyleDESIGN" />
<meta name="Generator" content="&copy; 2010 - Phreestyledesign http://phreestyledesign.com" />

<link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css" media="screen" />
<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />

<title>static design template</title>
</head>
<body>
<div id="wrapper">
<div id="header">
	<h1>
		<a href="#">PhreestyleDESIGN</a>
	</h1>
</div><!-- end header -->

<div id="navcontainer">
		<ul id='navlist'>
		<?php 
			#// Draw top menu
			Menu::DrawTopMenu();	
		?>		  
		</ul>		
	</div><!-- end navcontainer -->

<div id="content">
	<div id="sidebar">
		<ul>
<li>sidebar here</li>
</ul>
	</div><!-- end sidebar -->

	<div id="main">
		<p><?php echo "this is the page"; ?></p>
	</div><!-- end main -->

</div><!-- end content -->

<div id="footer">
	<div id="palette">
	<div class="colourblock" style= "background: #fff;"></div>
	<div class="colourblock" style= "background: #990;"></div>
	<div class="colourblock" style= "background: #444;"></div>
	<div class="colourblock" style= "background: #333;"></div>
	<div class="colourblock" style= "background: #222;"></div>
	<div class="colourblock" style= "background: #000;"></div>
	</div><!-- end palette -->

<div id="linkback"><a href="http://phreestyledesign.com">PhreestyleDESIGN</a> &copy; 
	<?php 
		$startCopyRight='1998';
		if(date('Y') == $startCopyRight)
		{
			echo $startCopyRight;
		}
		else
		{
			echo $startCopyRight.'-'. date('Y');
		} 
		?> 
	</div><!-- end linkback -->

</div><!-- end footer -->
</div><!-- end wrapper -->
</body>
</html>
