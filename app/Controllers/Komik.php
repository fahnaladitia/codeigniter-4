<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;

  public function __construct()
  {
    $this->komikModel = new KomikModel();
  }
  public function index()
  {
    // $komik = $this->komikModel->findAll();
    $data = [
      "title" => "Daftar Komik",
      "komik" => $this->komikModel->getKomik(),
    ];

    // $komikModel = new \App\Models\KomikModel();

    return view("komik/index", $data);
  }

  public function detail($slug)
  {
    $data = [
      "title" => "Detail Komik",
      "komik" => $this->komikModel->getKomik($slug),
    ];

    // jika komik tidak ada di tabel
    if (empty($data["komik"])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException(
        "Judul komik " . $slug . " Tidak Ditemukan"
      );
    }
    return view("komik/detail", $data);
  }

  public function create()
  {
    // session();
    $data = [
      "title" => "Form Tambah Data Komik",
      "validation" => \Config\Services::validation(),
    ];
    return view("komik/create", $data);
  }

  public function save()
  {
    // validasi Input
    if (
      !$this->validate([
        "judul" => [
          "rules" => "required|is_unique[komik.judul]",
          "errors" => [
            "required" => "{field} komik harus diisi.",
            "is_unique" => "{field} komik sudah terdaftar",
          ],
        ],
      ])
    ) {
      $validation = \Config\Services::validation();
      return redirect()
        ->to("/komik/create")
        ->withInput()
        ->with("validation", $validation);
    }

    $slug = url_title($_POST["judul"], "-", true);
    $this->komikModel->save([
      "judul" => $_POST["judul"],
      "slug" => $slug,
      "penulis" => $_POST["penulis"],
      "penerbit" => $_POST["penerbit"],
      "sampul" => $_POST["sampul"],
    ]);

    session()->setFlashData("pesan", "Data Berhasil Ditambahkan.");

    return redirect()->to("/komik");
  }

  public function delete($id)
  {
    $this->komikModel->delete($id);
    session()->setFlashData("pesan", "Data Berhasil Dihapus.");
    return redirect()->to("/komik");
  }

  public function edit($slug)
  {
    $data = [
      "title" => "Form Edit Data Komik",
      "validation" => \Config\Services::validation(),
      "komik" => $this->komikModel->getKomik($slug),
    ];
    return view("komik/edit", $data);
  }

  public function update($id)
  {
    // cek judul
    $komikLama = $this->komikModel->getKomik($this->request->getVar("slug"));
    if ($komikLama["judul"] == $this->request->getVar("judul")) {
      $rules_judul = "required";
    } else {
      $rules_judul = "required|is_unique[komik.judul]";
    }

    if (
      !$this->validate([
        "judul" => [
          "rules" => $rules_judul,
          "errors" => [
            "required" => "{field} komik harus diisi.",
            "is_unique" => "{field} komik sudah terdaftar",
          ],
        ],
      ])
    ) {
      $validation = \Config\Services::validation();
      return redirect()
        ->to("/komik/edit/" . $this->request->getVar("slug"))
        ->withInput()
        ->with("validation", $validation);
    }

    $slug = url_title($_POST["judul"], "-", true);
    $this->komikModel->save([
      "id" => $id,
      "judul" => $_POST["judul"],
      "slug" => $slug,
      "penulis" => $_POST["penulis"],
      "penerbit" => $_POST["penerbit"],
      "sampul" => $_POST["sampul"],
    ]);

    session()->setFlashData("pesan", "Data Berhasil Diubah.");

    return redirect()->to("/komik");
  }
}