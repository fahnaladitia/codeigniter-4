<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    $data = [
      "title" => "Home | Web Latihan",
    ];
    return view("pages/home", $data);
  }

  public function about()
  {
    $data = [
      "title" => "About | Web Latihan",
    ];
    return view("pages/about", $data);
  }

  public function contact()
  {
    $data = [
      "title" => "Contact Us",
      "alamat" => [
        [
          "tipe" => "rumah",
          "alamat" => "M.Said Gg.damai",
          "kota" => "Samarinda",
        ],
        [
          "tipe" => "kantor",
          "alamat" => "M.Said Gg.damai 123",
          "kota" => "BalikPapan",
        ],
      ],
    ];
    return view("pages/contact", $data);
  }
}
