<?php

namespace App\Livewire\Components\Layout;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $user;
    public function mount(){
        $this->user = Auth::user();
    }

    public function logout(){
        Auth::guard('web')->logout();
        Session::flush();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.components.layout.header');
    }


}
