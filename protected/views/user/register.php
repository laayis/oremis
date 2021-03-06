<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Register';


?>

<h1>Register</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'usrtype'); ?>
		<?php //echo $form->textField($model,'usrtype',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->dropDownList($model,'usrtype',
									array('Client'=>'Client','PropertyOwner'=>'Property Owner'),
									array('prompt'=>'Select User Type')); ?>
		<?php echo $form->error($model,'usrtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>15,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="hint">
		By clicking <i>Register</i> you agree by the 
		<?php echo CHtml::link('Term & Conditions', array('site/page', 'view'=>'terms')); ?>
		 of OREMIS.
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Register'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->