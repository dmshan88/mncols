<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Report;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'testtime',
                'format' => 'text',
                'content' => function ($model,$key, $index, $column) {
                    return date('y-m-d H:i', $model->testtime); 
                }
            ],
            [
                'attribute' => 'mtype',
                'format' => 'text',
                'content' => function ($model,$key, $index, $column) {
                    return Report::getTypeName()[$model->mtype]; 
                }
            ],
            'mid',
            'errcode',
            //'lang',
            'phone',
            'hospital',
            //'stat',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
