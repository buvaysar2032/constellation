<?php

use admin\widgets\ckfinder\CKFinderInputFile;
use admin\widgets\input\Select2;
use common\enums\ConstellationStatus;
use common\widgets\AppActiveForm;
use kartik\icons\Icon;
use yii\bootstrap5\Html;
use yii\helpers\Url;

/**
 * @var $this     yii\web\View
 * @var $model    common\models\Constellation
 * @var $form     AppActiveForm
 * @var $isCreate bool
 */
?>

<div class="constellation-form">

    <?php $form = AppActiveForm::begin() ?>

    <?= $form->field($model, 'coordinates')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(CKFinderInputFile::class) ?>

    <?= $form->field($model, 'user_photo')->widget(CKFinderInputFile::class) ?>

    <?= $form->field($model, 'status')->widget(Select2::class, ['data' => ConstellationStatus::indexedDescriptions()]) ?>

    <div class="form-group">
        <?php if ($isCreate) {
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Create New'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=create']
            );
            echo Html::submitButton(
                Icon::show('save') . Yii::t('app', 'Save And Return To List'),
                ['class' => 'btn btn-success', 'formaction' => Url::to() . '?redirect=index']
            );
        } ?>
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php AppActiveForm::end() ?>

</div>
