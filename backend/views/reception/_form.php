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

                                  <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'district_id')->textInput() ?>

                  <?= $form->field($model, 'region_id')->textInput() ?>

                  <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'gender')->textInput() ?>

                  <?= $form->field($model, 'birth_date')->textInput() ?>

                  <?= $form->field($model, 'reception_type')->textInput() ?>

                  <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

                  <?= $form->field($model, 'file')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'unique_id')->textInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                  <?= $form->field($model, 'status')->textInput() ?>

                  <?= $form->field($model, 'created_date')->textInput() ?>

                  <?= $form->field($model, 'reply_text')->textInput() ?>

                  <?= $form->field($model, 'reply_date')->textInput() ?>

                  <?= $form->field($model, 'reply_file')->textInput(['maxlength' => true]) ?>


            </div>

        </div>

    </div>

    <div class="col-md-12">

        <?=  Html::submitButton($model->isNewRecord ? Yii::t('main', 'Create') :  Yii::t('main', 'Update'), ['class' => 'btn btn-primary']) ?>

    </div>

<?php ActiveForm::end(); ?>
