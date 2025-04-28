<?php

namespace App\Http\Controllers;

use App\Models\HelpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HelpRequestController extends Controller
{
    public function createHelpRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'subject.required' => 'Subject is required',
            'address.required' => 'Address is required',
            'message.required' => 'Message is required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            sweetalert()->error($message);
            return redirect()->back()->withInput()->setStatusCode(422);
        }

        HelpRequest::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'address' => $request->address,
            'message' => $request->message,
        ]);

        sweetalert()->success('Your request has been submitted!');
        return redirect()->route('helpCenter')->setStatusCode(201);
    }
}
