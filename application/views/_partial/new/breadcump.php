
<!-- Breadcrumbs-->
<ol class="breadcrumb bg-white shadow">
	<?php $no=1; foreach ($this->uri->segments as $segment): ?>
		<?php 
			if($no < 3):
			$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
			$is_active =  $url == $this->uri->uri_string;
		?>
		<li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?> font-weight-bold">
			<?php if($is_active): ?>
				<?php echo ucfirst(str_replace('_', ' ', $segment)) ?>
			<?php else: ?>
				<a href="<?php echo site_url($url) ?>"><?php echo ucfirst(str_replace('_', ' ', $segment)) ?></a>
			<?php endif; ?>
		</li>
	<?php endif;$no++;endforeach; ?>
</ol>
