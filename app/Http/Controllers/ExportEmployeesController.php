<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportEmployeesController extends Controller
{
  
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new EmployeesExport(), 'employees.xlsx');
    }
}
