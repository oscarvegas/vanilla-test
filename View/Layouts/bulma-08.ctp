<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Vanilla Forums:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>


</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Github repos app</h1>
		</div>
		<div class="section">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>


		</div>
		<div class="footer">
			Test based on Vanilla Forums Idea
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
