<?php

use yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $item array */
/* @var $model \common\entities\Apple */
/* @var $eatForm \frontend\models\EatAppleForm */
?>
<div class="col-lg-3" style="text-align:center; min-height:200px; padding:5px; border:<?= $model->color ?> solid 1px ">
    <span><?= $model->percent . '%' ?> <?= Html::a('Down', Url::to(['apple/down', 'id' => $model->id])) ?></span>
    <?php $form = ActiveForm::begin(['action' => Url::to(['apple/eat']), 'enableAjaxValidation' => true]);?>
        <?= $form->field($eatForm, 'percent')->textInput(['placeholder' => 'percent'])->label(false) ?>
        <?= $form->field($eatForm, 'appleId')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= Html::submitButton('Eat this') ?>
    <?php $form->end() ?>
</div>