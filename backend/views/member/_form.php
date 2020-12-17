<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/plugins/bootstrap-select2/select2.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="/ckfinder/ckfinder.js"></script>

<?php $form = ActiveForm::begin([
    'id' => 'create-form' . $id,
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'errorCssClass' => '',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

    <div class="col-md-8">

        <div class="panel panel-default">

            <div class="panel-body">

                                  <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'worker_status')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'lid_source')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'crm_id')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'download_count')->textInput() ?>

                  <?= $form->field($model, 'download_date')->textInput() ?>


            </div>

        </div>

    </div>

    <div class="col-md-12">

        <?=  Html::submitButton($model->isNewRecord ? Yii::t('main', 'Create') :  Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>

    </div>

<?php ActiveForm::end(); ?>
