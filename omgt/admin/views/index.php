<?php echo $header; ?>
	<div id="content" class="span-16">
		<?php 
			$msg = $this->session->get_once('messages');
			if ($msg['msg'] != ''): 
		?>
			<div id="msg" class="<?php echo $msg['type']; ?>">
				<?php echo $msg['msg']; ?>
			</div>
		<?php endif; ?>
	
		<div>
			<?php echo $content; ?>
		</div>
	</div>
<?php echo $footer; ?>