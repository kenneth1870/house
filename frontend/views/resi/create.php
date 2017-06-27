<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Resi */

$this->title = 'Create Resi';
$this->params['breadcrumbs'][] = ['label' => 'Resis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
