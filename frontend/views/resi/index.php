<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Resi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'img',
            'valor',
            'caracteristicas:ntext',
            'ubicacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
