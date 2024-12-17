<?php
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Composer autoload.php tidak ditemukan. Pastikan Composer diinstal.');
}
require __DIR__ . '/vendor/autoload.php';

// Buat kelas untuk layanan WSDL
class ApiFutsalService
{
    /**
     * Get all categories
     * @return array
     */
    public function getCategory()
    {
        return [];
    }

    /**
     * Get all pemesanan
     * @return array
     */
    public function getPemesanan()
    {
        return [];
    }

    /**
     * Get rute by ID
     * @param int $id
     * @return array
     */
    public function getRuteById($id)
    {
        return [];
    }

    /**
     * Get transportasi by category ID
     * @param int $category_id
     * @return array
     */
    public function getTransportasiKategori($category_id)
    {
        return [];
    }
}

// Membuat WSDL secara manual
$wsdl = new DOMDocument();
$wsdl->formatOutput = true;

// Membuat elemen WSDL: <definitions>
$definitions = $wsdl->createElement('wsdl:definitions');
$definitions->setAttribute('name', 'ApiFutsalService');
$definitions->setAttribute('targetNamespace', 'http://127.0.0.1:8000/api/futsal');
$definitions->setAttribute('xmlns:wsdl', 'http://schemas.xmlsoap.org/wsdl/');
$definitions->setAttribute('xmlns:tns', 'http://127.0.0.1:8000/api/futsal');
$definitions->setAttribute('xmlns:xsd', 'http://www.w3.org/2001/XMLSchema');
$wsdl->appendChild($definitions);

// Membuat bagian types untuk WSDL
$types = $wsdl->createElement('wsdl:types');
$schema = $wsdl->createElement('xsd:schema');
$schema->setAttribute('targetNamespace', 'http://127.0.0.1:8000/api/futsal');
$types->appendChild($schema);
$definitions->appendChild($types);

// Membuat bagian message untuk operasi

// Message untuk getCategory
$messageCategory = $wsdl->createElement('wsdl:message');
$messageCategory->setAttribute('name', 'getCategoryRequest');
$partCategory = $wsdl->createElement('wsdl:part');
$partCategory->setAttribute('name', 'parameters');
$partCategory->setAttribute('element', 'tns:getCategory');
$messageCategory->appendChild($partCategory);
$definitions->appendChild($messageCategory);

// Message untuk getPemesanan
$messagePemesanan = $wsdl->createElement('wsdl:message');
$messagePemesanan->setAttribute('name', 'getPemesananRequest');
$partPemesanan = $wsdl->createElement('wsdl:part');
$partPemesanan->setAttribute('name', 'parameters');
$partPemesanan->setAttribute('element', 'tns:getPemesanan');
$messagePemesanan->appendChild($partPemesanan);
$definitions->appendChild($messagePemesanan);

// Message untuk getRuteById
$messageRuteById = $wsdl->createElement('wsdl:message');
$messageRuteById->setAttribute('name', 'getRuteByIdRequest');
$partRuteById = $wsdl->createElement('wsdl:part');
$partRuteById->setAttribute('name', 'parameters');
$partRuteById->setAttribute('element', 'tns:getRuteById');
$messageRuteById->appendChild($partRuteById);
$definitions->appendChild($messageRuteById);

// Message untuk getTransportasiKategori
$messageTransportasi = $wsdl->createElement('wsdl:message');
$messageTransportasi->setAttribute('name', 'getTransportasiKategoriRequest');
$partTransportasi = $wsdl->createElement('wsdl:part');
$partTransportasi->setAttribute('name', 'parameters');
$partTransportasi->setAttribute('element', 'tns:getTransportasiKategori');
$messageTransportasi->appendChild($partTransportasi);
$definitions->appendChild($messageTransportasi);

// Membuat bagian operation untuk setiap method
// getCategory
$operationCategory = $wsdl->createElement('wsdl:operation');
$operationCategory->setAttribute('name', 'getCategory');
$inputCategory = $wsdl->createElement('wsdl:input');
$inputCategory->setAttribute('message', 'tns:getCategoryRequest');
$operationCategory->appendChild($inputCategory);

// getPemesanan
$operationPemesanan = $wsdl->createElement('wsdl:operation');
$operationPemesanan->setAttribute('name', 'getPemesanan');
$inputPemesanan = $wsdl->createElement('wsdl:input');
$inputPemesanan->setAttribute('message', 'tns:getPemesananRequest');
$operationPemesanan->appendChild($inputPemesanan);

// getRuteById
$operationRuteById = $wsdl->createElement('wsdl:operation');
$operationRuteById->setAttribute('name', 'getRuteById');
$inputRuteById = $wsdl->createElement('wsdl:input');
$inputRuteById->setAttribute('message', 'tns:getRuteByIdRequest');
$operationRuteById->appendChild($inputRuteById);

// getTransportasiKategori
$operationTransportasi = $wsdl->createElement('wsdl:operation');
$operationTransportasi->setAttribute('name', 'getTransportasiKategori');
$inputTransportasi = $wsdl->createElement('wsdl:input');
$inputTransportasi->setAttribute('message', 'tns:getTransportasiKategoriRequest');
$operationTransportasi->appendChild($inputTransportasi);

// Menambahkan operation ke dalam WSDL
$portType = $wsdl->createElement('wsdl:portType');
$portType->setAttribute('name', 'ApiFutsalServicePortType');
$portType->appendChild($operationCategory);
$portType->appendChild($operationPemesanan);
$portType->appendChild($operationRuteById);
$portType->appendChild($operationTransportasi);
$definitions->appendChild($portType);

// Menambahkan binding
$binding = $wsdl->createElement('wsdl:binding');
$binding->setAttribute('name', 'ApiFutsalServiceBinding');
$binding->setAttribute('type', 'tns:ApiFutsalServicePortType');
$definitions->appendChild($binding);

// Menambahkan service
$service = $wsdl->createElement('wsdl:service');
$service->setAttribute('name', 'ApiFutsalService');
$port = $wsdl->createElement('wsdl:port');
$port->setAttribute('name', 'ApiFutsalServicePort');
$port->setAttribute('binding', 'tns:ApiFutsalServiceBinding');
$service->appendChild($port);
$definitions->appendChild($service);

// Menyimpan file WSDL ke direktori
file_put_contents(__DIR__ . '/storage/wsdl/futsal.wsdl', $wsdl->saveXML());

echo "WSDL file has been generated successfully.";
?>
