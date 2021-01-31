<div class="w-full h-full grid grid-cols-2 sm:grid-cols-3 grid-rows-3 p-3 gap-2 overflow-auto ">
    @if($notes!==null)
      @foreach($notes as $note)
        <div class="flex border-gray-600 border-2 flex-col shadow-md text-dark-black z-30">
            <div class="w-full h-4" style="background-color:{{$note->color}};"></div>
            <div class="w-full h-full p-3 flex flex-col">
            <div class="flex items-center justify-between border-none border-b-2"><p class="text-2xl font-bold blend-multiply">{{$note->title}}</p><button class="focus:outline-none" wire:click="viewNote({{$note->id}})"><i class="fas fa-ellipsis-v"></i></button></div>
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
