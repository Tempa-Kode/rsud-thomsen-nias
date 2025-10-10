<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $layanan = [
            [
                'background_image' => 'landing/images/dept_1.jpg',
                'layanan' => 'Pelayanan Medik Umum'
            ],
            [
                'background_image' => 'landing/images/dept_2.jpg',
                'layanan' => 'Pelayanan Medik Khusus'
            ],
            [
                'background_image' => 'landing/images/dept_3.jpg',
                'layanan' => 'Pelayanan Medik Gigi Mulut'
            ],
        ];
        return view('landing.index', compact('layanan'));
    }

    public function profil()
    {
        return view('landing.profil');
    }

    public function layanan()
    {
        $pelayanan = [
            'Pelayanan medik dasar / umum', 'Pelayanan medik gigi mulut',
            'Pelayanan KIA/KB', 'Pelayanan Gawat Darurat Umum 24 jam & 7 hari seminggu',
            'Bedah', 'Obstetri dan ginekologi', 'Rehabilitasi Medik',
            'Kedokteran Jiwa / Psikiatri/ Psikogeriatri/ NAPZA', 'Pelayanan kesehatan jiwa dewasa',
            'Pelayanan kesehatan jiwa lansia', 'Pelayanan psikologi dan psikometri',
            'Pelayanan kesehatan jiwa masyarakat', 'Pelayanan konseling dan psikoterapi',
            'Pelayanan farmasi', 'Rekam medis dan informasi kesehatan',
            'Sistem informasi dan komunikasi / SIRS / IT', 'Asuhan keperawatan generalis',
            'Asuhan kebidanan', 'Laundry', 'Emergensi'
        ];
        return view('landing.layanan', compact('pelayanan'));
    }
}
