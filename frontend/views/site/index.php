<?php
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $fallApples \common\entities\Apple[] */
/* @var $upApples \common\entities\Apple[] */
/* @var $eatForm \frontend\models\EatAppleForm */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <?= \yii\helpers\Html::a('Add Apples', \yii\helpers\Url::to(['apple/create']), ['class' => 'btn btn-success']) ?>
        <?= \yii\helpers\Html::a('Clear Apples', \yii\helpers\Url::to(['apple/clear']), ['class' => 'btn btn-danger']) ?>
        <div class="row">
            <div class="col-lg-12">
                <h2>On the tree</h2>
                <?php foreach ($upApples as $model): ?>
                    <?= \frontend\widgets\AppleWidget::widget(['model' => $model])?>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-12">
                <h2>On the ground</h2>
                <?php foreach ($fallApples as $model): ?>
                    <?= \frontend\widgets\AppleWidget::widget(['model' => $model])?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
