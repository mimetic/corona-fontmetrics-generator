<?php

/*
queryFontMetrics(): 

characterWidth: maximum character ("em") width
characterHeight: maximum character height
ascender: the height of character ascensions (i.e. the straight bit on a 'b')
descender: the height of character descensions (i.e. the straight bit on a 'p')
textWidth: width of drawn text in pixels
textHeight: height of drawn text in pixels
maxHorizontalAdvance: maximum pixels from start of one character to start of the next
boundingBox: array of x1, y1, x2, y2 bounding borders
originX, originY: ?

originX seems to shadow the textWidth field, and originY has been zero thus far in my exploration.

*/



// Size of type in points
$fontsize = 72;

print ("<h1>Font metrics</h1>");

print "<p>This page generates font metrics for the Photobook type engine. <i>(note: this PHP script requires ImageMagick to work.)</i></p>
	<p>You must put a copy of your fonts into the 'fonts' directory alongside the PHP script.</p>
	<p>Copy everything after the horizontal line and save it as your fontmetrics.txt file.</p>
	<p> </p>
	<p><a href='info.html'>More information</a>
	";


print "<hr>";

/* Create a new Imagick object */
$im = new Imagick();

// iPad 1 resolution
$res = 72;
$im->setResolution($res,$res);

/* Create an ImagickDraw object */
$draw = new ImagickDraw();

$printreport = isset($_REQUEST['report']);



		print "### fontname = ";
		print "sampledFontSize, ";
		print "characterWidth, ";
		print "characterHeight, ";
		print "ascender, ";
		print "descender, ";
		print "textWidth, ";
		print "textHeight, ";
		print "maxHorizontalAdvance, ";
		print "originX, ";
		print "originY";
		print "BoundingBox.x1";
		print "BoundingBox.y1";
		print "BoundingBox.x2";
		print "BoundingBox.y2";
		print "<br><br>";



foreach (glob("fonts/*") as $fontfilename) {

	
	$fontname = basename($fontfilename);
	$fontname = preg_replace("/\..*?$/","",$fontname);
	
	/* Set the font */
	//$draw->setFont('HollywoodDecoSG-Medium.ttf');
	$draw->setFont($fontfilename);
	
	$ptsize = $fontsize * ($res/72);
	
	$draw->setFontSize($fontsize);
	
	$draw->setFillColor('#ff0000');
	
	/* Dump the font metrics, autodetect multiline */
	$metrics = $im->queryFontMetrics($draw, "X");
	
//var_dump($metrics);
	
	$metrics['sampledFontSize'] = $fontsize;
	
	if ($printreport) {
		print "<hr>";
		print "Font name: $fontname<br>";
		print "Font size: $fontsize pt,  $ptsize pixels <BR>";
		print "<br>";
		
		$t = print_r($metrics, true);
		$t = str_replace("\n", "<br/>\n", $t);
		$t = str_replace("\r", "<br/>\n", $t);
		print $t;

		/*
		while ( list($k,$v) = each ($metrics)) {
			if (is_array($v) ) {
				while ( list($kk,$vv) = each ($v)) {
					print "$k = $v<br>";

			print "$k = $v<br>";
		}
		*/
	} else {
		// Print font metrics file for PhotoBook
		print "$fontname = ";
	
		print $metrics['sampledFontSize'] . ", ";

		print $metrics['characterWidth'] . ", ";
		print $metrics['characterHeight'] . ", ";
		print $metrics['ascender'] . ", ";
		print $metrics['descender'] . ", ";
		print $metrics['textWidth'] . ", ";
		print $metrics['textHeight'] . ", ";
		print $metrics['maxHorizontalAdvance'] . ", ";
		print $metrics['originX'] . ", ";
		print $metrics['originY'] . ", ";

		print $metrics['boundingBox']['x1'] . ", ";
		print $metrics['boundingBox']['y1'] . ", ";
		print $metrics['boundingBox']['x2'] . ", ";
		print $metrics['boundingBox']['y2'] ;
		
		
		print "<br>";
	
	}


}

?>