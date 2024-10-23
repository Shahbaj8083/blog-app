<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HelperTestController extends BaseController
{
    public function __construct()
    {
        helper('date');
    }
    public function helperTest()
    {
       print_r(now()); 
    }
}
