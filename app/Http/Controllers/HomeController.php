<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class HomeController extends Controller
{

    public function index(){
        $training = Training::latest()->limit(6)->get();

        $clients = collect([
            '/images/clients/unpad.png',
            '/images/clients/STFI.png',
            '/images/clients/undip.png',
            '/images/clients/univ-jember.png',
            '/images/clients/BEM-FKM-UNDIP.png',
            '/images/clients/perawat.png',
            '/images/clients/HMJ.png',
            '/images/clients/99.png',
            '/images/clients/yayasan-hasanah.png',
            '/images/clients/al-amanah.png',
            '/images/clients/bmka.png',
            '/images/clients/PPIDK.png',
            '/images/clients/and.png',
            '/images/clients/rumah-amal.png',
            '/images/clients/sukses.png',
            '/images/clients/interest.png',
            '/images/clients/cyberblitz.png',
            '/images/clients/Telkom.png',
        ]);

        $youtube = Collect([
            'pYQkGE9bN8k',
            '3BVwKKhNf1Y',
            '4SXkBaOFy6E',
            '5xtPYqvh2a8',
            'w8xvZ_1e1KQ',
        ]);

        return view('landing.home',[
            'training' => $training,
            'clients' => $clients,
            'youtube' => $youtube
        ]);
    }

    public function about(){


        return view('landing.about');
    }
}
