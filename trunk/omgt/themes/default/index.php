<?php echo $header; ?>
	<div id="content" class="span-24">
		<?php
			$msg = $this->session->get_once('messages');
			if (count($msg)>0):
		?>
			<div id="msg" class="span-8 <?php echo $msg['type']; ?>">
				<?php echo $msg['msg']; ?>
			</div>
		<?php endif; ?>
		<?php echo $content; ?>
	</div>
<?php echo $footer; ?>
