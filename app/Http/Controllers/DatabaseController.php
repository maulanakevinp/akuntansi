<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql as spatie;

class DatabaseController extends Controller
{
    public function backup()
    {
        $file_name = 'database_backup_on_' . date('y-m-d-H_i_s') . '.sql';

        spatie::create()
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->includeTables([
                'akun',
                'jurnal_umum',
                'jurnal_penyesuaian',
            ])
            ->dumpToFile($file_name);

        $this->download($file_name);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'sql'  => ['required','file']
        ]);

        $conn = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));

        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($request->sql);
        // Loop through each line
        foreach ($lines as $key => $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                $conn->query($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }

        mysqli_close($conn);

        return back()->with('success', 'File sql berhasil di restore');
    }

    private function download($fileName)
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        ob_clean();
        flush();
        readfile($fileName);
        unlink($fileName);
    }
}
