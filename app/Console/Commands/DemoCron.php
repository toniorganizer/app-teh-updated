<?php

namespace App\Console\Commands;

use Log;
use App\Models\PencariKerja;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Sample
        \Log::info("Cron job Berhasil di jalankan " . date('Y-m-d H:i:s'));

        // Kita bisa menyimpan logic disini
        // Contoh: Update data di database yang statusnya belum diproses selama 24 jam menjadi FAILED
        // $expired = Carbon::now()->subHour(24);
        // $transaction = Transaction::where('transaction_status', '=', 'PENDING')->where('created_at', '<=', $expired)->first();
        PencariKerja::where('email_pk', Auth::user()->email)->where('tgl_expired', '<=', now())->update([
            'status_ak1' => 'Bekerja',
        ]);
        // $transaction->transaction_status = 'FAILED';
        // $transaction->save();
    }
}