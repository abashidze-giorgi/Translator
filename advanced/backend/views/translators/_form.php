<?php

use backend\models\Languages;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TranslatorsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="translators-search">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'available_weekdays')->checkbox() ?>

    <?= $form->field($model, 'available_weekends')->checkbox() ?>

    <?= $form->field($model, 'language_from_id')->dropDownList(
        Languages::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выберите язык из']
    ) ?>

    <?= $form->field($model, 'language_to_id')->dropDownList(
        Languages::find()->select(['name', 'id'])->indexBy('id')->column(),
        ['prompt' => 'Выберите язык для']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>