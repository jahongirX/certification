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
            <li class="breadcrumb-item active"><?=Yii::t('main','check')?></li>
        </ol>
    </div>
    <div class="row">

        <div class="col-md-8">

            <div class="card-box" >

                <?php

                    $form = ActiveForm::begin([
                        'id' => 'check-form',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                    ]);

                ?>


                <div class="row">

                    <div class="col-md-12">

                        <div class="col-md-12">

                            <?= $form->field($model, 'unique_id')->textInput() ?>

                        </div>

                        <div class="col-md-12">

                            <?= $form->field($model, 'password')->textInput() ?>

                        </div>

                        <div class="col-md-12">

                            <button class="btn btn-success btn-block"><?=Yii::t('main','send')?></button>

                        </div>

                        <?php if(!empty($found)):?>

                            <div class="col-md-12 mt-3 check-result">

                                <div class="alert alert-success"><?=Yii::t('main','found')?></div>

                                <?= DetailView::widget([
                                    'model' => $found,
                                    'attributes' => [
                                        'name',
                                        [
                                            'attribute' => 'region_id',
                                            'value' => function($data){
                                                return \common\models\Region::findOne($data->region_id)->getLang('name');
                                            }
                                        ],
                                        [
                                            'attribute' => 'district_id',
                                            'value' => function($data){
                                                    return District::findOne($data->district_id)->getLang('name');
                                            }
                                        ],
                                        'phone',
                                        'address',
                                        'email',
                                        [
                                            'attribute' => 'reception_type',
                                            'value' => function($data){
                                                $lang = Yii::$app->session->get('lang');
                                                if(empty($lang)){
                                                    $lang = 'uz';
                                                }
                                                return Yii::$app->params['reception_type'][$lang][$data->reception_type];
                                            }
                                        ],
                                        'message',
                                        'created_date',
                                        [
                                            'attribute' => 'file',
                                            'format' => 'html',
                                            'value' => function($data){
                                                if($data->file && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->file )) {

                                                    $file = Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->file;

                                                } else {

                                                    $file = "#No File";

                                                }

                                                return "<a download='download' href='". $file . "'>" . $data->file ."</a>";
                                            }
                                        ],
                                        [
                                            'attribute' => 'status',
                                            'format' => 'html',
                                            'value' => function($data){

                                                $lang = Yii::$app->session->get('lang');
                                                if(empty($lang)){
                                                    $lang = 'uz';
                                                }

                                                $result = "";
                                                switch ($data->status){
                                                    case 0: $result = "<div class='btn btn-warning btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 1: $result = "<div class='btn btn-info btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 2: $result = "<div class='btn btn-success btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 3: $result = "<div class='btn btn-danger btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    default : $result = "<div class='btn btn-warning btn-xs'>" . Yii::t('main','went-wrong') . "</div>";
                                                }
                                                return $result;
                                            }
                                        ]
                                    ],
                                ]) ?>

                            </div>
                            <div class="col-md-12">
                                <hr>
                                <h4><?=Yii::t('main','reception-answer')?></h4>
                            </div>
                            <?php if((!empty($found->reply_text)) || (!empty($found->reply_file))): ?>

                                <div class="col-md-12 mt-2 answer-result">
                                    <?= DetailView::widget([
                                        'model' => $found,
                                        'attributes' => [
                                            'reply_text',
                                            [
                                                'attribute' => 'reply_file',
                                                'format' => 'html',
                                                'value' => function($data){
                                                    if($data->reply_file && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->reply_file )) {

                                                        $file = Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->reply_file;

                                                    } else {

                                                        $file = "#No File";

                                                    }

                                                    return "<a download='download' href='". $file . "'>" . $data->reply_file ."</a>";
                                                }
                                            ],

                                        ],
                                    ]) ?>
                                </div>

                            <?php else: ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?=Yii::t('main','not-answered')?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>
                            <?php if(!empty($model->unique_id)): ?>

                                <div class="col-md-12 mt-3">

                                    <div class="alert alert-danger"><?=Yii::t('main','not-found')?></div>

                                </div>

                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                </div>

                <?php ActiveForm::end(); ?>

            </div>



        </div>

        <div class="col-md-4">
            <div class="card-box">

            </div>
        </div>

    </div>
</div>