<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-2">
		<p>
			<?php $this->widget('SymptomCategory', array('symptomCategoryArray'=>$this->symptomCategories)); ?>
		</p>
	</div>
	<div id="content" class="span-14">
		<?php echo $content; ?>
	</div><!-- content -->
	<div class="span-4">
		<p>
			
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
			?>
		</p>
	</div>
</div>
<?php $this->endContent(); ?>
