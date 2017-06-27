<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model frontend\models\Resi */
/* @var $form yii\widgets\ActiveForm */
;
var_dump($model->img);
// $url = ($url < 0)? ($url = null): ($url=$url);
$model->img == (null)? ($url=null) : ($url = explode(',', trim($model->img)) );

?>

<div class="resi-form">
	

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?=  $form->field($model, 'file[]')->widget(FileInput::classname(), [
		'options' => ['multiple' => true, 'accept' => 'image/*'],
		'pluginOptions' => [
		// 'uploadUrl' => Url::to(['/resi/create']),
		'previewFileType' => 'image',
		'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
		'browseLabel' =>  'Select Photo',
		'initialPreview' =>$url,
		'initialPreviewConfig' => $url,
		'initialPreviewAsData'=>true,
		]
		]);?>

		<?= $form->field($model, 'valor')->textInput() ?>

		<?= $form->field($model, 'caracteristicas')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'ubicacion')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

