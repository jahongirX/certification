<?php

$this->title = Yii::t('main', 'Home');

?>

<div class="container-fluid m-t-50">

    <div class="">

        <div class="row">

            <div class="col-md-3">

                <div class="card card-default text-center">
                    <div class="card-body bg-warning" style="padding: 15px">
                        <h4><span class="semi-bold">Yangi murojaatnomalar</span></h4>
                        <h1 class="text-center border" style="border: 1px solid #eee;padding: 30px;font-size: 60px"><?=$model->where(['status'=>0])->count()?></h1>
                        <a href="<?=\yii\helpers\Url::to(['reception/index'])?>?ReceptionSearch%5Bstatus%5D=0" class="btn btn-info btn-block">O'tish</a>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-default text-center">
                    <div class="card-body bg-primary" style="padding: 15px">
                        <h4><span class="semi-bold">Jarayonda</span></h4>
                        <h1 class="text-center border" style="border: 1px solid #eee;padding: 30px;font-size: 60px"><?=$model->where(['status'=>1])->count()?></h1>
                        <a href="<?=\yii\helpers\Url::to(['reception/index'])?>?ReceptionSearch%5Bstatus%5D=1" class="btn btn-info btn-block">O'tish</a>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-default text-center">
                    <div class="card-body bg-danger" style="padding: 15px">
                        <h4><span class="semi-bold">Inkor etilgan</span></h4>
                        <h1 class="text-center border" style="border: 1px solid #eee;padding: 30px;font-size: 60px"><?=$model->where(['status'=>3])->count()?></h1>
                        <a href="<?=\yii\helpers\Url::to(['reception/index'])?>?ReceptionSearch%5Bstatus%5D=3" class="btn btn-warning btn-block">O'tish</a>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="card card-default text-center">
                    <div class="card-body bg-success" style="padding: 15px">
                        <h4><span class="semi-bold">Javob yo'llangan</span></h4>
                        <h1 class="text-center border" style="border: 1px solid #eee;padding: 30px;font-size: 60px"><?=$model->where(['status'=>2])->count()?></h1>
                        <a href="<?=\yii\helpers\Url::to(['reception/index'])?>?ReceptionSearch%5Bstatus%5D=2" class="btn btn-warning btn-block">O'tish</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>