<?php

namespace App\Http\Controllers;

use App\Services\VoucherService;
use App\Services\VoucherServiceDua;

use Illuminate\Http\Request;
use SoapServer;

class VoucherController extends Controller
{
    public function iisma()
    {
        $voucherService = new VoucherService();

        $options = [
            'uri' => 'http://localhost:8000/soap/voucher', 
            'soap_version' => SOAP_1_2,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'exceptions' => true,
        ];

        // Membuat instance SoapServer
        $server = new SoapServer(public_path('wsdl/voucher.wsdl'), $options);
        
        $server->setObject(app(VoucherService::class));
        
        $server->handle();
    }
    public function inspiba()
    {
        $voucherService = new VoucherServiceDua();

        $options = [
            'uri' => 'http://localhost:8000/soap/voucher2', 
            'soap_version' => SOAP_1_2,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'exceptions' => true,
        ];

        // Membuat instance SoapServer
        $server = new SoapServer(public_path('wsdl/voucher2.wsdl'), $options);
        
        // Gunakan aplikasi Laravel untuk meng-inject service VoucherService
        $server->setObject(app(VoucherServiceDua::class));
        
        // Menangani request SOAP
        $server->handle();
    }
}
