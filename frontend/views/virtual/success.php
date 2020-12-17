<?php

use common\models\District;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

?>
<div class="container">
    <div class="card-box" style="padding:0 20px">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?=Url::to(['/'])?>"><?=Yii::t('main','home')?></a></li>
            <li class="breadcrumb-item active"><?=Yii::t('main','success')?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="card-box" >

                <div class="alert alert-success"><?=Yii::t('main','success-send')?></div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'unique_id',
                        'password',
                    ],
                ]) ?>

            </div>

            <div class="card-box">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3><i class="fe-check-circle"></i> <?=Yii::t('main','check-your-application')?></h3>
                        <p><?=Yii::t('main','check-steps')?></p>
                        <a target="_blank" href="<?=\yii\helpers\Url::to(['virtual/check'])?>" class="btn btn-info"><?=Yii::t('main','check-status')?></a>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>