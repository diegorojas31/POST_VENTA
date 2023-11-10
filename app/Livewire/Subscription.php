<?php

namespace App\Livewire;

use Livewire\Component;

class Subscription extends Component
{

    //propiedad computada para recuperar el metodo predetermindado
    //son funciones, pero podemos acceder como a propiedades
    public function getDefaultPaymentMethodProperty()
    {
        return auth()->user()->defaultPaymentMethod();
    }

    public function newSubscription($plan)
    {
        //dd($plan);
        if (! $this->defaultPaymentMethod) {
            //$this->emit('error','¡No tienes un método de pago por defecto!');
            session()->flash('error', 'No tienes un metodo de pago por defecto');
            return;
        }
       
       //suscribirse
        //auth()->user()->newSubscription('Cuso Suscripciones',$plan)->create($this->defaultPaymentMethod->id);

        //capturar error
        try{
            if(auth()->user()->subscribed('POST BASICO')){
                auth()->user()->subscription('POST BASICO')->swap($plan);
                return;
            }
            auth()->user()->newSubscription('POST BASICO',$plan)->create($this->defaultPaymentMethod->id);
            auth()->user()->refresh();

        }catch (\Exception $e) {    
            session()->flash('error', 'El intento de pago fallo debido a un metodo de pago no valido');
        }
    }

    //canelar subscripcion
    public function cancelSubscription(){
        auth()->user()->subscription('POST BASICO')->cancel();
    }

    //reanudar subscription
    public function resumeSubscription(){
        auth()->user()->subscription('POST BASICO')->resume();
    }


    public function render()
    {
        return view('livewire.subscription');
    }
}
