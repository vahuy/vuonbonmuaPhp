<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine or request Chrome Frame -->
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Use title if it's in the page YAML frontmatter -->
<title>VuonBonMua</title>

<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="/dashboard/stylesheets/reset.css" rel="stylesheet" type="text/css" />
<link href="/dashboard/stylesheets/vbm.css" rel="stylesheet" type="text/css" />

<script src="/dashboard/javascripts/modernizr.js" type="text/javascript"></script>

</head>

<body class="index">
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id))
				return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=277385395761685";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="header">
		<div class="top-bar">
			<div class="top-bar-section">
				<!-- Right Nav Section -->
				<div class="header-navigation">
					<div><a href="/dashboard/homepage.php">Trang chủ</a></div>
					<div><a href="/dashboard/climbing.php">Climbing - Hồng leo</a></div>
					<div><a href="/dashboard/shrub.php">Shrub - Hồng bụi</a></div>
					<div><a href="/dashboard/treatment.php">Thuốc hữu cơ</a></div>
				</div>
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div class="hero">
			<div class="row">
				<div class="col-md-12">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Giới thiệu vườn bốn mùa</h2>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<p>Không tiếp khách tham quan hay không hẹn trước. Có rất nhiều
						ảnh hoa thật, trồng và nở tại HCM, các bạn có thể xem để hình dung
						hoa sẽ ra sao. Chúng tôi trồng hoa thân thiện với môi trường, cây
						phát triển tự nhiên với phân bón hữu cơ là chính. Không kích thích
						để nhìn cây xum xuê bán giá cao.</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<?php
				require './objects/PageContainer.php';
				$footer = new PageContainer();
				echo $footer->renderFooter();
			?>
		</div>
	</div>
</body>
</html>
