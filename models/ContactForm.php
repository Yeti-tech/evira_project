<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */

    public function contact(string $email): bool
    {
        if ($this->validate()) {
            try {
                Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['senderEmail'])
                    ->setTo($email)
                    ->setSubject($this->subject)
                    ->setHtmlBody($this->body)
                    ->send();
                return true;
            } catch (\Swift_TransportException $exception) {
                return false;
            }
        }
        return false;
    }

    //fills in data for email
    public static function emailPasswordRestore($posted_email, $token): bool
    {
        $email_sender = new self;
        $email_sender->name = Yii::$app->params['senderName'];
        $email_sender->subject =  'Восстановление пароля';
        $email_sender->body = '<b>Evira</b><br> Перейдите по ссылке, чтобы восстановить пароль <a href="http://evira/web/password-restore/vertoken?token=' .$token. '">http://evira/web/password-restore/vertoken</a></b>';
       // $email_sender->body = '>';
        $email_sender->email = $posted_email;
        return $email_sender->contact($posted_email);
    }


}
