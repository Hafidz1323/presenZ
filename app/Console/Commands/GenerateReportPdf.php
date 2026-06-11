<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateReportPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:generate-pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a formatted academic PDF report for UAS presenZ project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Memulai pembuatan PDF laporan UAS...");

        // Load images and encode to base64 to avoid path resolution errors in Dompdf
        $images = [];
        $imagePaths = [
            'logo_unesa' => public_path('images/logo-unesa.png'),
            'img_dashboard' => public_path('images/media__1780839581888.png'),
            'img_coordinates' => public_path('images/media__1780838201288.png'),
            'img_address' => public_path('images/media__1780838401530.png'),
            'img_clock' => public_path('images/media__1780839059718.png'),
            'img_toast' => public_path('images/media__1780837529518.png'),
        ];

        foreach ($imagePaths as $key => $path) {
            if (file_exists($path)) {
                $images[$key] = base64_encode(file_get_contents($path));
                $this->line("- Mengodekan gambar: {$key} (" . basename($path) . ")");
            } else {
                $this->warn("- Gambar tidak ditemukan: " . basename($path));
            }
        }

        try {
            $this->info("Merender template Blade ke PDF...");
            
            // Generate PDF from the report-uas blade view
            $pdf = Pdf::loadView('report-uas', ['images' => $images]);
            
            // Set paper size A4 and portrait
            $pdf->setPaper('a4', 'portrait');

            // Save PDF file in the project root
            $outputFile = base_path('Laporan_UAS_presenZ.pdf');
            $pdf->save($outputFile);

            $this->info("Sukses! File PDF laporan berhasil digenerate di:");
            $this->comment($outputFile);
            $this->info("Ukuran file: " . round(filesize($outputFile) / 1024, 2) . " KB");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Gagal melakukan render PDF: " . $e->getMessage());
            $this->line($e->getTraceAsString());
            return Command::FAILURE;
        }
    }
}
