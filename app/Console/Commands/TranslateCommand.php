<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use File;
use Illuminate\Console\Command;

class TranslateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trans-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate files existing in lang folder into [ar] lang';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $enWords = json_decode(file_get_contents(base_path("lang/ar.json")), true);
        $arWords = [];
        foreach ($enWords as $key => $value) {
            if ($value == "") {
                $arWords[$key] = Helper::translate("ar", $key);
            } else {
                $arWords[$key] = $value;
            }
        }
        File::put(base_path("lang/ar.json"), json_encode($arWords, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
