<div class="note_container w-full h-full dark:bg-gray-800 flex flex-col overflow-auto">
    <div class="w-full h-12 flex justify-around p-2">
    <div class="w-5/12 rounded-full flex items-center dark:bg-gray-700 border-2 py-1 px-2 border-gray-600 dark:border-transparent">
        <input wire:model="search" placeholder="Search by title" class=" w-full bg-transparent rounded-full px-3 py-2 focus:outline-none focus:ring-0 ring-0"/>
        <i class="fas fa-search"></i>
    </div>
        <button wire:click="sort" class="focus:outline-none dark:text-gray-200 flex items-center justify-evenly p-2 w-3/12 border-2 border-gray-600 dark:border-gray-200 dark:bg-gray-600">
            Sort By Date
            @if(!$sortyAsc)
            <i class="fas fa-sort-amount-down "></i>
            @else
                <i class="fas fa-sort-amount-up "></i>
            @endif
        </button>
    </div>
    <div @if($notes->count()>9) class="grid grid-cols-2 sm:grid-cols-3 grid-rows-none p-3 gap-2 min-h-full w-full " @else class="grid grid-cols-2 sm:grid-cols-3 grid-rows-3 p-3 gap-2 min-h-full w-full "  @endif>
    @if($notes!==null)
      @foreach($notes as $note)
        <div class="flex border-gray-600 dark:border-gray-200 border-2 flex-col shadow-md text-dark-black dark:text-gray-200 z-30">
            <div class="w-full h-4" style="background-color:{{$note->color}};"></div>
            <div class="w-full h-full p-3 flex flex-col">
            <div class="flex items-center justify-between border-none border-b-2"><p class="text-2xl font-bold blend-multiply">{{$note->title}}</p><button @if($loop->first) class="first_note focus:outline-none" @else class="focus:outline-none"   @endif wire:click="viewNote({{$note->id}})"><i class="fas fa-ellipsis-v"></i></button></div>
            <div class="flex px-1 py-2 h-full overflow-hidden">
               <p class="blend-multiply"> @foreach((array)$note->content as $content)
                    @php $decode=json_decode($content);

                    foreach (array_slice($decode,0,1) as $inside)  {
                        switch ($inside->type)
                          {
                              case 'paragraph': case 'header': case'quote':echo $inside->data->text,'<br>';break;
                              case 'list':foreach ($inside->data->items as $item){echo $item,'<br>';};break;
                               }
                    }
                    @endphp
                @endforeach
               </p>
            </div>
            <span class="blend-multiply">{{$note->created_at->toDateString()}}</span>
            </div>
            </div>
        @endforeach
    @else
    <p class="self-center text-2xl">There's no notes.Let's create one.</p>
    @endif
    </div>
    </div>
