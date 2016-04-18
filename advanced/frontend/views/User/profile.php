<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<div class="main-profile col-lg-4 col-md-4">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
		'options' => ['placeholder' => 'Enter birth date ...'],
		'pluginOptions' => [
			'autoclose' => true,
			'format' => 'yyyy-mm-dd',
		]
	]);
	?>

	<?php
	$items = [
		'male' => 'Мужской',
		'female' => 'Женский',
	];
	$params = [
		'prompt' => 'Ваш пол...'
	];
	echo $form->field($model, 'gender')->dropDownList($items, $params);
	?>

	<?= $form->field($model, 'avatar')->fileInput() ?>
	<?= $form->field($model, 'first_name') ?>
	<?= $form->field($model, 'second_name') ?>
	<?= $form->field($model, 'middle_name') ?>

	<div class="form-group col-md-offset-4">
		<?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>
	<p>Avatar main</p>
	<?php $image = $models->getImage();
	$path2 = $image->getPathToOrigin(); ?>
	<img src="<?= $path2 ?>" alt="123" width="300px"/>
	<br><br>
	<?= Html::img("$path2", ['width' => '300px']); ?>
</div><!-- main-profile -->
