<div class="col-md-offset-2 col-md-7">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo Yii::t('cams', 'Specify the users for whom you want to share cams'); ?></h3>
		</div>
		<div class="panel-body">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'action' => $this->createUrl('cams/share', array('type' => $type)),
				'id' => 'share-form',
				'enableClientValidation' => true,
				'clientOptions' => array('validateOnSubmit' => true),
				'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form')
				)
			);
			?>
			<div class="form-group">
				<?php echo $form->hiddenField($model, 'hcams'); ?>
				<?php echo $form->labelEx($model, 'cams', array('class' => 'col-sm-4 control-label')); ?>
				<div class="col-sm-8">
					<?php echo $form->textField($model, 'cams', array('readOnly' => '1', 'class' => 'form-control')); ?>
				</div>
				<div class="col-sm-offset-4 col-sm-8">
					<?php echo $form->error($model, 'cams'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model, 'emails', array('class' => 'col-sm-4 control-label')); ?>
				<div class="col-sm-8">
					<?php if(Yii::app()->user->permissions == 3) {
						$status = array(
							'1' => Yii::t('users', 'viewers'),
							'2' => Yii::t('users', 'operators'),
							'3' => Yii::t('users', 'admin'),
							);
						$users = Users::model()->findAllByAttributes(array('status' => array_keys($status)), array('order' => 'status DESC'));
						foreach ($users as $user) {
							$list[$user->email] = $user->email.'['.$status[$user->status].']';
						}
						echo $form->dropDownList($model, 'emails', $list, array('class' => 'mult form-control', 'multiple' => 'multiple'));
					} else {
						echo $form->textArea($model, 'emails', array('class' => 'form-control'));
					}
					?>
				</div>
				<div class="col-sm-offset-4 col-sm-8">
					<?php echo $form->error($model, 'emails'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<?php echo CHtml::submitButton(Yii::t('cams', 'Share'), array('class' => 'btn btn-primary')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<?php  
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/bootstrap-multiselect.js');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-multiselect.css');
?>
<script type="text/javascript">
$(document).ready(function() {
	$('.mult').multiselect({
		enableCaseInsensitiveFiltering: true,
	});
});
</script>
