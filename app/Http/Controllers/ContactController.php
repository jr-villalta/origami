<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    public function submit(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email',
            'mensaje' => 'required|string',
        ]);

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->from($data['correo'], $data['nombre']);
            $message->to('vf19012@ues.edu.sv')->subject('Nuevo mensaje de contacto');
        });

        return back()->with('status', 'Gracias por tu mensaje, te contactaremos pronto.');
    }
}
