<?php

namespace App\Controllers;

use App\Models\FormModel;
use App\Models\RSModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends BaseController
{
    protected $formModel;
    protected $rsModel;

    public function __construct()
    {
        $this->formModel = new FormModel(); // Inisialisasi model di constructor
        $this->rsModel = new RSModel(); // Inisialisasi model di constructor
    }
    public function index()
    {
        $data['list_info'] = $this->formModel
            ->select('form_data.*, rs_list.nama_rs, rs_list.jalan AS jalan_rs')
            ->join('rs_list', 'form_data.rs_id = rs_list.ID', 'left')
            ->orderBy('form_data.created_at', 'DESC')
            ->findAll();

        return view('pages/admin/list_info', $data);
    }

    public function detail($id)
    {
        // Ambil data form + join rs_list
        $info = $this->formModel
            ->select('form_data.*, rs_list.nama_rs, rs_list.jalan AS jalan_rs')
            ->join('rs_list', 'form_data.rs_id = rs_list.ID', 'left')
            ->where('form_data.id', $id)
            ->first();

        if (! $info) {
            return redirect()->to('/list-info')->with('error', 'Data tidak ditemukan.');
        }

        return view('pages/admin/detail_info', ['info' => $info]);
    }



    public function verify($id)
    {
        $this->formModel->update($id, [
            'status'      => 'Disetujui',
            'verified_by' => session()->get('user_id'),
            'approved_at' => date('Y-m-d H:i:s')
        ]);

        // Panggil processGeneratePdf() untuk menghasilkan file dan menyimpannya (tanpa return download response)
        $this->processGeneratePdf($id);

        // Redirect ke halaman detail dengan flash message
        return redirect()->to('/admin/detail/' . $id)
            ->with('message', 'Permintaan surat sudah diverifikasi. PDF sedang diunduh.');
    }



    private function processGeneratePdf($id)
    {
        $info = $this->formModel->find($id);
        if (!$info) {
            return false;
        }

        // Ambil detail RS
        $rs = $this->rsModel->find($info['rs_id']);
        $info['nama_rs']   = $rs['nama_rs'];
        $info['jalan_rs']  = $rs['jalan'];

        // 1) Siapkan Base64 untuk logo
        $path      = FCPATH . 'assets/img/logo_ptba2.png';
        $imageData = file_get_contents($path);
        $finfo     = new \finfo(FILEINFO_MIME_TYPE);
        $mime      = $finfo->buffer($imageData);
        $base64    = base64_encode($imageData);
        $dataUri   = 'data:' . $mime . ';base64,' . $base64;

        // 2) Siapkan array data untuk view
        $viewData = [
            'info'        => $info,
            'logoDataUri' => $dataUri,
        ];

        // 3) Load HTML dengan data yang lengkap
        $html = view('pages/admin/template_surat', $viewData);

        // 4) Render PDF
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // 5) Simpan file
        $filePath = WRITEPATH . 'uploads/surat_' . $id . '.pdf';
        file_put_contents($filePath, $dompdf->output());

        return $filePath;
    }



    public function generatePdf($id)
    {
        $info = $this->formModel->find($id);
        if (!$info) {
            return redirect()->to('/list-info')->with('error', 'Data tidak ditemukan.');
        }

        // Siapkan Base64 sama seperti di processGeneratePdf
        $path      = FCPATH . 'assets/img/Logo PTBA 750x140px.png';
        $imageData = file_get_contents($path);
        $finfo     = new \finfo(FILEINFO_MIME_TYPE);
        $mime      = $finfo->buffer($imageData);
        $base64    = base64_encode($imageData);
        $dataUri   = 'data:' . $mime . ';base64,' . $base64;

        $viewData = [
            'info'        => $info,
            'logoDataUri' => $dataUri,
        ];

        // Render HTML dengan data lengkap
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml(view('pages/admin/template_surat', $viewData));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Simpan & kirim download
        $filePath = WRITEPATH . 'uploads/surat_' . $id . '.pdf';
        file_put_contents($filePath, $dompdf->output());
        return $this->response->download($filePath, null);
    }



    private function sendEmail($recipient, $filePath)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com';
            $mail->Password = 'your_email_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your_email@example.com', 'Admin');
            $mail->addAddress($recipient);
            $mail->Subject = 'Surat Perobatan Anda';
            $mail->Body = 'Berikut adalah surat perobatan yang telah diverifikasi.';
            $mail->addAttachment($filePath);

            $mail->send();
        } catch (Exception $e) {
            log_message('error', 'Email gagal dikirim: ' . $mail->ErrorInfo);
        }
    }

    public function hapus($id)
    {
        // Cari data berdasarkan ID
        $info = $this->formModel->find($id);
        if (!$info) {
            return redirect()->to('/list-info')->with('error', 'Data tidak ditemukan.');
        }

        // Hapus data
        $this->formModel->delete($id);
        return redirect()->to('/list-info')->with('message', 'Data berhasil dihapus.');
    }

    public function hapusOtomatis()
    {
        // Hitung tanggal satu minggu yang lalu
        $oneWeekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));

        // Hapus data dengan status Disetujui dan approved_at lebih lama dari satu minggu
        $this->formModel->where('status', 'Disetujui')
            ->where('approved_at <', $oneWeekAgo)
            ->delete();

        // Untuk testing, kita bisa mengembalikan output
        echo "Penghapusan otomatis selesai.";
    }
}
