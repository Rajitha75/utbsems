<?php
namespace console\controllers;

use Yii;
use yii\helpers\Url;
use yii\console\Controller;
use common\models\Communique;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MailController extends Controller {
    
    /* mail cron for sending mails related to sign up, forgot password and subscribe */
    public function actionUsermails() {
        $message = '\n\n\n';
        $message = 'User Mails Function Start\n\r';
        $tmpids = [4,5,61];
        $data = Communique::find()->where(['is_sent'=>0])->AndWhere(['in', 'template_id', $tmpids])->orderBy(['communique_id' => SORT_DESC])->limit('100')->all();
        $message .= '____Total Records - '. count($data).'\n\r';
        foreach($data as $val){
            $message_sub = "____Record - Email: " . $val->to_email . "____Communication ID: " . $val->communique_id.'\n\r';
            if(preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/', $val->to_email)){
                $message_sub .= '____Email validation success\n\r';

                $status = $this->sendmail($val->to_email,$val->subject, $val->message, $val->communique_id);
                $message_sub .= '____Mail Status: '. $status.'\n\r';

                if($status != 'error'){
                    $message_sub .= '____Checking status of sending email\n\r';
                    try{
                        $message_sub .= '____In Try\n\r';
                        $model = Communique::find()->where(['communique_id' => $val->communique_id])->one();              
                        $message_sub .= '____Created communique model\n\r';
                        $model->is_sent = 1;
                        $model->save(false);
                        $message_sub .= '____Communique model saved\n\r';

                        $message_sub .= 'Date: '.date('Y-m-d H:i:s').'___Mail Sent___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                        $message .= $message_sub;
                        file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                    } catch(\Exception $e) {
                        $message_sub .= 'Date: '.date('Y-m-d H:i:s').'___Mail Sent___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                        $message .= $message_sub;
                        file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);

                        Yii::error($e->getMessage().' line No: '.$e->getLine(), 'database');
                    }
                }
                echo "cron service runnning"; 
            } else {
                $message = 'Date: '.date('Y-m-d H:i:s').'___Mail Sent___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        }
        exit;
    } 
    
    /* mail cron for sending all mails except sign up, forgot password and subscribe */
    public function actionAllmails() {
        $message = '\n\n\n';
        $message .= 'All Mails Function Start\n\r';
        $tmpids = [4,5,61];
        $data = Communique::find()->where(['is_sent'=>0])->AndWhere(['not in', 'template_id', $tmpids])->orWhere(['template_id'=>null])->orderBy(['communique_id' => SORT_DESC])->limit('100')->all();
        
        $message .= '____Total Records - '. count($data).'\n\r';
        foreach($data as $val){
            $message_sub = "____Record - Email: " . $val->to_email . "____Communication ID: " . $val->communique_id.'\n\r';
            if(preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,})$/', $val->to_email)){
                $message_sub .= '____Email validation success\n\r';
                $status = $this->sendmail($val->to_email, $val->subject, $val->message, $val->communique_id);

                $message_sub .= '____Mail Status: '. $status.'\n\r';

                if($status != 'error'){
                    $message_sub .= '____Checking status of sending email\n\r';
                    try{
                        $message_sub .= '____In Try\n\r';
                        $model = Communique::find()->where(['communique_id' => $val->communique_id])->one();
                        $message_sub .= '____Created communique model\n\r';
                        $model->is_sent = 1;
                        $model->save(false);
                        $message_sub .= '____Communique model saved\n\r';

                        $message_sub .= '____Date: '.date('Y-m-d H:i:s').'___Mail Sent___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                        $message .= $message_sub;
                        file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
                    } catch(\Exception $e) {

                        $message_sub .= '____Date: '.date('Y-m-d H:i:s').'___Mail Failed___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                        $message .= $message_sub;
                        file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);

                        Yii::error($e->getMessage().' line No: '.$e->getLine(), 'database');
                    }
                }
                echo "cron service runnning"; 
            } else {
                $message .= '___Date: '.date('Y-m-d H:i:s').'___Invalid Mail Address___To Email: '.$val->to_email.'___Subject: '.$val->subject.'\n\r';
                file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
            }
        }
        //file_put_contents("/var/www/html/equippp/frontend/web/mail_log.txt", $message. PHP_EOL, FILE_APPEND | LOCK_EX);
        exit;
    } 
    
    /* send mail functionality */
    public function sendmail($to_email,$subject, $msg, $communique_id){
        $message = '________sendmail function start\n\r';
        try{
            $message .= '____in Try\n\r';
            $mail = Yii::$app->mailer->compose();
            $message .= '____New mail composed\n\r';
            $mail->setFrom([\Yii::$app->params['supportEmail'] => 'EquiPPP'])
                ->setTo($to_email)
                ->setSubject($subject)
                ->setHtmlBody($msg)
                ->send();
            $message .= '____Mail Sent\n\r';
        }
        catch (\Swift_TransportException $e){
            $message .= '____In Catch\n\r';
            $model = Communique::find()->where(['communique_id' => $communique_id])->one();
            $message .= '____Communique Model created\n\r';
            $model->error_msg = $e->getMessage().' line No: '.$e->getLine();
            $model->save(false);
            $message .= '____Error message: '.$e->getMessage().' line No: '.$e->getLine().'\n\r';
            Yii::error($e->getMessage().' line No: '.$e->getLine(),'mail');  
            return 'error';
        }
    }
}