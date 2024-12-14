<h3 class="font-poppins font-bold text-lg tracking-widest">Guest Rooms</h3>
<p class="font-inter text-sm mt-2">Scattered amidst the lush jungle landscape,
    our Guest Rooms offer a perfect blend of luxury and tranquility,
    providing a peaceful retreat to unwind and relax.
</p>
<div class="grid grid-cols-2 mt-8 mx-auto">
    @foreach($uniqueRooms as $room)
    @if($room->room_type === 'guest') <!-- Filter for guest rooms -->
    <div class="border-1 border-gray-400 w-4/5 mx-auto mb-8">
        <!-- Carousel for room images -->
        <div id="carousel-{{ $room->id }}" class="relative w-full" data-carousel="static">
            <div class="relative h-60 overflow-hidden">
                @foreach([ 'room_image_1', 'room_image_2', 'room_image_3' ] as $index => $image_field)
                @php
                $image = $room->$image_field;
                @endphp
                @if($image)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset($image) }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Room image {{ $index + 1 }}">
                </div>
                @endif
                @endforeach
            </div>

            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                @foreach(range(0, min(2, count([ $room->room_image_1, $room->room_image_2, $room->room_image_3 ]) - 1)) as $i)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $i == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
                @endforeach
            </div>

            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        <div class="p-6 pb-2">
            <h2 class="text-base font-inter mb-4 tracking-widest font-normal">{{ $room->room_name }}</h2>
            <div class="mb-4">
                <p class="flex font-poppins text-xs font-light items-center mb-3">
                    <i class="fas fa-bed mr-2">
                    </i>
                    {{ $room->room_details }}
                </p>
                <p class="flex font-poppins text-xs font-light items-center mb-3">
                    <i class="fas fa-ruler-combined mr-2">
                    </i>
                    {{ $room->room_size }} sq. ft.
                </p>
                <p class="flex font-poppins text-xs font-light items-center mb-3">
                    <i class="fas fa-users mr-2">
                    </i>
                    Capacity: {{ $room->capacity }} people
                </p>
            </div>
        </div>
        <div class="flex justify-center space-x-4 mb-4">
            <button class="bg-jungle-green text-white py-1 w-2/5 rounded-m hover:bg-jungle-brown">
                BOOK NOW
            </button>
            <button class="border border-black text-black py-1 w-2/5 rounded-m">
                DETAILS
            </button>
        </div>
    </div>
    @endif
    @endforeach
</div>