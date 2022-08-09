<div>
    <!-- 
  <options=bold>“ Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. ”</>
  <fg=gray>— Immanuel Kant</>
 -->
      @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            @foreach ($posts as $post )
                <div>
                    <a href="{{ route('posts.show',['post'=>$post,'user'=>$post->user]) }}">
                        <img src="{{ asset('uploads') . "/" . $post->imagen }}" alt="Imagen del Post {{ $post->titulo}}" >
                    </a>
                </div>
            @endforeach
        </div>      
        <div>
            {{ $posts->links('pagination::tailwind')}}
        </div>
      @else
        <p class="text-center">No hay Posts</p>
      @endif
</div>