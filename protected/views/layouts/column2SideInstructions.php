<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
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
		<table id="sideSymptomInstructions">
			<th>
				<b>Color Chart:</b>
			</th>
			<tr>
				<td>No Characterization:</td>
				<td><div id='noCharacterizationCell' class='colorCell'>&nbsp&nbsp</div></td>
			</tr>
			<tr>
				<td>Low Danger:</td>
				<td><div id='lowDiagnosisCell' class='colorCell'>&nbsp&nbsp</div></td>
			</tr>
			<tr>
				<td>Mild Danger:</td>
				<td><div id='mildDiagnosisCell' class='colorCell'>&nbsp&nbsp</div></td>
			</tr>
			<tr>
				<td>High Danger:</td>
				<td><div id='highDiagnosisCell' class='colorCell'>&nbsp&nbsp</div></td>
			</tr>
		</table>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>