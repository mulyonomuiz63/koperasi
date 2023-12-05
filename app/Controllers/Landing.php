<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index(): string
    {
        $data['produk'] = $this->m_landing->get_dataproduk()->getResult();
        return view('front/landing/index', $data);
    }
}
