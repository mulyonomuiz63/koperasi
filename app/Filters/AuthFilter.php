<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {


        // helper('m_helper');
        // $uri = service('uri');
        // if ($uri->getSegment(1)) {
        //     if (roleAkses(session()->get('iduser'), $uri->getSegment(1))) {
        //         return redirect()->to('/');
        //     }
        // }

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
        helper('m');
        $uris = service('uri');
        $url = $uris->getSegment(1);
        $total = $uris->getTotalSegments();
        if (session()->get('status') != '1') {
            if ($url != 'pengepul') {
                return redirect()->to('pengepul/edit/' . encode(session()->get('iduser')));
            }
        }
        if ($total == 1) {
            if (!lihat(session()->get('iduser'), "$url")) {
                return redirect()->to('dashboard');
            }
        } elseif ($total == 2) {
            if (!tambah(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'tambah') {
                return redirect()->to('dashboard');
            }
            if (!ubah(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'ubah') {
                return redirect()->to('dashboard');
            }
            if (!hapus(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'hapus') {
                return redirect()->to('dashboard');
            }
            if (!aprove(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'aprove') {
                return redirect()->to('dashboard');
            }
            if (!cetak(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'cetak') {
                return redirect()->to('dashboard');
            }
            if (!export(session()->get('iduser'), "$url") && $uris->getSegment(2) == 'export') {
                return redirect()->to('dashboard');
            }
        }
    }
}
