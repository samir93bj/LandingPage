<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class LandingPage extends Component
{
    public $showSubscribe = false;
    public $showSuccess = false;
    public $email = '';

    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email'
    ];


    public function mount(Request $request){

        if($request->has('Verifed') && $request->Verifed == 1){
            $this->showSuccess = true;
        }
    }


   //FUNCION PARA RECIBIR EL EMAIL Y GENERAR LA SUSCRIPCION 
    public function subscribe()
    {
        $this->validate();

/*Creamos una transaccion de Base de datos, para que si se genera una 
    exception al la hora de crear el usuario en la base de datos, 
    automaticamente se borre de la base de datos*/

        DB::transaction(function () { 

            $subscriber = Subscriber::create([ //Guardamos el Email recibido 
                'email' => $this->email,
            ]);
                
            $notification = new VerifyEmail;

            $notification::createUrlUsing(function($notifiable){

                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey(),
                    ]
                );
            });

            $subscriber->notify($notification);
    
        }, $deadlockRetries = 5); //Indica la cantidad de posibilidades para crear la subscripcion

            $this->reset('email');
            $this->showSubscribe = false;
            $this->showSuccess = true;
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
} 
    