<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $users;

    public function mount()
    {
        $response = Http::withToken(session('api_token'))->get(config('app.api_url'). '/api/users');
        $this->users = $response->ok() ? $response->json() : [];
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
