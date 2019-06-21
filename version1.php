<?php
require_once __DIR__ . '/php-svg-master/autoloader.php';

use SVG\SVG;

$svg = '';

$image = SVG::fromFile('sample.svg');
$doc = $image->getDocument();
$doc->setAttribute('width', '357px');
$doc->setAttribute('height', '154px')
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
        height: 800px;
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
		var sample_svg = `<?php echo (string)$image; ?>`;
		$('#generate_btn').on('click', function () {
			var row_counts = $('#row_counts').val();
			var column_counts = $('#column_counts').val()
            var offset_row = 30;
			var offset_column = 20;
			var trans_row = 0 ;
			var trans_column = 0 ;
			var html = '';
			html += '<svg class="margin-width-auto" xmlns="http://www.w3.org/2000/svg" id="all_svgs">'

			for (var row = 0; row < row_counts; row++ ) {
                if (row === 0) {
	                trans_column = row * 154
                }else {
	                trans_column = row * (154 + offset_column)
                }
				for ( var column = 0; column < column_counts; column++) {
                    if ( column === 0) {
	                    trans_row = column* 357
                    }else {
	                    trans_row = column * (357 + offset_row)
                    }
					html += '<g transform="translate(' + trans_row +', ' + trans_column +')">';
					html += sample_svg;
					html += '</g>';
				}
			}
			html += '</svg>'
			$('#svg_container').html(html);
		});

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
        <input id="row_counts" type="number" placeholder="row counts">
        <input id="column_counts" type="number" placeholder="column counts">
        <button id="generate_btn" type="button">Ok</button>
        <button id="create_svg_file">Create as a SVG file</button>

    </form>
    <div class="svg-container" id="svg_container">

    </div>
</div>

</body>
</html>

