<?php

namespace App\Datatables;

use Illuminate\Http\Request;

interface DatatableInterface
{
    public static function columns();

    public function datatables(Request $request);

    public function query(Request $request);
}
