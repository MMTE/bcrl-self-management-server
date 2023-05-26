<?php

namespace App\Http\Controllers;

use App\Helpers\Utility;
use App\Models\ExerciseUser;
use App\Models\Feeling;
use App\Models\Measuring;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type');
        $duration = $request->get('duration');
        $selectedArm = $request->get('selectedArm');

        $data = [];

        $translation = [
            'ARM_default' => 'چین مچ',
            'ARM_10cm' => '۱۰ سانت',
            'ARM_20cm' => '۲۰ سانت',
            'ARM_30cm' => '۳۰ سانت',
            'ARM_40cm' => '۴۰ سانت',
        ];

        $revers_translation = [
            'مچ' => 'ARM_default',
            '۱۰ سانت' => 'ARM_10cm',
            '۲۰ سانت' => 'ARM_20cm',
            '۳۰ سانت' => 'ARM_30cm',
            '۴۰ سانت' => 'ARM_40cm',
        ];

        if ($type === 'exercise') {

            if ($duration == 'هفته') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'دو هفته') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subWeeks(2)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'ماهانه') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'دو ماه') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subMonths(2), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'سه ماه') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'چهار ماه') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->whereBetween('created_at', [Carbon::now()->subMonths(4), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            } else if ($duration == 'از ابتدا تا اکنون') {
                $user_exercises = ExerciseUser::with('exercise')
                    ->where('user_id', Auth::id())
                    ->get()
                    ->groupBy('exercise.name');
            }

            foreach ($user_exercises as $key => $user_exercise) {
                $data[$key] = $user_exercise->count();
            }

        } else if ($type === 'arm') {

            if ($duration == 'هفته') {
                $m = Measuring::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->first();
                if ($m) {
                    $measurements = $m->measurements;

                    foreach ($measurements as $key => $measurement) {
                        $data[$translation[$key]] = abs($measurement['right'] - $measurement['left']);
                    }
                }

            } else if ($duration == 'دو هفته') {

                $m = Measuring::whereBetween('created_at', [Carbon::now()->subWeeks(2)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            } else if ($duration == 'ماهانه') {
                $m = Measuring::whereBetween('created_at', [Carbon::now()->subMonth()->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            } else if ($duration == 'دو ماه') {
                $m = Measuring::whereBetween('created_at', [Carbon::now()->subMonths(2)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            } else if ($duration == 'سه ماه') {
                $m = Measuring::whereBetween('created_at', [Carbon::now()->subMonths(3)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            } else if ($duration == 'چهار ماه') {
                $m = Measuring::whereBetween('created_at', [Carbon::now()->subMonths(4)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            } else if ($duration == 'از ابتدا تا اکنون') {
                $m = Measuring::where('user_id', Auth::id())->get();
                foreach ($m as $item) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($item->updated_at)->format('d M'));
                    $data[$date] = abs($item->measurements[$revers_translation[$selectedArm]]['right'] - $item->measurements[$revers_translation[$selectedArm]]['left']);
                }
            }
        } else if ($type === 'mood') {
            if ($duration == 'هفته') {
                $moods = \App\Models\Feeling::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'دو هفته') {
                $moods = Feeling::whereBetween('created_at', [Carbon::now()->subWeeks(2)->startOfWeek(weekStartsAt: Carbon::SATURDAY), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'ماهانه') {
                $moods = Feeling::whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'دو ماه') {
                $moods = Feeling::whereBetween('created_at', [Carbon::now()->subMonths(2), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'سه ماه') {
                $moods = Feeling::whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'چهار ماه') {
                $moods = Feeling::whereBetween('created_at', [Carbon::now()->subMonths(4), Carbon::now()])
                    ->where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            } else if ($duration == 'از ابتدا تا اکنون') {
                $moods = Feeling::where('user_id', Auth::id())
                    ->get();
                foreach ($moods as $mood) {
                    $date = Utility::convertEnglishNumbersToPersian(Jalalian::forge($mood->created_at)->format('d M'));
                    $data[$date] = $mood->feeling;
                }
            }
        }


        return $this->handleResponse($data, 'report for chart');
    }


    public function store(Request $request)
    {
        $type = $request->get('type');

        $jalali = Jalalian::now();
        $firstDayOfTheWeek = $jalali->getFirstDayOfWeek();
        $lastDayOfTheWeek = $jalali->addDay(7);

        $report = Report::where('user_id', Auth::id())
            ->whereBetween('created_at', [$firstDayOfTheWeek->toCarbon()->startOfDay(), $lastDayOfTheWeek->toCarbon()->endOfDay()])
            ->first();

        if (!$report) {
            $report = new Report();
            $report->user_id = Auth::id();
        }

        $data = $report->data;

        if ($type === 'feedback') {
            $data['feedbacks'] = $request->get('feedbacks');
            $data['goal'] = $request->get('goal');
        } else {
            $data['events'] = $request->get('events');
        }

        $report->data = $data;
        $report->save();

        return $this->handleResponse(null, 'report saved successfully');
    }


    public function weekly()
    {

        $jalali = Jalalian::now();
        $firstDayOfTheWeek = $jalali->getFirstDayOfWeek();
        $lastDayOfTheWeek = $jalali->addDay(7);

        $report = Report::where('user_id', Auth::id())
            ->whereBetween('created_at', [$firstDayOfTheWeek->toCarbon()->startOfDay(), $lastDayOfTheWeek->toCarbon()->endOfDay()])
            ->first();

        return $this->handleResponse($report ? $report : [], '');
    }


}












