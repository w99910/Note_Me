<div class="w-full h-full flex items-start justify-around px-4 py-4">
    @if($notes!==null)
      @foreach($notes as $note)
        <div class="w-3/12 h-2/6 flex border-none rounded-2xl flex-col bg-soft-yellow">
            <div class="flex items-center justify-between px-2 py-1 border-none border-b-2"><p class="text-2xl font-bold">{{$note->title}}</p><span>{{$note->created_at}}</span></div>
            <div class="flex px-4 py-3 h-full overflow-hidden">

                @foreach((array)$note->content as $content)
                @php $decode=json_decode($content);
                      foreach ($decode as $inside)  {

                          foreach($inside->data as $data)
                    {

                    if(is_array($data))
                    {
                    foreach ($data as $datum) {
                                echo $datum,'<br>';
                    }
                }
                else{
                    echo $data,'<br>';
                }


           }
           }
@endphp
                @endforeach
            </div>
        </div>
        @endforeach
    @else
    <p class="self-center text-2xl">There's no notes.Let's create one.</p>
    @endif
</div>
