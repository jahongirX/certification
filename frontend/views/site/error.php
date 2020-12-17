<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\SearchForm;

$this->title = nl2br(Html::encode($message));
?>
<div class="site-error">
        <div class="container">
            <div class="card-box">
                <div class="row">
                                <div class="col-sm-12 module_cont pb0 text-center">
                                    <h1 class="title_404">404</h1>
                                </div>
                                <div class="col-sm-6 module_cont pt26 pb125">
                                    <div class="bg_title">
                                        <h2 class="text-left mobile-center"><?= nl2br(Html::encode($message)) ?></h2>
                                    </div>

                                    <div class="form404_def">
                                        <?php
                                        $searchModel = new SearchForm();
                                        $form = ActiveForm::begin(['action'=>'/site/search','options'=>['class'=>'search_form search404', 'name' => 'search_field']]);
                                        ?>

                                        <?= $form->field($searchModel, 'text', ['inputOptions' => [
                                            'placeholder' => 'Sahifalardan izlash...',
                                        ]])->label(false) ?>
                                        <?= Html::submitInput('Izlash') ?>

                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</div>
