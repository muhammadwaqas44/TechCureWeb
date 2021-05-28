<?php


namespace App\Services;

use App\Models\Patient;
use FCM;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FCMServices
{
    public function sendNotification(String $title, String $payloadBody, Array $additionalData, String $token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($payloadBody)->setSound('default');


        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($additionalData);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        // $token = "foGkH_Q5pxE:APA91bE87ztcTlYL3-_XnhYRayDJkg9ri5_rVTPuIJmnAWp4qAv7g9pS_zCI0GYm3Y3vWzoEsWnrX6b1TjOm_Nz7gXJ4k0Hx4_aofIp85HQXKdVA8UC5ZlkOAQGe1KcazQcdceH7mS9I";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        // return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();
        if (count($tokensToDelete) > 0) {
            Patient::whereIn('token', $tokensToDelete)->update(['token' => NULL]);
        }

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $tokensToModify = $downstreamResponse->tokensToModify();
        if (count($tokensToModify) > 0) {
            // dd("inside token to modify");

            foreach ($tokensToModify as $oldToken => $newToken) {
                if(Patient::where('token', $oldToken)->count()){
                    Patient::where('token', $oldToken)->update(['token' => $newToken]);
                }

            }
        }

        // return Array - you should try to resend the message to the tokens in the array
        $tokensToRetry = $downstreamResponse->tokensToRetry();
        if (count($tokensToRetry) > 0) {
            // dd("inside token to modify");

            foreach ($tokensToRetry as $oldToken => $newToken) {
                if(Patient::where('token', $oldToken)->count()){
                    Patient::where('token', $oldToken)->update(['token' => $newToken]);
                }
            }
        }

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();
        if($downstreamResponse->numberSuccess() > 0){
            return true;
        }else{
            false;
        }

    }

    public function sendToAll(String $title, String $payloadBody, Array $additionalData, Array $tokens)
    {

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($payloadBody)->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($additionalData);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();


        // return Array - you must remove all this tokens in your database
        $tokensToDelete = $downstreamResponse->tokensToDelete();
        if (count($tokensToDelete) > 0) {
            Patient::whereIn('token', $tokensToDelete)->update(['token' => NULL]);
        }

        // return Array (key : oldToken, value : new token - you must change the token in your database)
        $tokensToModify = $downstreamResponse->tokensToModify();
        if (count($tokensToModify) > 0) {
            // dd("inside token to modify");

            foreach ($tokensToModify as $oldToken => $newToken) {
                if(Patient::where('token', $oldToken)->count()){
                    Patient::where('token', $oldToken)->update(['token' => $newToken]);
                }

            }
        }

        // return Array - you should try to resend the message to the tokens in the array
        $tokensToRetry = $downstreamResponse->tokensToRetry();
        if (count($tokensToRetry) > 0) {
            // dd("inside token to modify");

            foreach ($tokensToRetry as $oldToken => $newToken) {
                if(Patient::where('token', $oldToken)->count()){
                    Patient::where('token', $oldToken)->update(['token' => $newToken]);
                }
            }
        }

        // return Array (key:token, value:error) - in production you should remove from your database the tokens
        $downstreamResponse->tokensWithError();
        if($downstreamResponse->numberSuccess() > 0){
            return true;
        }else{
            false;
        }
    }

}
