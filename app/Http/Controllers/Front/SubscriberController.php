<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if (!$validator->passes()) {

            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {


            $token = hash('sha256', time());

            $subscriber = new Subscriber();



            $subscriber->email = $request->email;
            $subscriber->token = $request->token;
            $subscriber->status = 'Pending';
            $subscriber->save();


            // Send email
            $subject = 'Subscriber Email Verify';

            $verification_link = url('subscriber/verify/' . $token);

            $message = 'Please click on the following link in order to verify as subscriber<br>';

            $message .= '<a href="' . $verification_link . '">';
            $message .= $verification_link;
            $message .= '</a>';


            \Mail::to($request->email)->send(new Websitemail($subject, $message));

            return response()->json(['code' => 1, 'success_message' => 'Email is sent!']);
        }
    }


    public function verify($token, $email)
    {
        echo $token;
        echo '<br>';
        echo $email;
    }
}
