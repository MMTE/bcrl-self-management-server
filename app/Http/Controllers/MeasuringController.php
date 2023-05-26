<?php

namespace App\Http\Controllers;

use App\Models\Measuring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class MeasuringController extends Controller
{
    public function index()
    {
        $jalali = Jalalian::now();
        $firstDayOfTheWeek = $jalali->getFirstDayOfWeek();
        $lastDayOfTheWeek = $jalali->addDay(7);

        $measuring = Measuring::where('user_id', Auth::id())->whereBetween('created_at', [$firstDayOfTheWeek->toCarbon()->startOfDay(), $lastDayOfTheWeek->toCarbon()->endOfDay()])->first();

        if (!$measuring) {
            $measuring = [
                'ARM_default' => [
                    'right' => '',
                    'left' => '',
                ],
                'ARM_10cm' => [
                    'right' => '',
                    'left' => '',
                ],
                'ARM_20cm' => [
                    'right' => '',
                    'left' => '',
                ],
                'ARM_30cm' => [
                    'right' => '',
                    'left' => '',
                ],
                'ARM_40cm' => [
                    'right' => '',
                    'left' => '',
                ],
            ];
        } else {
            $measuring = $measuring->measurements;
        }

        return $this->handleResponse($measuring, 'list of requested measurements.');
    }

    public function store(Request $request)
    {
        // parameters
        $slug = $request->get('slug');
        $measurements = $request->get('measurements');

        $jalali = Jalalian::now();
        $firstDayOfTheWeek = $jalali->getFirstDayOfWeek();
        $lastDayOfTheWeek = $jalali->addDay(7);

        $measuring = $this->getMeasuring($firstDayOfTheWeek, $lastDayOfTheWeek);

        $measuring->measurements = $measurements;
        $measuring->save();

        return $this->handleResponse(null, 'measurement stored successfully.');
    }

    protected function getMeasuring(Jalalian $firstDayOfTheWeek, Jalalian $lastDayOfTheWeek): Measuring
    {
        $measuring = Measuring::where('user_id', Auth::id())->whereBetween('created_at', [$firstDayOfTheWeek->toCarbon()->startOfDay(), $lastDayOfTheWeek->toCarbon()->endOfDay()])->first();

        if (!$measuring) {
            $measuring = new Measuring();
            $measuring->user_id = Auth::id();
        }
        return $measuring;
    }

}
