<?php

namespace App\Console\Commands;

use App\Certification;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\VendorsController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Request;

class CallRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:call {uri}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'php artisan route call /route';

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
        // $c = new VendorsController();
        // $c->import();
        $cert = new CertificationController();
        $cert->importCertificates();
    }
}
