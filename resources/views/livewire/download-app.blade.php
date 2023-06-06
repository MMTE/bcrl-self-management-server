<div>
    @if($showDownloadBox)

        <div wire:loading wire:target="download">
            <p>لطفا صبر کنید تا دانلود انجام شود</p>
            <p>اگر دانلود انجام نشد به پشتیبان اطلاع دهید</p>
        </div>

        <div class="my-4">
            <label class="font-semibold text-sm text-gray-600 pb-1 block">شماره موبایل خود را وارد کنید:</label>
            @error('phone') <span class="text-red-400 error">{{ $message }}</span> @enderror
            <input wire:model="phone" type="tel"
                   class="border rounded-lg px-3 py-2 mt-1 mb-2 text-sm w-full"/>
            <button wire:click="download"
                    class="block w-30 rounded-md bg-blue-500 py-1 px-2 font-medium text-white shadow hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 focus:ring-offset-gray-900">
                دانلود اپلیکیشن
            </button>
        </div>
    @endif

    <button wire:click="show"
            class="block w-full rounded-md bg-pink-500 py-3 px-4 font-medium text-white shadow hover:bg-pink-400 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 focus:ring-offset-gray-900">
        دانلود نسخه اندروید اپلیکیشن
    </button>
</div>
