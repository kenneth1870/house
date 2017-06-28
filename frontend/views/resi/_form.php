<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$model->img == (null)? ($url=0) : ($url = explode(',', trim($model->img)) );
?>

<div class="resi-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	<?=  $form->field($model, 'file[]')->widget(FileInput::classname(), [
		'options' => ['multiple' => true, 'accept' => 'image/*'],
		'pluginOptions' => [
			// 'uploadUrl' => Url::to(['/site/file-upload']),
		'previewFileType' => 'image',
		'initialPreviewShowDelete' => false,
		'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
		'browseLabel' =>  'Select Photos',
		'initialPreview' =>$url,
		'initialPreviewConfig' => $url,
		'initialPreviewAsData'=>true,
		'showUpload' => false,
		],
		])->label('Fotos');?>
		<?= $form->field($model, 'valor')->textInput() ?>
		<?= $form->field($model, 'caracteristicas')->textarea(['rows' => 6]) ?>
		<?= $form->field($model, 'ubicacion')->textInput() ?>
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>
