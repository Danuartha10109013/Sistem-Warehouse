<?php

use App\Http\Middleware\Adminmiddleware;
use App\Http\Middleware\CheckCoilD;
use App\Http\Middleware\CheckL08;
use App\Http\Middleware\CheckList;
use App\Http\Middleware\CheckSupp;
use App\Http\Middleware\CheckType;
use App\Http\Middleware\CheckTypeADM;
use App\Http\Middleware\CheckTypeFC;
use App\Http\Middleware\CheckTypeK;
use App\Http\Middleware\CheckTypeMM;
use App\Http\Middleware\CheckTypeOP;
use App\Http\Middleware\CheckTypeSKE;
use App\Http\Middleware\CheckTypeLP;
use App\Http\Middleware\CheckTypeID;
use App\Http\Middleware\CheckTypeSW;
use App\Http\Middleware\CheckTypeLR;
use App\Http\Middleware\CheckTypeSJ;
use App\Http\Middleware\CheckTypeRP;
use App\Http\Middleware\CheckTypeMPR;
use App\Http\Middleware\CheckTypeST;
use App\Http\Middleware\CheckTypeMK;
use App\Http\Middleware\CheckTypeVT;
use App\Http\Middleware\PegawaiMiddleware;
use App\Http\Middleware\RunScheduler;
use App\Http\Middleware\ScanLayout;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

         $middleware->append(RunScheduler::class);
         
        // Group for Ship-Mark users
        $middleware->appendToGroup('Ship-Mark', [
            CheckType::class,
        ]);
        
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
        $middleware->appendToGroup('superadmin', [
            SuperAdmin::class,
        ]);
        $middleware->appendToGroup('Administrator', [
            CheckTypeADM::class,
        ]);
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
    
        //Form-Check
        $middleware->appendToGroup('Form-Check', [
            CheckTypeFC::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Mapping Muat 
        $middleware->appendToGroup('Mapping', [
            CheckTypeMM::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Open-Packing
        $middleware->appendToGroup('Open-Packing', [
            CheckTypeOP::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Supply
        $middleware->appendToGroup('Supply', [
            CheckSupp::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);

        //Packing-List
        $middleware->appendToGroup('Packing-List', [
            CheckList::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //Kendaran ck
        $middleware->appendToGroup('Kendaraan', [
            CheckTypeK::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //Scan Lyout
        $middleware->appendToGroup('Scan-Layout', [
            ScanLayout::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
        //Coil-Damage
        $middleware->appendToGroup('Coil-Damage', [
            CheckCoilD::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        //L-08
        $middleware->appendToGroup('L-08', [
            CheckL08::class,
        ]);
    
        $middleware->appendToGroup('admin', [
            AdminMiddleware::class,
        ]);
    
        $middleware->appendToGroup('pegawai', [
            PegawaiMiddleware::class,
        ]);
        
        // Scan Koil EUP
        $middleware->appendToGroup('Scan-Koil-EUP', [CheckTypeSKE::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Laporan Packing
        $middleware->appendToGroup('Laporan-Packing', [CheckTypeLP::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // IDOD
        $middleware->appendToGroup('IDOD', [CheckTypeID::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Sidewall
        $middleware->appendToGroup('Sidewall', [CheckTypeSW::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Laporan Repacking
        $middleware->appendToGroup('Laporan-Repacking', [CheckTypeLR::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Surat Jalan
        $middleware->appendToGroup('Surat-Jalan', [CheckTypeSJ::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Rekap PRD
        $middleware->appendToGroup('Rekap-PRD', [CheckTypeRP::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Master Product
        $middleware->appendToGroup('Master-Product', [CheckTypeMPR::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Kelola Stock
        $middleware->appendToGroup('Kelola-Stock', [CheckTypeST::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Modul Kapasitas
        $middleware->appendToGroup('Modul-Kapasitas', [CheckTypeMK::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        // Verifikasi Timbangan
        $middleware->appendToGroup('Verifikasi-Timbangan', [CheckTypeVT::class]);
        $middleware->appendToGroup('admin', [AdminMiddleware::class]);
        $middleware->appendToGroup('pegawai', [PegawaiMiddleware::class]);

        //Administrator
        
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();

    $app->singleton(
        Illuminate\Contracts\Debug\ExceptionHandler::class,
        App\Exceptions\Handler::class
    );
    