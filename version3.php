<?php
require_once __DIR__ . '/php-svg-master/autoloader.php';

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;

$svg_width = 175;
$svg_height = 75;
$offset_row = 30;
$offset_column = 20;

$image = SVG::fromFile('php_test.svg');
$flag = SVG::fromFile('flag.svg');
$doc = $image->getDocument();
$doc->setAttribute('width', $svg_width.'px');
$doc->setAttribute('height', $svg_height.'px');

$flag_doc = $flag->getDocument();
$flag_doc->setAttribute('width', $svg_width.'px');
$flag_doc->setAttribute('height', $svg_height.'px');
$flag_doc->setAttribute('viewbox', $svg_width.' 0 '.$svg_width.' '.$svg_height);

$address_square = new SVG($svg_width * 2 - 30, ($svg_height + $offset_column) * 7);
$address_rect_doc = $address_square->getDocument() ;
$address_rect = new SVGRect(0,0, $svg_width * 2 - 30 , ($svg_height + $offset_column) * 7 - $offset_column) ;
$address_rect -> setStyle('fill', 'none') ;
$address_rect -> setStyle('stroke', 'black') ;
$address_rect -> setStyle('rx', '10');
$address_rect_doc -> addChild($address_rect) ;

$details_square = new SVG($svg_width + 50, ($svg_height + $offset_column) * 4) ;
$details_rect_doc = $details_square -> getDocument();
$details_rect = new SVGRect(0,0, $svg_width + 50, ($svg_height + $offset_column) * 4 - $offset_column) ;
$details_rect -> setStyle('fill', 'none') ;
$details_rect -> setStyle('stroke', 'black') ;
$details_rect -> setStyle('rx', '10');
$details_rect_doc ->addChild($details_rect) ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<style>
    .sample_svg {
        text-align: center;
        margin: 0 auto;
    }
    .margin-width-auto {
        margin: 0 auto;
    }
    #all_svgs {
        width: 1024px;
        height: 1800px;
    }
    .layout-form-control {
        margin: 0 auto;
        width: fit-content;
    }
    .svg-container {
        display: flex;
        margin-top: 50px;
    }
</style>
<script>
	$(document).ready(function () {

		$('#create_svg_file').on('click', function (e) {
           // alert();
            e.preventDefault();
            var create_svg = $('#svg_container').html();
			//alert(create_svg);
            $.post('create_svg.php', {
	            svg_file : create_svg
            },  function (data) {
                if (data == 1){
                	alert('successful save');
                }
            })
		})
	});
</script>
<body>
<div class="sample_svg">
    <?php echo $image ?>
    <h2>Sample SVG</h2>
</div>
<div class="container">
    <form class="layout-form-control">
        <input type="text" id="address_value" placeholder="Input the address">
        <button id="generate_btn" type="button">Ok</button>
        <button id="create_svg_file">Create as a SVG file</button>

    </form>
    <div class="svg-container" id="svg_container">
        <svg class="margin-width-auto" xmlns="http://www.w3.org/2000/svg" id="all_svgs">
            <g transform="translate(0, 0)">
                    <?php  echo $image ;?>
            </g>
            <g transform="translate(<?php echo $svg_width?>,0)">
                <?php echo $flag?>
            </g>
            <?php

			$trans_row = 0 ;
			$trans_column = 0 ;
            for ( $row = 0; $row < 6; $row++ ) {
                if ($row === 0) {
                    $trans_column = $row * $svg_height + $svg_height + $offset_column;
                }else {
                    $trans_column = $row * ($svg_height + $offset_column ) + $svg_height + $offset_column ;
                }
                for ( $column = 0; $column < 2; $column++) {
                    if ( $column === 0) {
                        $trans_row = $column* $svg_width;
                    }else {
                        $trans_row = $column * ($svg_width + $offset_row) ;
                    }
                    echo '<g transform="translate('.$trans_row.', '.$trans_column.')">';
                    echo $image;
                    echo '</g>' ;
                }
			}
            ?>
            <g transform="translate(<?php echo ($svg_width + $offset_row) * 2 ?>, 0)">
                <?php echo $address_square ?>
            </g>

            <g transform="translate(<?php echo ($svg_width + $offset_row) * 4 - 70 ?>, 0)">
                <?php  echo $details_square?>
            </g>
            <?php
                $trans_row = 4 * ($svg_width + $offset_column) + $offset_column;
                for ($row = 3 ; $row < 6 ; $row ++) {
                       $trans_column = $row * ($svg_height + $offset_column ) + $svg_height + $offset_column ;
                        echo '<g transform="translate('.$trans_row.', '.$trans_column.')">';
                        echo $image;
                        echo '</g>' ;
                }
            ?>
            <g transform="translate(0,<?php echo 6 * ($svg_height + $offset_column )  + $offset_column ?> )" >
                <?php
                for ( $row = 0; $row < 6; $row++ ) {
                    if ($row === 0) {
                        $trans_column = $row * $svg_height + $svg_height ;
                    }else {
                        $trans_column = $row * ($svg_height + $offset_column ) + $svg_height  ;
                    }
                    for ( $column = 0; $column < 5; $column++) {
                        if ( $column === 0) {
                            $trans_row = $column* $svg_width;
                        }else {
                            $trans_row = $column * ($svg_width + $offset_row) ;
                        }
                        echo '<g transform="translate('.$trans_row.', '.$trans_column.')">';
                        echo $image;
                        echo '</g>' ;
                    }
                }
                ?>
            </g>
        </svg>
    </div>
</div>

</body>
</html>

