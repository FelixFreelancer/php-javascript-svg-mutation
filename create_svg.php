<?php
require_once __DIR__ . '/php-svg-master/autoloader.php';

use SVG\SVG;

$svg = $_POST['svg_file'];
$image = SVG::fromString($svg);
$doc = $image->getDocument();

file_put_contents('test.svg', $image);

echo 1;
?>
