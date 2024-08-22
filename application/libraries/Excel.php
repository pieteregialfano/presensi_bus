<?php
require_once APPPATH . 'libraries/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Excel extends Spreadsheet
{
    public function __construct()
    {
        parent::__construct();
    }
}
