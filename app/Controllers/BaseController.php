<?php

namespace App\Controllers;

use App\Models\M_bayer;
use App\Models\M_karyawan;
use App\Models\M_komoditi;
use App\Models\M_kualitas;
use App\Models\M_login;
use App\Models\M_menu;
use App\Models\M_menurole;
use App\Models\M_pengepul;
use App\Models\M_pengiriman;
use App\Models\M_produk;
use App\Models\M_role;
use App\Models\M_user;
use App\Models\M_kelompok_tani;
use App\Models\M_petani;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{





    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session;
    protected $db;
    protected $encrypt;
    protected $email;
    protected $image;
    protected $uri;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'file', 'url', 'html', 'download', 'm_helper'];
    protected $m_komoditi;
    protected $m_kualitas;
    protected $m_pengepul;
    protected $m_pengiriman;
    protected $m_produk;
    protected $m_bayer;
    protected $m_menurole;
    protected $m_menu;
    protected $m_role;
    protected $m_user;
    protected $m_login;
    protected $m_karyawan;
    protected $m_kelompok_tani;
    protected $m_petani;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        //preload library
        $config = new \Config\Encryption();
        $config->key = 'M1pT3zx500uYVodaysN68IiNYhV0KdCb';
        $config->driver = 'OpenSSL';
        $this->session =  \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->encrypt = \Config\Services::encrypter($config);
        $this->email = \Config\Services::email();
        $this->image = \Config\Services::image();
        $this->uri = service('uri');

        //preload model
        $this->m_komoditi   = new M_komoditi();
        $this->m_kualitas   = new M_kualitas();
        $this->m_pengepul   = new M_pengepul();
        $this->m_pengiriman = new M_pengiriman();
        $this->m_produk     = new M_produk();
        $this->m_bayer       = new M_bayer();
        $this->m_menurole       = new M_menurole();
        $this->m_menu       = new M_menu();
        $this->m_role       = new M_role();
        $this->m_user       = new M_user();
        $this->m_login       = new M_login();
        $this->m_karyawan       = new M_karyawan();
        $this->m_kelompok_tani       = new M_kelompok_tani();
        $this->m_petani       = new M_petani();
    }
}
