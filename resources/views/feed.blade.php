@extends('layouts.main')
@section('style')
    <style>
        
    </style>
@endsection
@section('feed')
<li class="active">
@endsection
@section('container')
           <div class="container m-auto" id="containn">

                <h1 class="lg:text-2xl text-lg font-extrabold leading-none text-gray-900 tracking-tight mb-5"> Feed </h1>

                <div class="lg:flex justify-center lg:space-x-10 lg:space-y-0 space-y-5">

                    <!-- left sidebar-->
                    <div class="space-y-5 flex-shrink-0 lg:w-7/12" id="sateSate">
@foreach ($posts as $post)
                        <!-- post 1-->
                        <div class="bg-white shadow rounded-md dark:bg-gray-900 -mx-2 lg:mx-0">
    
                            <!-- post header-->
                            <div class="flex justify-between items-center px-4 py-3">
                                <div class="flex flex-1 items-center space-x-4">
                                    <a href="#">
                                        <div class="bg-gradient-to-tr from-yellow-600 to-pink-600 p-0.5 rounded-full">  
                                            <img src="assets/images/avatars/avatar-2.jpg" class="bg-gray-200 border border-white rounded-full w-8 h-8">
                                        </div>
                                    </a>
                                    <span class="block capitalize font-semibold dark:text-gray-100"> {{ $post->user->name }} </span>
                                </div>
                              <div>
                                <a href="#"> <i class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i> </a>
                                <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700" uk-drop="mode: hover;pos: top-right">
                              @if ($user == $post->user->id)
                                  <ul class="space-y-1">
                                      <li> 
                                          <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                           <i class="uil-share-alt mr-1"></i> Share
                                          </a> 
                                      </li>
                                      <li> 
                                          <a href="/post/{{ $post->id }}/edit" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                           <i class="uil-edit-alt mr-1"></i>  Edit Post 
                                          </a> 
                                      </li>
                                      <li> 
                                          <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                           <i class="uil-comment-slash mr-1"></i>   Disable comments
                                          </a> 
                                      </li> 
                                      <li> 
                                          <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                           <i class="uil-favorite mr-1"></i>  Add favorites 
                                          </a> 
                                      </li>
                                      <li>
                                        <hr class="-mx-2 my-2 dark:border-gray-800">
                                      </li>
                                      <li> 
                                          <form action="/post/{{ $post->id }}" method="POST" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600" style="display: inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" style="display: inline-block" onclick="return confirm('Are you sure?')"><i class="uil-trash-alt mr-1"></i>  Delete </button>
                                          </form>
                                      </li>
                                    </ul>
                              @else
                              <ul class="space-y-1">
                                <li> 
                                    <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                     <i class="uil-share-alt mr-1"></i> Share
                                    </a> 
                                </li>
                                <li> 
                                    <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                     <i class="uil-favorite mr-1"></i>  Add favorites 
                                    </a> 
                                </li>
                                <li>
                                  <hr class="-mx-2 my-2 dark:border-gray-800">
                                </li>
                              </ul>
                              @endif
                                    
                                
                                </div>
                              </div>
                            </div>
    
                            <div uk-lightbox>
                                <a href={{ asset("storage/".$post->image) }}>  
                                    {{-- kalau nanti butuh --}}
                                    {{-- style="width: 500px; height: 500px; object-fit: cover" --}}
                                    <img  src={{ asset("storage/".$post->image) }} alt="">
                                </a>
                                <div class="story-content p-4" data-simplebar>

                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
                            
    
                            <div class="py-3 px-4 space-y-3"> 
                               
                                <div class="flex space-x-4 lg:font-bold">
                                    <form class="flex items-center space-x-2" id="formUntuk{{ $post->id }}">
                                        @csrf
                                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                            <div class="p-2 rounded-full text-black">
                                                <i class="icon-feather-thumbs-up"></i>
                                            </div>
                                        <div id="likee">{{ $post->likes() }}</div>
                                        </form>
                                    <a href="#" class="flex items-center space-x-2">
                                        <div class="p-2 rounded-full text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div> Comment</div>
                                    </a>
                                    <a href="#" class="flex items-center space-x-2 flex-1 justify-end">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="22" height="22" class="dark:text-gray-100">
                                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                        <div> Share</div>
                                    </a>
                                </div>
                                <div class="flex items-center space-x-3"> 
                                    <div class="flex items-center">
                                        <img src="assets/images/avatars/avatar-1.jpg" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900">
                                        <img src="assets/images/avatars/avatar-4.jpg" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                                        <img src="assets/images/avatars/avatar-2.jpg" alt="" class="w-6 h-6 rounded-full border-2 border-white dark:border-gray-900 -ml-2">
                                    </div>
                                    <div class="dark:text-gray-100">
                                        Liked <strong> Johnson</strong> and <strong> 209 Others </strong>
                                    </div>
                                </div>

                                <div class="border-t pt-4 space-y-4 dark:border-gray-600">
                                    <div class="flex">
                                        <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                                            <img src="assets/images/avatars/avatar-1.jpg" alt="" class="absolute h-full rounded-full w-full">
                                        </div>
                                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 h-full relative lg:ml-5 ml-2 lg:mr-20  dark:bg-gray-800 dark:text-gray-100">
                                            <p class="leading-6">In ut odio libero vulputate <urna class="i uil-heart"></urna> <i
                                                    class="uil-grin-tongue-wink"> </i> </p>
                                            <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-10 h-10 rounded-full relative flex-shrink-0">
                                            <img src="assets/images/avatars/avatar-1.jpg" alt="" class="absolute h-full rounded-full w-full">
                                        </div>
                                        <div class="text-gray-700 py-2 px-3 rounded-md bg-gray-100 h-full relative lg:ml-5 ml-2 lg:mr-20  dark:bg-gray-800 dark:text-gray-100">
                                            <p class="leading-6">Nam liber tempor cum soluta nobis eleifend option <i class="uil-grin-tongue-wink-alt"></i>
                                            </p>
                                            <div class="absolute w-3 h-3 top-3 -left-1 bg-gray-100 transform rotate-45 dark:bg-gray-800"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-100 bg-gray-100 rounded-full rounded-md relative dark:bg-gray-800">
                                    <input type="text" placeholder="Add your Comment.." class="bg-transparent max-h-10 shadow-none">
                                    <div class="absolute bottom-0 flex h-full items-center right-0 right-3 text-xl space-x-2">
                                        <a href="#"> <i class="uil-image"></i></a>
                                        <a href="#"> <i class="uil-video"></i></a>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>
@endforeach
                        <!-- Load more-->
                        <div class="flex justify-center mt-6" id="toggle" uk-toggle="target: #toggle ;animation: uk-animation-fade">
                            <a href="#"
                                class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                                Load more ..</a>
                        </div>
 
                        <!-- post 3-->
                       
                        
                        <!-- post 4-->
                        
                        <!-- Load more-->
                    </div>

                    <!-- right sidebar-->
                    <div class="lg:w-5/12">

                        <div class="bg-white dark:bg-gray-900 shadow-md rounded-md overflow-hidden">

                            <div class="bg-gray-50 dark:bg-gray-800 border-b border-gray-100 flex items-baseline justify-between py-4 px-6 dark:border-gray-800">
                                <h2 class="font-semibold text-lg">Who to follow</h2>
                                <a href="#"> Refresh</a>
                            </div>
                           
                            <div class="divide-gray-300 divide-gray-50 divide-opacity-50 divide-y px-4 dark:divide-gray-800 dark:text-gray-100">
                                <div class="flex items-center justify-between py-3">
                                    <div class="flex flex-1 items-center space-x-4">
                                        <a href="profile.html">
                                            <img src="assets/images/avatars/avatar-2.jpg" class="bg-gray-200 rounded-full w-10 h-10">
                                        </a>
                                        <div class="flex flex-col">
                                            <span class="block capitalize font-semibold"> Johnson smith </span>
                                            <span class="block capitalize text-sm"> Australia </span>
                                        </div>
                                    </div>
                                    
                                    <a href="#" class="border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800"> Follow </a>
                                </div>

                            </div>

                        </div>

                        <div class="mt-5" uk-sticky="offset:28; bottom:true ; media @m">
                            <div class="bg-white dark:bg-gray-900 shadow-md rounded-md overflow-hidden">

                                <div class="bg-gray-50 border-b border-gray-100 flex items-baseline justify-between py-4 px-6 dark:bg-gray-800 dark:border-gray-700">
                                    <h2 class="font-semibold text-lg">Latest</h2>
                                    <a href="explore.html"> See all</a>
                                </div>
    
                                <div class="grid grid-cols-2 gap-2 p-3 uk-link-reset">
    
                                    <div class="bg-red-500 max-w-full h-32 rounded-lg relative overflow-hidden uk-transition-toggle"> 
                                        <a href="#story-modal" uk-toggle>
                                            <img src="assets/images/post/img2.jpg" class="w-full h-full absolute object-cover inset-0">
                                        </a>
                                        <div class="flex flex-1 justify-around items-center absolute bottom-0 w-full p-2 text-white custom-overly1 uk-transition-slide-bottom-medium">   
                                            <a href="#"> <i class="uil-heart"></i> 150 </a>
                                            <a href="#"> <i class="uil-heart"></i> 30 </a>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-red-500 max-w-full h-40 rounded-lg relative overflow-hidden uk-transition-toggle"> 
                                        <a href="#story-modal" uk-toggle>
                                            <img src="assets/images/post/img7.jpg" class="w-full h-full absolute object-cover inset-0">
                                        </a>
                                        <div class="flex flex-1 justify-around items-center absolute bottom-0 w-full p-2 text-white custom-overly1 uk-transition-slide-bottom-medium">   
                                            <a href="#"> <i class="uil-heart"></i> 150 </a>
                                            <a href="#"> <i class="uil-heart"></i> 30 </a>
                                        </div>
                                    </div>                             
                                    
                                    <div class="bg-red-500 max-w-full h-40 -mt-8 rounded-lg relative overflow-hidden uk-transition-toggle"> 
                                        <a href="#story-modal" uk-toggle>
                                            <img src="assets/images/post/img5.jpg" class="w-full h-full absolute object-cover inset-0">
                                        </a>
                                        <div class="flex flex-1 justify-around  items-center absolute bottom-0 w-full p-2 text-white custom-overly1 uk-transition-slide-bottom-medium">   
                                            <a href="#"> <i class="uil-heart"></i> 150 </a>
                                            <a href="#"> <i class="uil-heart"></i> 30 </a>
                                        </div>
                                    </div>
    
                                    <div class="bg-red-500 max-w-full h-32 rounded-lg relative overflow-hidden uk-transition-toggle"> 
                                        <a href="#story-modal" uk-toggle>
                                            <img src="assets/images/post/img3.jpg" class="w-full h-full absolute object-cover inset-0">
                                        </a>
                                        <div class="flex flex-1 justify-around  items-center absolute bottom-0 w-full p-2 text-white custom-overly1 uk-transition-slide-bottom-medium">   
                                            <a href="#"> <i class="uil-heart"></i> 150 </a>
                                            <a href="#"> <i class="uil-heart"></i> 30 </a>
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>

                    </div>

                </div>               
          

            </div>

        </div>

    </div>



    <!-- Story modal -->
    <div id="story-modal" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog story-modal">
            <button class="uk-modal-close-default lg:-mt-9 lg:-mr-9 -mt-5 -mr-5 shadow-lg bg-white rounded-full p-4 transition dark:bg-gray-600 dark:text-white" type="button" uk-close></button>

                <div class="story-modal-media">
                    <img src="assets/images/post/img4.jpg" alt=""  class="inset-0 h-full w-full object-cover">
                </div>
                <div class="flex-1 bg-white dark:bg-gray-900 dark:text-gray-100">
                
                    <!-- post header-->
                    <div class="border-b flex items-center justify-between px-5 py-3 dark:border-gray-600">
                        <div class="flex flex-1 items-center space-x-4">
                            <a href="#">
                                <div class="bg-gradient-to-tr from-yellow-600 to-pink-600 p-0.5 rounded-full">
                                    <img src="assets/images/avatars/avatar-2.jpg"
                                        class="bg-gray-200 border border-white rounded-full w-8 h-8">
                                </div>
                            </a>
                            <span class="block text-lg font-semibold"> Johnson smith </span>
                        </div>
                        <a href="#"> 
                            <i  class="icon-feather-more-horizontal text-2xl rounded-full p-2 transition -mr-1"></i>
                        </a>
                    </div>

                </div>

        </div>
    </div>
    <script>
        const sate = document.querySelector('#sateSate');
        sate.addEventListener('click', function(e){
            let user_id = e.target.parentElement.previousElementSibling.previousElementSibling.getAttribute('value');
            let post_id = e.target.parentElement.previousElementSibling.getAttribute('value');
            let _token = $('input[name="_token"]').val();
            let url = '{{ route('like.add') }}';
            let hasLike = e.target.parentElement.nextElementSibling;
            let kukuku = e.target.parentElement.parentElement;
            let hii = e.target.parentElement.parentElement.getAttribute('id');
                        $.ajax({
                url:url,
                type:"POST",
                data:{
                    user_id:user_id,
                    post_id:post_id,
                    _token:_token,
                },
             success:function(response){
                if (response) {
                    $(kukuku).load('/feed '+'#'+hii);
                }
             },
             error:function(error){
      console.log(error)
   }   
            });
        });
    </script>
    @endsection
