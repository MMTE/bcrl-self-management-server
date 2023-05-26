<h1 class="text-2xl">مشاهده اندازه‌گیری مچ <span class="font-bold">{{$record->user->name}}</span></h1>
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

@foreach($record->measurements as $key=>$value)
    <div class="mt-5">
        <h2 class="font-bold text-xl mb-5">{{$key === 'ARM_default' ? 'چین مچ دست' : ''}}</h2>
        <h2 class="font-bold text-xl mb-5">{{$key === 'ARM_10cm' ? '۱۰ سانتی متر بالاتر از چین مچ دست' : ''}}</h2>
        <h2 class="font-bold text-xl mb-5">{{$key === 'ARM_20cm' ? '۲۰ سانتی متر بالاتر از چین مچ دست' : ''}}</h2>
        <h2 class="font-bold text-xl mb-5">{{$key === 'ARM_30cm' ? '۳۰ سانتی متر بالاتر از چین مچ دست' : ''}}</h2>
        <h2 class="font-bold text-xl mb-5">{{$key === 'ARM_40cm' ? '۴۰ سانتی متر بالاتر از چین مچ دست' : ''}}</h2>
        <div class="flex flex-col mb-4">
            <div class="flex flex-row content-center">
                <h3 class="font-bold">دست راست:</h3>
                <div class="mr-2">
                    <p class="p-1">{{$value['right']}}</p>
                </div>
            </div>
            <div class="mt-2 flex flex-row content-center">
                <h3 class="font-bold">دست چپ:</h3>
                <div class="mr-2">
                    <p class="p-1">{{$value['left']}}</p>
                </div>
            </div>
            <div class="mt-2 flex flex-row content-center">
                <h3 class="font-bold">اختلاف</h3>
                <div class="mr-2">
                    <p class="p-1">{{abs($value['left'] - $value['right'])}}</p>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endforeach








