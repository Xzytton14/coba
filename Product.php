<?php
// Class Induk (Abstract Class - tidak bisa diinstansiasi langsung)
abstract class Product {
    protected $id;
    protected $name;
    protected $price;

    public function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getName() { return $this->name; }
    public function getPrice() { return "Rp " . number_format($this->price, 0, ',', '.'); }

    // Method Polimorfisme: Setiap anak class WAJIB mengimplementasikan ini dengan caranya sendiri
    abstract public function getInfo();
}

// 1. Inheritance: PhysicalProduct mewarisi Product
class PhysicalProduct extends Product {
    private $weight;

    public function __construct($id, $name, $price, $weight) {
        parent::__construct($id, $name, $price); // Memanggil constructor induk
        $this->weight = $weight;
    }

    // Polimorfisme: Mengisi detail spesifik untuk produk fisik
    public function getInfo() {
        return "📦 <strong>Produk Fisik</strong> (Berat: " . $this->weight . ")";
    }
}

// 2. Inheritance: DigitalProduct mewarisi Product
class DigitalProduct extends Product {
    private $downloadUrl;

    public function __construct($id, $name, $price, $downloadUrl) {
        parent::__construct($id, $name, $price); // Memanggil constructor induk
        $this->downloadUrl = $downloadUrl;
    }

    // Polimorfisme: Mengisi detail spesifik untuk produk digital
    public function getInfo() {
        return "⚡ <strong>Produk Digital</strong> (<a href='" . $this->downloadUrl . "' class='text-blue-500 underline' target='_blank'>Download Link</a>)";
    }
}
?>