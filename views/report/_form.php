<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mtype')->textInput() ?>

    <?= $form->field($model, 'testtime')->textInput() ?>

    <?= $form->field($model, 'errcode')->textInput() ?>

    <?= $form->field($model, 'lang')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stat')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
