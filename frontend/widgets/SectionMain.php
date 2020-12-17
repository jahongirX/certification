<?php


namespace frontend\widgets;


use common\models\Post;
use common\models\Reception;
use frontend\models\CertificationForm;
use yii\base\Widget;

class SectionMain extends Widget
{
    public function run(){
        $model = new CertificationForm();
        return $this->render('sectionMain',[
            'model' => $model,
        ]);
    }
}