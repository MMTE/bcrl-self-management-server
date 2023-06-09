<h1 class="text-2xl">مشاهده عملکرد هفته <span class="font-bold">{{$record->user->name}}</span></h1>
<hr>
<div class="mt-5">
    <div class="flex">
        <h2 class="font-bold ml-2">تاریخ ثبت:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))}}</span>
    </div>

    <div class="flex mt-4">
        <h2 class="font-bold ml-2">تاریخ به روزرسانی:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->updated_at)->format('l d F Y - H:i:s'))}}</span>
    </div>
</div>

<div class="mt-5">
    <div class="flex">
        <h2 class="font-bold ml-2">شروع هفته:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at)->getFirstDayOfWeek()->format('l d F Y'))}}</span>
    </div>

    <div class="flex mt-4">
        <h2 class="font-bold ml-2">پایان هفته:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at)->getFirstDayOfWeek()->addDays(6)->format('l d F Y'))}}</span>
    </div>
</div>


<hr class="mt-10">

@foreach($record->result as $key=>$value)
    <div class="mt-5">
        <h2 class="font-bold text-xl mb-5"></h2>
        <div class="mb-6">
            <div class="mb-2">
                <h3 class="font-bold"> سؤال{{$key + 1}}:</h3>
                <p class="text-md">{{\App\Models\Question::find($value['question_id'])->title}}</p>
            </div>

            <div class="flex flex-col mb-4">
                <h3 class="">پاسخ کاربر:</h3>
                <div class="flex flex-col">
                    @foreach(\App\Models\Question::find($value['question_id'])->options as $key=>$option)
                        <div
                            class="border-2 rounded border-amber-500 mt-2 {{  $option['is_correct_answer'] == true ? 'bg-green-400 dark:text-black' : ($value['option']['option'] == $option['option']  ?  'bg-amber-50 dark:text-black' :'') }}">
                            <p class="p-1">{{$option['option']}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>























