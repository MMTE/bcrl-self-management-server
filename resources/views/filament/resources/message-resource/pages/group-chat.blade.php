<x-filament::page>
    <div class="flex flex-col max-h-screen">
        <div
            class="flex-grow overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-1 scrolling-touch">
            <div class="flex flex-col">
                @foreach($messages as $message)
                    @if($current_user_id === $message->user_id)
                        <div class="flex justify-start mb-4">

                            <div
                                class="mr-2 py-3 px-4 bg-blue-400 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-white">
                                <p class="text-sm mb-2 text-black">{{\App\Models\User::find($current_user_id)->name}}
                                    :</p>
                                <p class="text-xl">{{$message->text}}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-end mb-4">
                            <div
                                class="ml-2 py-3 px-4 bg-gray-400 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white">
                                <p class="text-sm mb-2 text-black">{{\App\Models\User::find($current_user_id)->name}}
                                    :</p>
                                <p class="text-xl">{{$message->text}}</p>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
        <div class="h-96 relative">
            <div class="sticky bottom-0">
                <div class="px-5 flex flex-col justify-between">
                    <div class="">
                        <div class="mx-auto">
                            <form wire:submit.prevent="submit">
                                <label for="chat" class="sr-only">Your message</label>
                                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">

                                <textarea wire:model="input" type="text"
                                          id="chat" rows="1"
                                          class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                          placeholder="پیام شما..."></textarea>
                                    <button type="submit"
                                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                        <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-filament::page>
