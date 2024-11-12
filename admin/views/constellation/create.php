<?php

use common\components\helpers\UserUrl;
use common\models\ConstellationSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Constellation
 */

$this->title = Yii::t('app', 'Create Constellation');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Constellations'),
    'url' => UserUrl::setFilters(ConstellationSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constellation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
