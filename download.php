<?php
/*
 * Project: Html Generator
 * Author: delvedor
 * Site: http://projects.delved.org/htmlGenerator
 * GitHub: https://github.com/delvedor
 */


/*
 * Variables declaration.
 */
 
$file = "";

$doctypeArray = array(
    'html5' => '<!DOCTYPE html>',
    'html401strict' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
    'html401transitional' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
    'html401frameset' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
    'xhtml10strict' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
    'xhtml10transitional' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
    'xhtml10frameset' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
    'xhtml11' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
    'comment' => 'noComment'   
);

$metaArray = array(
	'charsetutf-8' => "\t\t".'<meta charset="UTF-8">',
	'charsetiso-8859-1' => "\t\t".'<meta charset="ISO-8859-1">',
	'viewport' => "\t\t".'<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />',
	'comment' => '<!-- Meta -->'
);

$cssArray = array(
	'reset' => "\t\t".'<link rel="stylesheet" href="https://raw.githubusercontent.com/jasonkarns/css-reset/master/reset.css" media="all"/>',
	'comment' => '<!-- Stylesheet -->'
);

$jsArray = array(
	'jquery1110' => "\t\t".'<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>  ',
	'angular' => "\t\t".'<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>',
	'modernizr' => "\t\t".'<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>',
	'prototype' => "\t\t".'<script src="http://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js"></script>',
	'scriptaculous' => "\t\t".'<script src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js"></script>',
	'comment' => '<!-- Script -->'
);

$frameworkArray = array(
	'bootstrap' => "\t\t".'<link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet" type="text/css" />'."\n\t\t".'<script src="http://getbootstrap.com/dist/js/bootstrap.js"></script>',
	'jqueryui1110' => "\t\t".'<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />'."\n\t\t".'<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>',
	'comment' => '<!-- Framework -->'
);


/*
 * Get the components.
 */
if(isset($_POST['doctypeInput'])){
	$doctype = $_POST['doctypeInput'];
	writeFile(setContent($doctype, $doctypeArray), "begin");
} else {
	$doctype = "error doctype\n";
	writeFile($doctype, "begin");
}

if(isset($_POST['metaInput'])){
	$meta = $_POST['metaInput'];
	writeFile(setContent($meta, $metaArray), "middle");
} else {
	$meta = "error meta\n";
	writeFile($meta, "middle");
}

if(isset($_POST['cssInput'])){
	$css = $_POST['cssInput'];
	writeFile(setContent($css, $cssArray), "middle");
} else {
	$css = "error css\n";
	writeFile($css, "middle");
}

if(isset($_POST['jsInput'])){
	$js = $_POST['jsInput'];
	writeFile(setContent($js, $jsArray), "middle");
} else {
	$js = "error js\n";
	writeFile($js, "middle");
}

if(isset($_POST['frameworkInput'])){
	$framework = $_POST['frameworkInput'];
	writeFile(setContent($framework, $frameworkArray), "end");
} else {
	$framework = "error js\n";
	writeFile($js, "end");
}

if(isset($_POST['filenameInput'])){
	$filename = $_POST['filenameInput'];
	downloadFile($filename.".html");
} else {
	downloadFile("file.html");
} 


/*
 * Functions.
 */
 
function writeFile($content, $position) {
	global $file;
	
	if ($position == "begin") {
		$file = $content."<html>\n\t<head>\n";
		
	} else if ($position == "middle") {
		$file = $file.$content."\n";
		
	} else {
		$file = $file.$content."\n\t\t<title></title>\n\t</head>\n\t<body>\n\t</body>\n</html>";
	}

}

function downloadFile($filename) {
	global $file; 
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-disposition: attachment; filename="'.basename($filename).'";');
    header('Content-Length: '.strlen($file));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    header('Pragma: public');
    echo $file;
    exit;	
}


function setContent($content, $arrayStampContent) {
	$arrayContent = explode('#', $content);
	$content = "";
	
	foreach($arrayContent as $keyContent => $valueContent) {
		foreach($arrayStampContent as $key => $value) {
			if ($valueContent == $key){
				$content = $content.$value."\n";
				break;
			}
		}
	}
	if (end($arrayStampContent) == "noComment") {
		return $content;
	} else {
		return end($arrayStampContent)."\n".$content;
	}
}


?>