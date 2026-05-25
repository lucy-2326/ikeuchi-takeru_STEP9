<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(ContactRequest $request)
    {
        $validatedData = $request->validated();

        Mail::to('admin@example.com')->send(new ContactMail($validatedData));

        return redirect()->route('products.index')
            ->with('success', 'お問い合わせを送信しました');
    }
}
