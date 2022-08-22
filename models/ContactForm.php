<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Boolean;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
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
                    //->setReplyTo([$this->email => $this->name])
                    ->setSubject($this->subject)
                    //->setTextBody($this->body)
                     ->setHtmlBody($this->body)
                    ->send();
                return true;
            } catch (\Swift_TransportException $exception) {
                return false;
            }
        }
        return false;
    }

    public static function emailPasswordRestore($posted_email, $token): bool
    {
        $email_sender = new self;
        $email_sender->name = 'name';
        $email_sender->subject =  'тема сообщения';
        $email_sender->body = "<b>текст сообщения в формате HTML</b><a href='http://evira/web/vertoken/&token=".$token.">Click Here to Reset Password</a>";
        $email_sender->email = $posted_email;
        return $email_sender->contact($posted_email);
    }
}
