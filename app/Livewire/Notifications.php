<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{

    public $max = 4;

    public function render()
    {
        return view('livewire.notifications');
    }

    public function readNotification($id)
    {
        auth()->user()->notifications()->find($id)->markAsRead();
    }

    public function getNotificationsProperty(){
        return auth()->user()->notifications;
    }
}
