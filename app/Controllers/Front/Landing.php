<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;

class Landing extends BaseController
{
    public function index()
    {
        $data['produk'] = $this->m_landing->get_dataproduk()->getResult();
        return view('front/landing/index', $data);
    }
}
