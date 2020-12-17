<?php

use common\models\District;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <div class="card-box" style="padding:0 20px">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?=Url::to(['/'])?>"><?=Yii::t('main','home')?></a></li>
            <li class="breadcrumb-item active"><?=Yii::t('main','application')?></li>
        </ol>
    </div>
    <div class="card-box">
        <div class="alert alert-warning">
            <?=Yii::t('main','must-filled')?>
        </div>

        <?php
                            $form = ActiveForm::begin([
                                'id' => 'reception-form',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                            ]); ?>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'region_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Region::find()->all(),'id','name'),['id'=>'district_id','prompt' => Yii::t('main','choose')]) ?>
                </div>
                <div class="col-md-6">

                    <?php echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                                'options'=>[
                                    'id'=>'region_id',
                                    'prompt' => Yii::t('main','choose-district-first')
                                ],
                                'pluginOptions'=>[
                                    'depends'=>['district_id'],
                                    'url'=>Url::to(['/virtual/region']),
                                    'placeholder' => Yii::t('main','choose')
                                ]
                    ]); ?>

                </div>

                <div class="col-md-6">

                    <?= $form->field($model, 'name')->textInput() ?>

                </div>

                <div class="col-md-6">

                    <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => Yii::t('main','birth_date'),'autocomplete' => 'off'],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'autocomplete' => false,
                                    'format' => 'yyyy-mm-dd'
                                ],
                    ]); ?>

                </div>

                <div class="col-md-6">

                    <?= $form->field($model, 'address')->textInput() ?>

                </div>

                <div class="col-md-6">

                    <?= $form->field($model, 'email')->textInput(['type'=>'email']) ?>

                </div>

                <div class="col-md-6">

                      <?= $form->field($model, 'phone')->textInput(['type'=>'phone']) ?>

                </div>

                <div class="col-md-3">
                            <?php

                                $lang = Yii::$app->session->get('lang');
                                if(!empty($lang)){
                                    $genders = Yii::$app->params['genders'][$lang];
                                }else{
                                    $genders = Yii::$app->params['genders']['uz'];
                                }

                                if(!empty($lang)){
                                    $types = Yii::$app->params['reception_type'][$lang];
                                }else{
                                    $types = Yii::$app->params['reception_type']['uz'];
                                }

                            ?>

                            <?= $form->field($model, 'gender')->dropDownList($genders,['prompt'=>Yii::t('main','choose')]) ?>

                </div>

                <div class="col-md-3">

                      <?= $form->field($model, 'reception_type')->dropDownList($types,['prompt'=>Yii::t('main','choose')]) ?>

                </div>

                <div class="col-md-12">

                    <?= $form->field($model, 'message')->textarea(['rows'=>6]) ?>

                </div>

                <div class="col-md-12">

                    <?php

                            echo $form->field($model, 'file')->widget(FileInput::classname(), [
                                'options' => ['multiple' => false],
                                'pluginOptions' => [
                                    'previewFileType' => false,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'showCancel' => false,
                                    'browseClass' => 'btn btn-primary btn-block',
                                    'browseIcon' => '<i class="fe-upload"></i> ',
                                    'browseLabel' =>  Yii::t('main','select-file')
                                ]
                            ]);

                    ?>

                </div>

                <div class="col-md-12">

                    <div class="alert alert-info">

                        <?=Yii::t('main','agreement')?> <a target="_blank" class="btn btn-info btn-xs" href="<?=Url::to(['/#offerta'])?>"><?=Yii::t('main','offer')?></a>

                    </div>

                </div>

                <div class="col-md-12">

                    <button class="btn btn-success btn-wave btn-block btn-lg"><?=Yii::t('main','send')?></button>

                </div>

            </div>

        <?php ActiveForm::end(); ?>



    </div>

</div>