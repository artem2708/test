<?php

namespace common\db;
use common\entities\Apple;

/**
 * This is the ActiveQuery class for [[\common\entities\Apple]].
 *
 * @see \common\entities\Apple
 */
class AppleQuery extends \yii\db\ActiveQuery
{

    /**
     * {@inheritdoc}
     * @return \common\entities\Apple[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\entities\Apple|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function fall()
    {
        return $this->andWhere(['in', 'status', [Apple::STATUS_DOWN, Apple::STATUS_ROTTEN]])->orderBy('fall_time DESC');
    }

    /**
     * @return $this
     */
    public function up()
    {
        return $this->andWhere(['status' => 'UP']);
    }
}
