<div class="min-h-screen bg-gray-100 flex flex-col justify-center">
    <div class="mx-auto md:w-full md:max-w-md">
        <div class="flex flex-col bg-white shadow w-full rounded-lg">
            <div class="p-10">
                @error('phone') <span class="text-red-400 error">{{ $message }}</span> @enderror


            @if($status=== null)
                    <label class="font-semibold text-sm text-gray-600 pb-1 block">موبایل</label>
                    <input wire:model="phone" type="tel"
                           class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                @elseif($status=== 'verify')
                    <label class="font-semibold text-sm text-gray-600 pb-1 block">کد تأیید پیامک شده</label>
                    <input wire:model="code" type="text"
                           class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                @endif
                <button
                    wire:loading.remove wire:target="submit"
                    wire:click="submit"
                    class="w-full  bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    {{$status === null ? 'ارسال کد تأیید' : 'بررسی کد تأیید'}}
                </button>
            </div>
        </div>
    </div>
</div>
