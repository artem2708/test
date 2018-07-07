<?php

namespace app\repositories;

use common\entities\Apple;
use common\helpers\RandomProperties;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class AppleRepository
 * @package app\repositories
 */
class AppleRepository extends ActiveRepository
{
    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Apple::find(),
        ]);

        if ($params) {
            $dataProvider->query->andWhere($params);
        }

        return $dataProvider;
    }

    /**
     * @param $id
     * @return array|Apple|null
     */
    public function getByPK($id)
    {
        return Apple::find()->where(['id' => $id])->one();
    }

    /**
     * @return Apple
     */
    public function create()
    {
        $apple = new Apple();

        $apple->setAttributes(['color' => RandomProperties::getRandColor()]);
        $this->saveOrFail($apple);

        return $apple;
    }

    public function createRand()
    {
        for ($i = rand(1, 5); $i >= 0; $i--) {
            $this->create();
        }
    }

    /**
     * @param Apple $apple
     * @param array $data
     */
    public function update(Apple $apple, $data)
    {
        $apple->setAttributes($data);
        $this->saveOrFail($apple);
    }

    /**
     * @param Apple $apple
     */
    public function delete(Apple $apple)
    {
        $this->deleteOrFail($apple);
    }

    /**
     * @return int
     */
    public function clear()
    {
        return Apple::deleteAll([]);
    }

    /**
     * @param Apple $apple
     * @return bool
     */
    public function down(Apple $apple)
    {
        if ($apple->status == Apple::STATUS_UP) {
            $this->update($apple,[
                'status' => Apple::STATUS_DOWN,
                'fall_time' => time()
            ]);

            return true;
        }

        return false;
    }

    /**
     * @return array|Apple[]
     */
    public function getAllFall()
    {
        return Apple::find()->fall()->all();
    }

    /**
     * @return array|Apple[]
     */
    public function getAllUp()
    {
        return Apple::find()->up()->all();
    }
}
