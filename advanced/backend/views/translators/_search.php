<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TranslatorsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="translators-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'available_weekdays')->checkbox() ?>

    <?= $form->field($model, 'available_weekends')->checkbox() ?>

    <?php // echo $form->field($model, 'language_from_id') ?>

    <?php // echo $form->field($model, 'language_to_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
