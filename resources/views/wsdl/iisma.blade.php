<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<definitions name="IismaService"
             targetNamespace="http://localhost:8000/soap"
             xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:tns="http://localhost:8000/soap"
             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
             xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/">
    
    <!-- Definisikan jenis pesan -->
    <message name="IismaFuncRequest">
        <part name="transportasiId" type="xsd:int"/>
        <part name="jumlahOrang" type="xsd:string"/> <!-- Array of mahasiswaIds -->
    </message>

    <message name="IismaFuncResponse">
        <part name="routeData" type="xsd:string"/>
        <part name="jumlahOrang" type="xsd:int"/>
        <part name="hargaPerOrang" type="xsd:int"/>
        <part name="totalHarga" type="xsd:int"/>
        <part name="diskon" type="xsd:int"/>
        <part name="hargaSetelahDiskon" type="xsd:int"/>
    </message>

    <!-- Definisikan operasi -->
    <portType name="IismaServicePortType">
        <operation name="iismaFunc">
            <input message="tns:IismaFuncRequest"/>
            <output message="tns:IismaFuncResponse"/>
        </operation>
    </portType>

    <!-- Tentukan binding -->
    <binding name="IismaServiceBinding" type="tns:IismaServicePortType">
        <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http"/>
        <operation name="iismaFunc">
            <soap:operation soapAction="http://localhost:8000/soap/iismaFunc"/>
            <input>
                <soap:body use="encoded" namespace="http://localhost:8000/soap" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
            </input>
            <output>
                <soap:body use="encoded" namespace="http://localhost:8000/soap" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
            </output>
        </operation>
    </binding>

    <!-- Tentukan service -->
    <service name="IismaService">
        <documentation>SOAP Web Service for Iisma</documentation>
        <port name="IismaServicePort" binding="tns:IismaServiceBinding">
            <soap:address location="http://localhost:8000/soap/iismafunc"/>
        </port>
    </service>

</definitions>
