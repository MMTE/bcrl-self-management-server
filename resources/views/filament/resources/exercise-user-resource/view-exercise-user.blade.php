<h1 class="text-2xl">مشاهده تمرین <span class="font-bold">{{$record->user->name}}</span></h1>
<hr class="mt-2">
<div class="mt-5">
    <div class="mt-5 mb-2">
        <div class="flex">
            <h2 class="font-bold ml-2">نام تمرین</h2>
            <span>{{$record->exercise->name}}</span>
        </div>
    </div>
    <div class="flex">
        <h2 class="font-bold ml-2">تاریخ ثبت:</h2>
        <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at,new \DateTimeZone('Asia/Tehran'))->format('l d F Y - H:i:s'))}}</span>
    </div>
    @if($record->created_at != $record->updated_at)
        <div class="flex mt-4">
            <h2 class="font-bold ml-2">تاریخ به روزرسانی:</h2>
            <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->updated_at,new \DateTimeZone('Asia/Tehran'))->format('l d F Y - H:i:s'))}}</span>
        </div>
    @endif
</div>
<hr class="mt-5">


