<?php
require_once __DIR__ . '/php-svg-master/autoloader.php';
require_once __DIR__ . '/php-svg-master/src/EasySVG.php';

use SVG\SVG;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Texts\SVGText;
use SVG\Nodes\Structures\SVGFont;

$spacing = 2;
$trans_X = 0;
$trans_Y = 0;

$sample_svg_width = 357;
$sample_svg_height = 154;
$svg_width = 30;
$svg_height = 13;
$logo_width = 82;
$logo_height = 28;
$main_detail_width = 62;
$main_detail_height = 25;
$tall_detail_width = 18;
$tall_detail_height = 85;
$small_detail_width = 73;
$small_detail_height = 10;
$address_width = 40;
$address_height = 102;
$boundary_text_width = ($svg_width + $spacing) * 5;
$boundary_text_height = 16;


$font = new SVGFont('bold-web', 'HussarBoldWeb.svg');

$image = SVG::fromFile('php_test.svg');
$doc = $image->getDocument();
$doc->setAttribute('width', $sample_svg_width);
$doc->setAttribute('height', $sample_svg_height);

//$logo = SVG::fromFile('php_test.svg');
//$logo_doc = $logo->getDocument();
//$logo_doc->setAttribute('width', $logo_width);
//$logo_doc->setAttribute('height', $logo_height);

$logo = new SVG($logo_width, $logo_height);
$logo_doc = $logo->getDocument();
$logo_rect = new SVGRect(0, 0, $logo_width, $logo_height);
$logo_rect->setStyle('fill', 'none');
$logo_rect->setStyle('stroke', 'black');
$logo_rect->setStyle('rx', '10');
$logo_doc->addChild($logo_rect);

$custom_svg = SVG::fromFile('php_test.svg');
$custom_svg_doc = $custom_svg->getDocument();
$custom_svg_doc->setAttribute('width', $svg_width);
$custom_svg_doc->setAttribute('height', $svg_height);

$main_detail = new SVG($main_detail_width, $main_detail_height);
$main_detail_doc = $main_detail->getDocument();
$main_detail_rect = new SVGRect(0, 0, $main_detail_width, $main_detail_height);
$main_detail_rect->setStyle('fill', 'none');
$main_detail_rect->setStyle('stroke', 'black');
$main_detail_rect->setStyle('rx', '10');
$main_detail_doc->addChild($main_detail_rect);

$main_detail->getDocument()->addChild($font);
$main_detail->getDocument()->addChild(
    (new SVGText('Main Description', $main_detail_width / 2, $main_detail_height / 2))
        ->setFont($font)
        ->setSize('5px')
        ->setStyle('stroke', 'black')
        ->setStyle('stroke-width', 1)
        ->setStyle('text-anchor', 'middle')
        ->setStyle('alignment-baseline', 'middle')
);

$tall_detail = new SVG($tall_detail_width, $tall_detail_height);
$tall_detail_doc = $tall_detail->getDocument();
$tall_detail_rect = new SVGRect(0, 0, $tall_detail_width, $tall_detail_height);
$tall_detail_rect->setStyle('fill', 'none');
$tall_detail_rect->setStyle('stroke', 'black');
$tall_detail_rect->setStyle('rx', '10');
$tall_detail_doc->addChild($tall_detail_rect);


$address_square = new SVG($address_width, $address_height);
$address_rect_doc = $address_square->getDocument();
$address_rect = new SVGRect(0, 0, $address_width, $address_height);
$address_rect->setStyle('fill', 'none');
$address_rect->setStyle('stroke', 'black');
$address_rect->setStyle('rx', '10');
$address_rect_doc->addChild($address_rect);

$address_square->getDocument()->addChild($font);
$address_square->getDocument()->addChild(
    (new SVGText('Address Description', $address_width / 2, $address_height / 2))
        ->setFont($font)
        ->setSize(7)
        ->setStyle('stroke', 'black')
        ->setStyle('stroke-width', 1)
        ->setStyle('text-anchor', 'middle')
        ->setStyle('alignment-baseline', 'middle')
        ->setStyle('writing-mode', 'vertical-rl')
        ->setStyle('text-orientation', 'mixed')
);

$small_detail = new SVG($small_detail_width, $small_detail_height);
$small_detail_doc = $small_detail->getDocument();
$small_detail_rect = new SVGRect(0, 0, $small_detail_width, $small_detail_height);
$small_detail_rect->setStyle('fill', 'none');
$small_detail_rect->setStyle('stroke', 'black');
$small_detail_rect->setStyle('rx', '10');
$small_detail_doc->addChild($small_detail_rect);

$svg_address = new EasySVG();
$svg_address->setFont("./HussarBoldWeb.svg", 5, '#000000');
$svg_address->addText("Simple text display");
$svg_address->addAttribute("width", "120px");
$svg_address->addAttribute("height", "80px");
$svg_address->addAttribute("viewbox", '-30, -10 120 80');
$svg_address->addAttribute('class', 'address-class');

$boundary_text_svg = new SVG($boundary_text_width, $boundary_text_height);
$boundary_text_doc = $boundary_text_svg->getDocument();
$boundary_text_rect = new SVGRect(0, 0, $boundary_text_width, $boundary_text_height);
$boundary_text_rect->setStyle('fill', 'none');
$boundary_text_rect->setStyle('storke', 'none');
$boundary_text_doc->addChild($boundary_text_rect);

$boundary_text_svg->getDocument()->addChild($font);
$boundary_text_svg->getDocument()->addChild(
    (new SVGText('--------description---------', $boundary_text_width / 2, $boundary_text_height / 2))
        ->setFont($font)
        ->setSize('10px')
        ->setStyle('stroke', 'black')
        ->setStyle('text-anchor', 'middle')
        ->setStyle('alignment-baseline', 'middle')
);

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

    .address-class path {
        transform: rotate(90deg);
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
				svg_file: create_svg
			}, function (data) {
				if (data == 1) {
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
                <?php echo $logo; ?>
            </g>
            <g transform="translate(0, <?php echo $logo_height + $spacing ?>)">
                <?php echo $main_detail;
                ?>
            </g>
            <g transform="translate(<?php echo $main_detail_width + $spacing ?>, <?php echo $logo_height + $spacing ?>)">
                <?php echo $tall_detail ?>
            </g>
            <g transform="translate(<?php echo $logo_width + $spacing ?>, 0)">
                <?php echo $small_detail ?>
            </g>
            <g transform="translate(<?php echo $logo_width + $spacing ?>, <?php echo $small_detail_height + $spacing ?>)">
                <?php echo $address_square;
                ?>
            </g>
            <g transform="translate(0, <?php echo $logo_height + $main_detail_height + 2 * $spacing ?>)">
                <?php

                for ($row = 0; $row < 4; $row++) {
                    for ($column = 0; $column < 2; $column++) {
                        $trans_Y = $row * ($svg_height + $spacing);
                        if ($column === 0) {
                            $trans_X = $column * $svg_width;
                        } else {
                            $trans_X = $column * ($svg_width + $spacing);
                        }
                        echo '<g transform="translate(' . $trans_X . ', ' . $trans_Y . ')">';
                        echo $custom_svg;
                        echo '</g>';
                    }
                }
                ?>
            </g>
            <g transform="translate(<?php echo $logo_width + $address_width + 2 * $spacing ?>,
                                    <?php echo $small_detail_height + $spacing ?>)">
                <?php
                for ($row = 0; $row < 7; $row++) {
                    $trans_X = $spacing;
                    if ($row === 0) {
                        $trans_Y = $row * $svg_height;
                    } else {
                        $trans_Y = $row * ($svg_height + $spacing);
                    }
                    echo '<g transform="translate(' . $trans_X . ', ' . $trans_Y . ')">';
                    echo $custom_svg;
                    echo '</g>';
                }
                ?>
            </g>
            <g transform="translate(0, <?php echo $logo_height + $main_detail_height + $svg_height * 4 + $spacing * 6 ?>)">
                <?php
                for ($row = 0; $row < 7; $row++) {
                    for ($column = 0; $column < 5; $column++) {
                        $trans_Y = $row * ($svg_height + $spacing);
                        if ($column === 0) {
                            $trans_X = $column * $svg_width;
                        } else {
                            $trans_X = $column * ($svg_width + $spacing);
                        }
                        echo '<g transform="translate(' . $trans_X . ', ' . $trans_Y . ')">';
                        echo $custom_svg;
                        echo '</g>';
                    }
                }
                ?>
            </g>
            <g transform="translate(0, <?php echo $logo_height + $main_detail_height + $svg_height * 11 + $spacing * 13 ?>)">
                <?php echo $boundary_text_svg ?>
            </g>
            <g transform="translate(0, <?php echo $logo_height + $main_detail_height + $svg_height * 11 + $spacing * 13 + $boundary_text_height ?>)">
                <?php
                for ($row = 0; $row < 7; $row++) {
                    for ($column = 0; $column < 5; $column++) {
                        $trans_Y = $row * ($svg_height + $spacing);
                        if ($column === 0) {
                            $trans_X = $column * $svg_width;
                        } else {
                            $trans_X = $column * ($svg_width + $spacing);
                        }
                        echo '<g transform="translate(' . $trans_X . ', ' . $trans_Y . ')">';
                        echo $custom_svg;
                        echo '</g>';
                    }
                }
                ?>
            </g>
        </svg>
    </div>
</div>

</body>
</html>

