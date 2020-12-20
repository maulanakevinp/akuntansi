<table>
    <thead>
        <tr>
            <th>Kelompok Akun</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Post Saldo</th>
            <th>Post Penyesuaian</th>
            <th>Post Laporan</th>
            <th>Kelompok Laporan Posisi Keuangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($akun as $item)
            <tr>
                <td>{{ $item->kelompok_akun_id }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->post_saldo == 1 ? 'Debit' : 'Kredit' }}</td>
                <td>{{ $item->post_penyesuaian == 1 ? 'Debit' : 'Kredit' }}</td>
                <td>{{ $item->post_laporan == 1 ? 'Neraca' : 'Laba Rugi' }}</td>
                <td>{{ $item->kelompok_laporan_posisi_keuangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
