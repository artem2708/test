<?php

namespace frontend\models;

use common\entities\Apple;
use yii\base\Model;

class EatAppleForm extends Model
{
    public $percent;
    public $appleId;

    private $_apple;


    public function rules()
    {
        return [
            ['appleId', 'required'],
            ['appleId', 'checkApple'],

            ['percent', 'required'],
            ['percent', 'number', 'max' => 100, 'min' => 1],
        ];
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function checkApple($attribute)
    {
        $apple = $this->getApple();

        if (!$apple) {
            $this->addError($attribute, 'The apple does not exist.');
            return false;
        }

        if ($apple->status == Apple::STATUS_UP) {
            $this->addError($attribute, 'An apple is still on the tree.');
            return false;
        }

        if ($apple->status == Apple::STATUS_ROTTEN) {
            $this->addError($attribute, 'The apple is rotten.');
            return false;
        }
    }

    /**
     * @return Apple|null
     */
    public function getApple()
    {
        if ($this->_apple === null) {
            $this->_apple = Apple::findOne(['id' => $this->appleId]);
        }

        return $this->_apple;
    }

    /**
     * @return bool
     */
    public function eat()
    {
        $apple = $this->getApple();

        if ($apple->percent - $this->percent <= 0) {
            $apple->delete();
            return true;
        }

        $apple->percent = $apple->percent - $this->percent;
        return $apple->save();
    }

}