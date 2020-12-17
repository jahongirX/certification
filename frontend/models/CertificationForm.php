<?php


namespace frontend\models;


use common\components\Model;
use kartik\mpdf\Pdf;
use Yii;

class CertificationForm extends Model
{
    public $email;
    public $fio;

    public function rules()
    {
        return [

            ['fio', 'trim'],
            ['fio', 'required' , 'message'=>'"{attribute}" Не можеть быть пустым'],
            ['fio', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required' , 'message'=>'"{attribute}" Не можеть быть пустым'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'fio' => 'ФИО'
        ];
    }

    public static function downloadPdf($content){

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginTop' => 0,
            'marginBottom' => 0,
            'marginLeft' => 0,
            'marginRight' => 0,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.name{position:absolute;left:21.4%;top:29%;font-size: 70px;color: #000;}.pdf{height:100%;background-image: url(/images/cert-bg.jpg);background-size:cover;}',
            // set mPDF properties on the fly
//                'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
//                    'SetHeader'=>['Krajee Report Header'],
//                    'SetFooter'=>['{PAGENO}'],
                'SetWatermarkImage' => ['../images/cert-bg.jpg'],
            ],


        ]);

        $filename = "cerificate_" . date('d_m_Y__H_i_s') . "___" . $model->fio . '.pdf';
        Yii::$app->session->setFlash('success','Спасибо за участие на конференции! Ваш сертификат участника было отправлен на Ваш E-mail тоже! )');
        $pdf->content = $content;
        $pdf->filename = $filename;
        $pdf->destination = pdf::DEST_DOWNLOAD;
        return $pdf->render();
    }
}