<?php

use common\components\StaticFunctions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/plugins/bootstrap-select2/select2.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = StaticFunctions::getPartOfText( $model->name, 150 );
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Murojaatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view','id'=>$model->id]];
$this->params['breadcrumbs'][] = "Inkor qilish";

$js = <<<'JS'
    $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        // label = input.val();
        label = input.val().replace('/\\/g', '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  $('body').on('fileselect', ':file', function(event, numFiles, label) {
      var input = $(this).parents('.input-group').find(':text'),
          log = numFiles > 1 ? numFiles + ' files selected' : label;

      if( input.length ) {
          input.val(log);
      } else {
          if( log ) alert(log);
      }

  });
JS;

$this->registerJs($js,\yii\web\View::POS_END);

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
    <div class="container-fluid container-fixed-lg m-t-20">

        <div class="panel panel-transparent">

            <div class="panel-body no-padding">

                <div class="row">

                    <div class="col-md-8">

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <?= $form->field($model, 'reply_text')->textarea(['rows'=>8])->label('Javob matni') ?>

                                <div class="row" id="files">

                                    <div class="col-md-12">

                                        <h4><?=Yii::t('main','add-file')?></h4>

                                        <div class="input-group">

                                            <label class="input-group-btn">

                                                    <span class="btn btn-primary">

                                                        Browse&hellip; <input type="file" style="display: none;" name="Reception[reply_file]" id="reception-reply-file" >

                                                    </span>

                                            </label>

                                            <input type="text" class="form-control" readonly>

                                        </div>

                                    </div>

                                    <div class="col-md-12" style="margin-top:25px">
                                        <?php
                                        if($model->reply_file && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . Yii::$app->controller->id . '/' . $model->id . '/' . $model->reply_file )) {
                                            ?>

                                            <h5><?=Yii::t('main','current-file')?> : </h5> <a class="btn btn-success" href="<?= Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . Yii::$app->controller->id . '/' . $model->id . '/' . $model->reply_file ?>" ><?=$model->reply_file?> </a>

                                            <?php
                                        } else {
                                            ?>
                                            <h5><?= Yii::t('main','File not uploaded yet!')?></h5>

                                            <?php
                                        }
                                        ?>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <?=  Html::submitButton($model->isNewRecord ? Yii::t('main', 'Send') :  Yii::t('main', 'Send'), ['class' => 'btn btn-primary']) ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php ActiveForm::end(); ?>
<?php
