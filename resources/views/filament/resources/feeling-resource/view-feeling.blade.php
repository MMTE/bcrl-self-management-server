<h1 class="text-2xl">مشاهده خلق و خو <span class="font-bold">{{$record->user->name}}</span></h1>

<hr class="mt-10">

@foreach($record->user->feelings as $feeling)
    <div class="mt-5">
        <h2 class="font-bold text-xl mb-5">
            <span>{{\App\Helpers\Utility::convertEnglishNumbersToPersian(\Morilog\Jalali\Jalalian::forge($record->created_at)->format('l d F Y - H:i:s'))}}</span>
        </h2>
        <div class="flex flex-col mb-4">
            <div class="flex flex-row content-center">
                <h3 class="font-bold">وضعیت:</h3>
                <div class="mr-2">
                    <p class="">{{\App\Models\Feeling::STATUS_TRANSLATIONS[$feeling->feeling]}}</p>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endforeach





