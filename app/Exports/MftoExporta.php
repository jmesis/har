<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromGenerator;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class MftoExporta implements FromView
{
    protected $data;
    protected $ctdh;
    protected $ctdhouse;
    protected $totalpersonas;

    public function __construct($data,$ctd,$ctdhouse,$totalpersonas)
    {
        $this->data = $data;
        $this->ctdh = $ctd;
        $this->ctdhouse = $ctdhouse;
        $this->totalpersonas = $totalpersonas;
    }

    public function view():View{
        $data=$this->data;
        $ctdh=$this->ctdh;
        $ctdhouse=$this->ctdhouse;
        $totalpersonas=$this->totalpersonas;
        return view('exports.mfto_aereon', compact(['data','ctdh','ctdhouse','totalpersonas']));
    }
}
