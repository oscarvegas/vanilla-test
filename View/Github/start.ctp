<div class="content">
	<div class="buttons">
		
		<?php 
		if ($hasToken) :
		?>
			<a href="<?php echo $this->Html->url(['action' => 'checkrepos']) ?>" class="button is-success">
				Check repos
			</a>
			
		<?php 
		else:
		?>
		
			<a href="<?php echo $this->Html->url(['action' => 'authgithub']) ?>" class="button is-info">
				Get token
			</a>
		

		<?php 
		endif;
		?>

		<a href="<?php echo $this->Html->url(['action' => 'resetkeys']) ?>" class="button is-danger">
			Reset
		</a>
	</div>
</div>