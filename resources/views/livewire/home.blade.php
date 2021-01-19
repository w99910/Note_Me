<div class="w-full h-full grid grid-cols-2 sm:grid-cols-4 grid-rows-3 p-3 gap-3 overflow-auto ">
    @if($notes!==null)
      @foreach($notes as $note)
        <div class="flex border-none rounded-xl flex-col shadow-md text-dark-black p-3" style="background-color:{{$note->color}};">
            <div class="flex items-center justify-between border-none border-b-2"><p class="text-2xl font-bold blend-multiply">{{$note->title}}</p><button class="focus:outline-none" wire:click="viewNote({{$note->id}})"><i class="fas fa-expand-arrows-alt blend-multiply"></i></button></div>
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
        @endforeach
    @else
    <p class="self-center text-2xl">There's no notes.Let's create one.</p>
    @endif
</div>
