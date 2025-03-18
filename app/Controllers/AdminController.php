<?php

namespace App\Controllers;

use App\Models\FormModel;
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends BaseController
{
    protected $formModel;

    public function __construct()
    {
        $this->formModel = new FormModel(); // Inisialisasi model di constructor
    }
    public function index()
    {
        $data['list_info'] = $this->formModel->findAll();
        return view('pages/admin/list_info', $data);
    }

    public function verify($id)
    {
        $this->formModel->update($id, [
            'status' => 'Disetujui',
            'verified_by' => session()->get('id')
        ]);

        return redirect()->to('/list_info')->with('message', 'Data berhasil diverifikasi.');
    }

    public function generatePdf($id)
    {
        $info = $this->formModel->find($id);
        $dompdf = new Dompdf();
        $html = view('admin/template_surat', ['info' => $info]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();

        $filePath = WRITEPATH . 'uploads/surat_' . $id . '.pdf';
        file_put_contents($filePath, $output);

        // Kirim email ke pengguna
        $this->sendEmail($info['email'], $filePath);

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
}
