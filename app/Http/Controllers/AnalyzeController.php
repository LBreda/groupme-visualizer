<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Guid;
use Illuminate\Support\Facades\Storage;
use Zipper;

class AnalyzeController extends Controller
{
    public function analyze(Request $request){
        $file = $request->file('file');
        $guid = Guid::create();
        $tmpPath = Config::get('filesystems.disks.temp.root') . '/' . $guid;
        mkdir($tmpPath);
        Zipper::make($file->path())->extractTo($tmpPath);

        //Enters the first directory
        $subdir = Storage::disk('temp')->directories($guid)[0];
        $subdirPath = Config::get('filesystems.disks.temp.root') . '/' . $subdir;

        $loglines = json_decode(file_get_contents($subdirPath . '/message.json'));

        $outPath = Config::get('filesystems.disks.temp.root') . "/{$guid}-out.txt";
        $fp = fopen($outPath, 'w');
        foreach ($loglines as $logline) {
            fwrite($fp, date('Y-m-d H:i:s', $logline->created_at) . " <{$logline->name}> {$logline->text}\r\n");
        }
        fclose($fp);
        Storage::disk('temp')->deleteDirectory($guid);

        return response()->download($outPath, 'log.txt')->deleteFileAfterSend(true);
    }
}
