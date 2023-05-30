<h1 class="text-2xl">مشاهده نظر <span class="font-bold">{{$record->user->name}}</span></h1>
<hr class="mt-2">
<div class="mt-5">
    <div class="flex">
        <h2 class="font-bold ml-2">تاریخ ثبت:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))}}</span>
    </div>
    @if($record->created_at != $record->updated_at)
        <div class="flex mt-4">
            <h2 class="font-bold ml-2">تاریخ به روزرسانی:</h2>
            <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->updated_at)->format('l d F Y - H:i:s'))}}</span>
        </div>
    @endif
</div>

<hr class="mt-5">

@foreach($record->data as $key=>$value)
        <div class="mt-10 mb-6">
            <div class="flex mb-2">
                <h3 class="font-semibold ">سؤال {{\App\Helpers\Utility::convertEnglishNumbersToPersian($key + 1)}}:</h3>
                <p class="text-md font-bold mr-2">{{$value['question']}}</p>
            </div>
            <div class="flex flex-col mb-4">
                <h3 class="">پاسخ کاربر:</h3>
                <div class="flex flex-col">
                    @foreach($value['options'] as $key=>$option)
                        <div
                            class="border-2 rounded border-amber-500 mt-2 {{$value['selected_answer'] === $option['id'] ?  'bg-amber-50' : '' }}">
                            <p class="p-1 {{$value['selected_answer'] === $option['id'] ?  'dark:text-black' : '' }}">{{$option['value']}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endforeach


