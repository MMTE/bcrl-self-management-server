<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $exams = Exam::where('status', 'active_for_all_users')->orWhere('status', 'active_for_specific_users')->get();

        foreach ($exams as $exam) {
            if ($exam->status === 'active_for_specific_users' && !in_array($id, $exam->activated_users)) {
                continue;
            }
            $exam->questions = \App\Models\Question::whereIn('id', $exam->questions)->get();
        }
        return $this->handleResponse($exams, 'list of exams with questions');
    }

    public function store(Request $request)
    {
        $exam = $request->get('exam');
        $answers = $request->get('answers');

        $exam_result = new ExamResult();
        $exam_result->user_id = Auth::id();
        $exam_result->exam_id = $exam['id'];
        $exam_result->result = $answers;
        $exam_result->save();

        return $this->handleResponse(null, 'exam result saved successfully.');


    }

}
