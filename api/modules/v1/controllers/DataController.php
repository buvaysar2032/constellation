<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use api\behaviors\returnStatusBehavior\RequestFormData;
use common\components\exceptions\ModelSaveException;
use common\enums\ConstellationStatus;
use common\enums\ConstellationType;
use common\models\Constellation;
use common\models\Setting;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Parameter;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DataController extends AppController
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['add-constellation', 'random', 'constellation-id']]]);
    }

    /**
     * @throws ModelSaveException
     * @throws Exception
     */
    #[Post(
        path: '/data/add-constellation',
        operationId: 'constellation-create',
        description: 'Форма "Созвездие"',
        summary: 'Форма "Созвездие"',
        tags: ['data']
    )]
    #[RequestFormData(properties: [
        new Property(property: 'coordinates', type: 'string'),
        new Property(property: 'name', type: 'string'),
        new Property(property: 'description', type: 'string'),
    ])]
    #[JsonSuccess(content: [
        new Property(property: 'message', type: 'string', example: 'Форма отправлено успешно.'),
    ])]
    public function actionAddConstellation(): array
    {
        $request = Yii::$app->request->post();

        if (empty($request['coordinates']) || empty($request['name']) || empty($request['description'])) {
            return $this->returnError('Все поля обязательны для заполнения.');
        }

        $constellation = new Constellation();
        $constellation->coordinates = $request['coordinates'];
        $constellation->name = $request['name'];
        $constellation->description = $request['description'];
        $constellation->type = ConstellationType::CUSTOM->value;

        if (!$constellation->save()) {
            throw new ModelSaveException($constellation);
        }

        return $this->returnSuccess(['message' => 'Форма отправлено успешно.']);
    }

    #[Get(
        path: '/data/random',
        operationId: 'constellation-random',
        description: 'Возвращает созвездие',
        summary: 'Созвездие',
        tags: ['data']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'constellation', type: 'array',
            items: new Items(ref: '#/components/schemas/Constellation'),
        ),
    ])]
    public function actionRandom(): array
    {
        $n = Setting::getParameterValue('n');
        $i = Setting::getParameterValue('i');

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

    #[Get(
        path: '/data/constellation-id',
        operationId: 'constellation-id',
        description: 'Возвращает созвездие',
        summary: 'Созвездие',
        tags: ['data']
    )]
    #[JsonSuccess(content: [
        new Property(property: 'constellation', ref: '#/components/schemas/Constellation', type: 'object'),
    ])]
    public function actionConstellationId(
        #[Parameter(description: 'UID созвездия', in: 'query',  schema: new Schema(type: 'string'))]
        string $uuid
    ): array
    {
        $constellation = Constellation::find()->where(['uuid' => $uuid])->one();

        if ($constellation === null) {
            return $this->returnError('Созвездие не найдено');
        }

        return $this->returnSuccess($constellation, 'constellation');
    }
}
