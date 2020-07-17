<?php

namespace App\Console\Commands;

use App\Models\Transaksi;
use App\Models\Transaksi_Detail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Jobs\sendOutdateTransaction;

class TransaksiCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transaksi Akan Dicek Setiap Jam';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Database logic
        $dateTime = date('Y-m-d H:i:s');
        $outdateTrx = Transaksi::with('user', 'transaksi_detail')->where('proses_pembayaran', 'belum')->get();
        foreach ($outdateTrx as $t) {
            if ($dateTime > $t->batas_transaksi) {
                DB::beginTransaction();
                try {
//                    $update = Transaksi::where('id_transaksi', $t->id_transaksi)->update(['status_transaksi' => 'batal', 'proses_pembayaran' => 'tolak']);
                    $update = Transaksi_Detail::where('transaksi_id', $t->id_transaksi)->update(['status_order' => 'Dibatalkan']);
                    $t->update(['proses_pembayaran' => 'tolak']);
                    $kirimEmail = dispatch(new sendOutdateTransaction($t));
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        }
    }
}
