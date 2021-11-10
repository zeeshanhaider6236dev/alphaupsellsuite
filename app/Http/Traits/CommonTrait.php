<?php
namespace App\Http\Traits;

use Carbon\Traits\make;
use GuzzleHttp\request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

trait CommonTrait {

    public function welcomeEmail($data){
        Mail::send('emails.welcome', ['data' => $data], function ($mail ) use ($data){
            $mail->from('support@alpha-google-shopping-feed.com', 'ALPHA Google Shopping Feed App');
            $mail->to($data['email'])
            ->subject('Welcome to ALPHA Google Shopping Feed');
        });
    }

    public function UninstallEmail($data){
        Mail::send('emails.uninstall', ['data' => $data], function ($mail ) use ($data){
            $mail->from('support@alpha-google-shopping-feed.com', 'ALPHA Google Shopping Feed');
            $mail->to($data['email'])
            ->subject('[PENDING] Uninstall is not complete ⚠️ I can help 👋🏻');
        });
    }

     public function validation($rules,$extraFields = null,$flag2 = false)
    {
        $ruleStr = [];
        foreach ($rules as $value) :
            $ruleStr[]=$value;
        endforeach;
        $rules = config('formValidation.'.implode('.',$ruleStr));
        if($extraFields):
            foreach ($extraFields as $extra) :
                $flag = true;
                foreach ($rules as $key => &$rule) :
                    if($extra['key'] == $key):
                        foreach ($extra['value'] as $val) :
                            $rule[] = $val;
                        endforeach;
                        $flag = false;
                        $rules[$key] = $rule;
                        break;
                    endif;
                endforeach;  
                if($flag):
                    $rules[$extra['key']] = $extra['value'];
                endif;                  
            endforeach;
        endif;
        $validator = validator(request()->all(),$rules);
        if($validator->fails()):
            if($flag2):
                return $validator;
            else:
                return response()->json(['errors' => $validator->errors()]);
            endif;
        endif;
        return $validator->validated();
    }
    
    public function jsonResponse($msg = null,$type = null,$reload = false)
    {   
        if($msg == null && $type == null):
            return response()->json([
                'msg' => [
                    'msg' => 'Something went wrong.' ,
                    'type' => 'error'
                ]
            ]);
        endif;
        if(is_array($msg)):
            return response()->json($msg);
        endif;
        if($reload):
            return response()->json([
                'msg' => [
                    'msg' => $msg ,
                    'type' => $type,
                    'reload' => true
                ]
            ]);    
        endif;
        return response()->json([
            'msg' => [
                'msg' => $msg ,
                'type' => $type
            ]
        ]);
    }

    public function simpleResponse($msg = null,$type = null)
    {   
        if($msg != null && $type != null):
            return back()->with( $type , $msg);
        endif;
        if(is_array($msg)):
            return back()->with($msg);
        endif;
        return back()->with(['error' => 'Something Went Wrong.']);
    }
}