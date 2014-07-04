<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div id="content" class="span-16">
		<?php echo $content; ?>
	</div><!-- content -->
	<div class="span-6">
		<p>
			<table id="symptomToBeSearchedTable" class="symptomsTable hidden"><th>Selected Symptoms:</th></table>
		</p>

	</div>
</div>
<?php $this->endContent(); ?>
