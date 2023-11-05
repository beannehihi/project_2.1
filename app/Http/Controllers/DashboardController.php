<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $majorsCount = Major::count();
        $schoolYearCount = SchoolYear::count();

        $schoolYears = SchoolYear::with('fees.tuition_fee')->get();

        $debtRates = $schoolYears->map(function ($schoolYear) {
            $totalStudents = $schoolYear->fees->flatMap(function ($fee) {
                return $fee->tuition_fee->pluck('student_id');
            })->unique()->count();

            $studentsInDebt = $schoolYear->fees->flatMap(function ($fee) {
                return $fee->tuition_fee->filter(function ($tuitionFee) use ($fee) {
                    return $tuitionFee->times < $fee->month;
                })->pluck('student_id');
            })->unique()->count();

            $debtRate = $totalStudents > 0 ? ($studentsInDebt / $totalStudents) * 100 : 0;

            return [
                'schoolYear' => $schoolYear->name,
                'debtRate' => $debtRate,
            ];
        });

        $chartData = [
            'labels' => $debtRates->pluck('schoolYear')->toArray(),
            'datasets' => [
                [
                    'label' => 'Tỉ lệ nợ học phí (%)',
                    'data' => $debtRates->pluck('debtRate')->toArray(),
                    'backgroundColor' => array_fill(0, $debtRates->count(), 'rgba(255, 99, 132, 0.2)'),
                    'borderColor' => array_fill(0, $debtRates->count(), 'rgba(255, 99, 132, 1)'),
                    'borderWidth' => 1,
                ]
            ]
        ];

        return view('dashboard.index', compact('studentsCount', 'majorsCount', 'schoolYearCount', 'chartData'));
    }
}
