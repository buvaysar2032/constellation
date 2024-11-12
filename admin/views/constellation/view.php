<?php

use admin\components\widgets\detailView\Column;
use admin\components\widgets\detailView\ColumnImage;
use admin\modules\rbac\components\RbacHtml;
use common\components\helpers\UserUrl;
use common\models\ConstellationSearch;
use yii\widgets\DetailView;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Constellation
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Constellations'),
    'url' => UserUrl::setFilters(ConstellationSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constellation-view">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <p>
        <?= RbacHtml::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= RbacHtml::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post'
                ]
            ]
        ) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            Column::widget(),
            Column::widget(['attr' => 'uuid']),
            Column::widget(['attr' => 'coordinates', 'format' => 'ntext']),
            Column::widget(['attr' => 'name']),
            Column::widget(['attr' => 'name_en']),
            Column::widget(['attr' => 'description']),
            Column::widget(['attr' => 'description_en']),
            ColumnImage::widget(['attr' => 'image']),
            ColumnImage::widget(['attr' => 'user_photo']),
            Column::widget(['attr' => 'status']),
            Column::widget(['attr' => 'created_at', 'format' => 'datetime']),
            Column::widget(['attr' => 'updated_at', 'format' => 'datetime']),
        ]
    ]) ?>

</div>
