<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public static function store($user)
    {
        return Payment::create([ 'user_id' => $user->id]); 
    }

    public static function update(Request $request, User $user)
    {
        $request->validate([
            'payment' => 'nullable|max:20000'
        ]);

        $payment = $request->file('payment');
        $payment->storeAs('public/payment', $payment->hashName());
        Storage::delete('public/payment/' . $user->payment->path);
        
        Payment::where('user_id', $user->id)->update([
            'name'   => $payment->getClientOriginalName(),
            'path'   => $payment->hashName(),
            'status' => 'processing'
        ]);

        return back()->with('success', 'Upload payment reciept success');
    }

    public function download(Payment $payment)
    {
        $path = 'storage/payment/' . $payment->path;        
        $name = $payment->name;
        
        return response()->download($path, $name);
    }

    public function confirm(Payment $payment, $status)
    {
        if($status == 'valid') {
            $status = 'paid';
        } else {
            $status = 'unpaid'; 
            Storage::delete('public/payment/'.$payment->file);
        }

        Payment::where('id', $payment->id)->update(['status' => $status]);

        return back();
    }
}
