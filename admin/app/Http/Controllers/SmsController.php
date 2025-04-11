<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsLog;
use Exception;

class SmsController extends Controller
{
      public function smsSend(Request $request)
    {
        try {
        
            $phone = $request->input('phone_number');
            $message = $request->input('message');
            $smsId = $request->input('smsId'); 

            $sms = new SmsLog();
            $sms->phone = $phone;
            $sms->message = $message;
            $sms->sent_sms_employee_id = $smsId;
            $sms->user_id = 1; 
            $sms->save(); 

            return response()->json(['success' => true, 'message' => 'Sms Başarıyla Gönderildi!']);

        } catch (Exception $e) {

            return response()->json(['success' => false, 'message' => 'Sms Gönderilemedi! Hata: ' . $e->getMessage()]);
        }
    }
}
