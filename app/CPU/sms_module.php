<?php

namespace App\CPU;

use App\Model\BusinessSetting;
use Illuminate\Support\Facades\Config;
use Nexmo\Laravel\Facade\Nexmo;
use Twilio\Rest\Client;

class SMS_module
{
    public static function send($receiver, $otp)
    {
        // $config = self::get_settings('twilio_sms');
        // if (isset($config) && $config['status'] == 1) {
        //     $response = self::twilio($receiver, $otp);
        //     return $response;
        // }

        // $config = self::get_settings('nexmo_sms');
        // if (isset($config) && $config['status'] == 1) {
        //     $response = self::nexmo($receiver, $otp);
        //     return $response;
        // }

        // $config = self::get_settings('2factor_sms');
        // if (isset($config) && $config['status'] == 1) {
        //     $response = self::two_factor($receiver, $otp);
        //     return $response;
        // }

        // $config = self::get_settings('msg91_sms');
        // if (isset($config) && $config['status'] == 1) {
            // $response = self::msg_91($receiver, $otp);
            // return $response;
        // }

        // $config = self::get_settings('releans_sms');
        // if (isset($config) && $config['status'] == 1) {
        //     $response = self::releans($receiver, $otp);
        //     return $response;
        // }

        return 'not_found';
    }

    public static function twilio($receiver, $otp)
    {
        $config = self::get_settings('twilio_sms');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $message = str_replace("#OTP#", $otp, $config['otp_template']);
            $sid = $config['sid'];
            $token = $config['token'];
            try {
                $twilio = new Client($sid, $token);
                $twilio->messages
                    ->create($receiver, // to
                        array(
                            "messagingServiceSid" => $config['messaging_service_sid'],
                            "body" => $message
                        )
                    );
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function nexmo($receiver, $otp)
    {
        $sms_nexmo = self::get_settings('nexmo_sms');
        $response = 'error';
        if (isset($sms_nexmo) && $sms_nexmo['status'] == 1) {
            $message = str_replace("#OTP#", $otp, $sms_nexmo['otp_template']);
            try {
                $config = [
                    'api_key' => $sms_nexmo['api_key'],
                    'api_secret' => $sms_nexmo['api_secret'],
                    'signature_secret' => '',
                    'private_key' => '',
                    'application_id' => '',
                    'app' => ['name' => '', 'version' => ''],
                    'http_client' => ''
                ];
                Config::set('nexmo', $config);
                Nexmo::message()->send([
                    'to' => $receiver,
                    'from' => $sms_nexmo['from'],
                    'text' => $message
                ]);
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function two_factor($receiver, $otp)
    {
        $config = self::get_settings('2factor_sms');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $api_key = $config['api_key'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://2factor.in/API/V1/" . $api_key . "/SMS/" . $receiver . "/" . $otp . "",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if (!$err) {
                $response = 'success';
            } else {
                $response = 'error';
            }
        }
        return $response;
    }

    public static function msg_91($receiver, $otp)
    {
        // $config = self::get_settings('msg91_sms');
        // $response = 'error';
        // if (isset($config) && $config['status'] == 1) {
        //     $receiver = str_replace("+", "", $receiver);
        //     $curl = curl_init();
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=" . $config['template_id'] . "&mobile=" . $receiver . "&authkey=" . $config['authkey'] . "",
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_ENCODING => "",
        //         CURLOPT_MAXREDIRS => 10,
        //         CURLOPT_TIMEOUT => 30,
        //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //         CURLOPT_CUSTOMREQUEST => "GET",
        //         CURLOPT_POSTFIELDS => "{\"OTP\":\"$otp\"}",
        //         CURLOPT_HTTPHEADER => array(
        //             "content-type: application/json"
        //         ),
        //     ));
        //     $response = curl_exec($curl);
        //     $err = curl_error($curl);
        //     curl_close($curl);
        //     if (!$err) {
        //         $response = 'success';
        //     } else {
        //         $response = 'error';
        //     }
        // }
        // return $response;
        
        // $config = self::get_settings('msg91_sms');
        // $response = 'error';
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "http://mshastra.com/sendurlcomma.aspx?user=20101509&pwd=P1bwPPu&senderid=VAIBKT&CountryCode=91&mobileno=".$receiver."&msgtext=Your%20OTP%20is%20" . $otp . "%20for%20Vaidik%20Basket%20Registration%20Process%2C%20please%20don't%20share%20this%20with%20anyone.",
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 30,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => "GET",
        // CURLOPT_HTTPHEADER => array(
        //     "cache-control: no-cache",
        //     "postman-token: a29594be-8fb7-756c-cb5d-210fa02c60dd"
        // ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);
        // return $response;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        // CURLOPT_URL =>'http://sms.unitechitsolution.in:6005/api/v2/SendSMS?SenderId=UNITCH&Is_Unicode=false&Is_Flash=false&Message=Dear%20user%20'.$otp.'%20is%20your%20Unitech%20IT%20Solution%20verification%20code%2C%20thank%20you%20for%20registration.&MobileNumbers=91'.$receiver.'&ApiKey=AI2aF6zxu1Mtv0NcUYKzkNxa%20Sb86MmfiLXLObO0mDQ%3D&ClientId=85d288ac-b598-4627-a46e-0696f0446bcd',

        CURLOPT_URL =>'http://login.chunavsms.com/api/sendhttp.php?authkey=35346e6573687036333304&mobiles=91'.$receiver.'&message=Dear, '.$otp.' is your verification code sent by JANAK CONSTRUCTION for Ramakadawala Registration.&sender=RMAKDA&route=2&country=0&DLT_TE_ID=1207172413881182910',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0),
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0),
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/xml'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function releans($receiver, $otp)
    {
        $config = self::get_settings('releans_sms');
        $response = 'error';
        if (isset($config) && $config['status'] == 1) {
            $curl = curl_init();
            $from = $config['from'];
            $to = $receiver;
            $message = str_replace("#OTP#", $otp, $config['otp_template']);

            try {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.releans.com/v2/message",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "sender=$from&mobile=$to&content=$message",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer ".$config['api_key']
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response = 'success';
            } catch (\Exception $exception) {
                $response = 'error';
            }

        }
        return $response;
    }

    public static function get_settings($name)
    {
        $config = null;
        $data = BusinessSetting::where(['type' => $name])->first();
        if (isset($data)) {
            $config = json_decode($data['value'], true);
            if (is_null($config)) {
                $config = $data['value'];
            }
        }
        return $config;
    }

    public static function send_otp($receiver, $otp)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://login.chunavsms.com/api/sendhttp.php?authkey=35346e6573687036333304&mobiles=91'.$receiver.'&message=Dear,%20'.$otp.'%20is%20your%20verification%20code%20sent%20by%20JANAK%20CONSTRUCTION%20for%20Ramakadawala%20Registration.&sender=RMAKDA&route=2&country=0&DLT_TE_ID=1207172413881182910',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/xml'
            ),
        ));
    
        $response = curl_exec($curl);
        // dd($response);
        curl_close($curl);
    
        return $response;
        
        // return 'otp send sms';
    }
}
