<?php

use admin\components\GroupedActionColumn;
use admin\components\widgets\gridView\Column;
use admin\components\widgets\gridView\ColumnDate;
use admin\components\widgets\gridView\ColumnSelect2;
use admin\modules\rbac\components\RbacHtml;
use admin\widgets\sortableGridView\SortableGridView;
use common\enums\ConstellationStatus;
use common\enums\ConstellationType;
use kartik\grid\SerialColumn;
use yii\widgets\ListView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  common\models\ConstellationSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Constellation
 */

$this->title = Yii::t('app', 'Constellations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constellation-index">

    <h1><?= RbacHtml::encode($this->title) ?></h1>

    <div>
        <?=
            RbacHtml::a(Yii::t('app', 'Create Constellation'), ['create'], ['class' => 'btn btn-success']);
//           $this->render('_create_modal', ['model' => $model]);
        ?>
    </div>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            Column::widget(),
            Column::widget(['attr' => 'uuid']),
//            Column::widget(['attr' => 'coordinates', 'format' => 'ntext']),
            Column::widget(['attr' => 'name']),
//            Column::widget(['attr' => 'name_en']),
//            Column::widget(['attr' => 'description']),
//            Column::widget(['attr' => 'description_en']),
//            Column::widget(['attr' => 'image']),
//            Column::widget(['attr' => 'user_photo']),
            ColumnSelect2::widget(['attr' => 'status', 'items' => ConstellationStatus::class, 'hideSearch' => true, 'editable' => false]),
//            ColumnDate::widget(['attr' => 'created_at', 'searchModel' => $searchModel, 'editable' => false]),
//            ColumnDate::widget(['attr' => 'updated_at', 'searchModel' => $searchModel, 'editable' => false]),
            ColumnSelect2::widget(['attr' => 'type', 'items' => ConstellationType::class, 'hideSearch' => true, 'editable' => false]),

            ['class' => GroupedActionColumn::class]
        ]
    ]) ?>
</div>
