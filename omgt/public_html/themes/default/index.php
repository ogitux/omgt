<?php echo $header; ?>
	<div id="content" class="span-16">
		<br/>
		<?php 
			$msg = $this->session->get_once('messages');
			if (count($msg)>0): 
		?>
			<div id="msg" class="span-8 <?php echo $msg['type']; ?>">
				<?php echo $msg['msg']; ?>
			</div>
		<?php endif; ?>
	
		<div class="span-1 first">
		</div>
		<div class="span-14">
			<?php echo $content; ?>
		</div>
		<div class="span-1 last">
		</div>
		
	</div>
<?php echo $footer; ?>