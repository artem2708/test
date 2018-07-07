<?php
namespace app\widgets;

use app\models\EatAppleForm;
use common\entities\Apple;

class AppleWidget extends \yii\bootstrap\Widget
{
    /** @var  \common\entities\Apple */
    public $model;
    /** @var  EatAppleForm */
    private $form;


    public function init()
    {
        parent::init();

        if ($this->form === null) {
            $this->form = new EatAppleForm();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        if($this->model instanceof Apple){
            return $this->render('apple', ['eatForm' => $this->form, 'model' => $this->model]);
        }
    }
}
