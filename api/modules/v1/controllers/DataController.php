<?php

namespace api\modules\v1\controllers;

use common\enums\ConstellationStatus;
use common\enums\ConstellationType;
use common\models\Constellation;
use common\models\Setting;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DataController extends AppController
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index', 'random', 'view']]]);
    }

    public function actionIndex(): array
    {
        $constellations = Constellation::find()->where(['status' => 1])->all();
        return $this->returnSuccess($constellations, 'constellations');
    }

    public function actionRandom(): array
    {
        $n = Setting::find()->where(['parameter' => 'n'])->one();
        $i = Setting::find()->where(['parameter' => 'i'])->one();

        $preparedConstellations = Constellation::find()
            ->where(['status' => ConstellationStatus::Approved->value, 'type' => ConstellationType::PREPARED->value])
            ->orderBy(new Expression('rand()'))
            ->limit($i)
            ->all();

        $customConstellations = Constellation::find()
            ->where(['status' => ConstellationStatus::Approved->value, 'type' => ConstellationType::CUSTOM->value])
            ->orderBy(new Expression('rand()'))
            ->limit($n)
            ->all();

        $constellations = array_merge($preparedConstellations, $customConstellations);

        return $this->returnSuccess($constellations, 'constellations');
    }

    public function actionView($uuid): array
    {
        $constellation = Constellation::find()->where(['uuid' => $uuid])->one();

        if ($constellation === null) {
            return $this->returnError('Созвездие не найдено');
        }

        return $this->returnSuccess($constellation, 'constellation');
    }
}
