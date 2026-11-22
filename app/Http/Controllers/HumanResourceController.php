<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HumanResourceController extends Controller
{
    public function Payroll(Request $request)
    {
        $age = $request->age;
        $allowance = $request->allowance;

        return response()->json([
            'age' => $age,
            "allowance" => $allowance
        ]);
    }
    public function Calculate(Request $request)
    {
        $employmenttype = $request->input('employmenttype');
        $PositionTier = $request->input('PositionTier');
        $daysAbsent = (float) ($request->input('daysAbsent') ?? 0);
        $MinutesLate = (float) ($request->input('MinutesLate') ?? 0);
        $overtimeHours = (float) ($request->input('overtimeHours') ?? 0);

        if ($employmenttype == 'COS') {
            $Monthlysalary = 18000;
            $sss = 0;
            $philhealth = 0;
            $pagIbig = 0;
        } elseif ($employmenttype == 'Regular' && $PositionTier == 'Junior') {
            $Monthlysalary = 25000;
            $sss = 1125;
            $philhealth = 625;
            $pagIbig = 200;
        } elseif ($employmenttype == 'Regular' && $PositionTier == 'Senior') {
            $Monthlysalary = 40000;
            $sss = 1800;
            $philhealth = 1000;
            $pagIbig = 200;
        } else {
            return response()->json([
                'error' => 'invalid',
                'received' => $request->all(),
            ]);
        }

        $daysAbsent = max(0, $daysAbsent);
        $MinutesLate = max(0, $MinutesLate);
        $overtimeHours = max(0, $overtimeHours);

        $daysPresent = max(0, 22 - $daysAbsent);
        $dailyRate = round($Monthlysalary / 22, 2);
        $hourlyRate = $dailyRate / 8;
        $lateDeduction = round(($hourlyRate / 60) * $MinutesLate, 2);
        $absentDeduction = round($dailyRate * $daysAbsent, 2);
        $overtimePay = round($overtimeHours * ($hourlyRate * 1.25), 2);
        $grossPay = round($Monthlysalary - $lateDeduction - $absentDeduction + $overtimePay, 2);
        $totalDeductions = $sss + $philhealth + $pagIbig;
        $netPay = round($grossPay - $totalDeductions, 2);

        return response()->json([
            'daysAbsent' => $daysAbsent,
            'employmenttype' => $employmenttype,
            'PositionTier' => $PositionTier,
            'MonthlySalary' => $Monthlysalary,
            'daysPresent' => $daysPresent,
            'dailyRate' => $dailyRate,
            'lateDeduction' => $lateDeduction,
            'absentDeduction' => $absentDeduction,
            'overtimePay' => $overtimePay,
            'grossPay' => $grossPay,
            'sss' => $sss,
            'philhealth' => $philhealth,
            'pagIbig' => $pagIbig,
            'totalDeductions' => $totalDeductions,
            'netPay' => $netPay,
        ]);
    }
}