<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idreport') ?>

    <?= $form->field($model, 'mid') ?>

    <?= $form->field($model, 'mtype') ?>

    <?= $form->field($model, 'testtime') ?>

    <?= $form->field($model, 'errcode') ?>

    <?php // echo $form->field($model, 'lang') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'hospital') ?>

    <?php // echo $form->field($model, 'stat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
