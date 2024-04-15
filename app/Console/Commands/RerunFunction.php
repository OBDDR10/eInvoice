<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Group;
use App\Models\GroupTransaction;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RerunFunction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rerun-function';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("start");
        DB::beginTransaction();
        try {
            GroupTransaction::cursor()->where("type", "<>", GroupTransaction::type_profit)->whereNotNull("match_date")->each(function ($group_transaction) {
                $match_date = Carbon::parse($group_transaction->match_date);
                $time = null;
                $walletTransaction = WalletTransaction::where("group_transaction_id", $group_transaction->id)->whereDate("created_at", $match_date->toDateString())->orderBy("created_at", "desc")->withTrashed()->first();
                if(!empty($walletTransaction)) $time = $walletTransaction->created_at;
                if(empty($walletTransaction)){
                    $walletTransaction = WalletTransaction::where("group_transaction_id", $group_transaction->id)->whereDate("updated_at", $match_date->toDateString())->orderBy("updated_at", "desc")->withTrashed()->first();
                    if(!empty($walletTransaction)) $time = $walletTransaction->updated_at;
                }
                if(empty($walletTransaction)) return;
    
                $group_transaction->match_date = $time;
                $group_transaction->save();
            });
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            $this->error($th->getFile());
            $this->error($th->getLine());
            $this->error($th->getMessage());
        }
        $this->info("end");
    }
}
