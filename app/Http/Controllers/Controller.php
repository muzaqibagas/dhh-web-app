<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Artikel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        return view('guest.home');    
    }

    public function file()
    {
        return view('guest.file');
    }

    public function pendidikans1()
    {
        return view('guest.pendidikans1');    
    }

    public function pendidikans2()
    {
        return view('guest.pendidikans2');    
    }

    public function pendidikans3()
    {
        return view('guest.pendidikans3');    
    }  

    public function galleryguest()
    {
        return view('guest.gallery');    
    }

    public function artikelguest()
    {
        return view('guest.artikelguest');    
    }

    public function artikeldetail(Artikel $artikel)
    {        
        return view('guest.artikeldetail');    
    }

    public function alumnikami()
    {
        return view('guest.alumnikami');    
    }

    public function staffdetail()
    {
        return view('guest.staffdetail');    
    }
}