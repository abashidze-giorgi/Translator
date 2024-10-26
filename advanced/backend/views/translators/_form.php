<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Translators $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="translators-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_weekdays')->checkbox() ?>

    <?= $form->field($model, 'available_weekends')->checkbox() ?>

    <?= $form->field($model, 'language_from_id')->textInput() ?>

    <?= $form->field($model, 'language_to_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
