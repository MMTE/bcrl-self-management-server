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

@foreach($record->data as $key=>$value)
    <div class="mt-5">
        <h2 class="font-bold text-xl mb-5">{{$key === 'feedbacks' ? 'عملکرد هفته' : ''}}</h2>
        @if($key==='feedbacks')
            @foreach($value as $question)
                <div class="mb-6">
                    <div class="mb-2">
                        <h3 class="font-bold">سؤال:</h3>
                        <p class="text-md">{{$question['question']['question']}}</p>
                    </div>
                    <div class="flex flex-col mb-4">
                        <h3 class="">پاسخ کاربر:</h3>
                        <div class="flex flex-col">
                            @foreach($question['question']['options'] as $key=>$option)
                                <div
                                    class="border-2 rounded border-amber-500 mt-2 {{$question['answer_id'] === $option['id'] ?  'bg-amber-50' : '' }}">
                                    <p class="p-1 {{$question['answer_id'] === $option['id'] ?  'dark:text-black' : '' }}">{{$option['value']}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <hr class="mb-2">
            <div class="mb-6">
                <h2 class="font-bold text-xl mb-2">{{$key === 'goal' ? 'اهداف برای هفته آینده:' : ''}}</h2>
                <h2 class="font-bold text-xl mb-2">{{$key === 'events' ? 'تصویر سازی' : ''}}</h2>
                <p>{{$value}}</p>
            </div>
        @endif
    </div>
@endforeach























