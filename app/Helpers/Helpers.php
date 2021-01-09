<?php
if (! function_exists('tgl')) {
    function tgl($tanggal) {
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
}

if (! function_exists('neraca')) {
    function neraca($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $item, $saldo = 0, $penyesuaian = 0) {
        switch ($kriteria) {
            case 'periode':
                switch ($periode) {
                    case '1-bulan-terakhir':
                        foreach ($item->jurnal_umum as $jurnal_umum) {
                            if (date('Y-m',strtotime($jurnal_umum->tanggal)) == date('Y-m')) {
                                $saldo = saldo($jurnal_umum, $saldo);
                            }
                        }

                        foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                            if (date('Y-m',strtotime($jurnal_penyesuaian->tanggal)) == date('Y-m')) {
                                $penyesuaian += $jurnal_penyesuaian->nilai;
                            }
                        }

                        break;

                    case '1-minggu-terakhir':
                        foreach ($item->jurnal_umum->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')]) as $jurnal_umum) {
                            $saldo = saldo($jurnal_umum, $saldo);
                        }

                        foreach ($item->jurnal_penyesuaian->whereBetween('tanggal', [date('Y-m-d', strtotime('-7 day')), date('Y-m-d')]) as $jurnal_penyesuaian) {
                            $penyesuaian += $jurnal_penyesuaian->nilai;
                        }

                        break;
                }
                break;

            case 'rentang-waktu':
                foreach ($item->jurnal_umum->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]) as $jurnal_umum) {
                    $saldo = saldo($jurnal_umum, $saldo);
                }

                foreach ($item->jurnal_penyesuaian->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]) as $jurnal_penyesuaian) {
                    $penyesuaian += $jurnal_penyesuaian->nilai;
                }

                break;

            case 'bulan':
                foreach ($item->jurnal_umum as $jurnal_umum) {
                    if (date('Y-m',strtotime($jurnal_umum->tanggal)) == date('Y-m', strtotime($bulan))) {
                        $saldo = saldo($jurnal_umum, $saldo);
                    }
                }

                foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                    if (date('Y-m',strtotime($jurnal_penyesuaian->tanggal)) == date('Y-m', strtotime($bulan))) {
                        $penyesuaian += $jurnal_penyesuaian->nilai;
                    }
                }

                break;

            default:
                foreach ($item->jurnal_umum as $jurnal_umum) {
                    $saldo = saldo($jurnal_umum, $saldo);
                }

                foreach ($item->jurnal_penyesuaian as $jurnal_penyesuaian) {
                    $penyesuaian += $jurnal_penyesuaian->nilai;
                }

                break;
        }

        if ($item->post_saldo == $item->post_penyesuaian) {
            $disesuaikan = $saldo + $penyesuaian;
        } else {
            $disesuaikan = $saldo - $penyesuaian;
        }

        return [
            'saldo'         => $saldo,
            'penyesuaian'   => $penyesuaian,
            'disesuaikan'   => $disesuaikan
        ];
    }
}

if (! function_exists('neraca_akun')) {
    function neraca_akun($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $akun) {
        $saldo= 0; $penyesuaian = 0; $disesuaikan = 0; $data = null;
        foreach($akun as $item) {
            $data = neraca($kriteria, $periode, $tanggal_awal, $tanggal_akhir, $bulan, $item, $saldo, $penyesuaian);
            $saldo = $data['saldo'];
            $penyesuaian = $data['penyesuaian'];
        }
        if ($data) {
            $disesuaikan = $data['disesuaikan'];
        }
        return $disesuaikan;
    }
}

if (! function_exists('saldo')) {
    function saldo($jurnal_umum, $saldo = 0) {
        if ($jurnal_umum->debit_atau_kredit == $jurnal_umum->akun->post_saldo) {
            $saldo += $jurnal_umum->nilai;
        } else {
            $saldo -= $jurnal_umum->nilai;
        }
        return $saldo;
    }
}
