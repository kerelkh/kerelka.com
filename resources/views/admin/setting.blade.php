@extends('admin.layouts.index')

@section('content')
  <div class="w-full h-full overflow-y-auto py-4 px-10 text-gray-200">
    <div class="flex space-x-12 items-center mb-2 py-2">
      <h1 class="text-3xl">Setting</h1>
      <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
    </div>
    <div id="banner-container" class="w-full flex flex-wrap">
      <ul>
        <li class="mb-5">
          <h1 class="text-lg mb-5 border-b border-gray-200">Banner</h1>
          <div class="flex gap-4 items-start w-full">
            <form method="POST" onsubmit="submitBanner(event)" class="flex-none">
              {{-- @csrf --}}
              <div class="flex items-start space-x-4 mb-4">
                <img src="{{ asset('images/sample-image.png') }}" id="img-temp" class="bg-[#2A2B4A] rounded-lg h-32 w-48 object-cover">
                <input type="file" name="banner" id="banner" class="text-sm text-slate-500
                file:mr-4 file:py-2
                file:rounded-full file:border-0
                file:text-sm
                file:bg-[#2A2B4A] file:text-gray-200
                cursor-pointer" 
                onchange="onImageChange()"
                accept="image/png, image/gif, image/jpeg"
                required>
              </div>
              <button type="submit" class="p-2 rounded-lg bg-[#2A2B4A] text-green-500 border border-[#2A2B4A] hover:border-[#18192d] hover:bg-[#18192d]"><i class="fa-solid fa-circle-plus"></i> Add Banner</button>
            </form>
            <div id="list-banner" class="flex flex-col items-start flex-none">
              <h2 class="text-lg rounded-lg mb-3 bg-[#2A2B4A] p-2">List Banner</h2>
              <ul class="h-28 overflow-y-auto py-2 pr-8">
                @foreach($banners as $banner)
                  <li class="flex gap-4 mb-3">
                    <div>
                      <span class="rounded-full p-1 mr-2 bg-[#2A2B4A]">{{ $loop->index+1 }}</span>
                      <a href="{{ asset('storage/' . $banner->path) }}" target="_blank">Banner-{{ $loop->index+1 }}</a>
                    </div>
                    <button onclick="togglePopUpDeleteBanner({{ $loop->index+1 }})" class="text-red-500"><i class="fa-solid fa-circle-minus"></i></button>
                    <div id="confirm-delete-{{ $loop->index+1 }}" class="hidden fixed inset-0 justify-center items-center bg-gray-400/20">
                      <div id="confirm-container" class="rounded-lg p-4 text-center text-red-500 flex flex-col justify-center items-stretch space-y-4 bg-gray-50 ">
                        <i class="fa-solid fa-triangle-exclamation fa-3x"></i>
                        <p>Are you sure you want to delete this Banner ?</p>
                        <div class="flex justify-center items-center gap-5">
                          <button onclick="deleteBanner({{ $banner->id }}, {{ $loop->index+1 }})" class="bg-gray-400 hover:bg-gray-700 transition-all ease-in-out text-white rounded py-2 px-4">Yes</button>
                          <button onclick="togglePopUpDeleteBanner({{ $loop->index+1 }})" class="bg-green-400 hover:bg-green-700 transition-all ease-in-out text-white rounded py-2 px-4">No</button>
                        </div>
                      </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
            <div id="notice-container">
              <h2 class="text-lg rounded-lg mb-3 bg-[#2A2B4A] p-2">Notice</h2>
              <form class="flex items-strecth" onsubmit="submitNotice(event)">
                <textarea style="resize: none;" name="notice" id="notice" cols="50" rows="4" class="outline-none p-2 bg-[#2A2B4A] placeholder:italic" placeholder="white here ... " required></textarea>
                <button type="submit" class="p-2 rounded-lg ml-4 bg-[#2A2B4A] border border-[#2A2B4A] hover:border-[#18192d] hover:bg-[#18192d] text-green-500 transition-all ease-in-out">Publish</button>
              </form>
            </div>
          </div>
        </li>
        
      </ul>
    </div>
  </div>

  <div id="popup" class="hidden fixed inset-0 bg-black/10 justify-center items-center">
    <div id="loading" class="hidden rounded-lg px-4 py-2 text-violet-800 bg-violet-400/20 gap-4 justify-center items-center">
      <div class="fa-2x">
        <i class="fas fa-circle-notch fa-spin"></i>
      </div>
      Processing...
    </div>
    <div id="success" class="hidden rounded-lg px-4 py-2 text-violet-800 bg-violet-400/20 gap-4 justify-center items-center">
      <div class="fa-2x">
        <i class="fa-solid fa-check-to-slot"></i>
      </div>
      Success
    </div>
    <div id="error" class="hidden rounded-lg px-4 py-2 text-red-800 bg-red-400/20 gap-4 justify-center items-center">
      <div class="fa-2x">
        <i class="fa-solid fa-circle-exclamation"></i>
      </div>
      Failed
    </div>
  </div>

  <script>
    //script banner img temp
    const imgTempEl = document.getElementById('img-temp');
    const bannerEl = document.getElementById('banner')

    function onImageChange() {
      let reader = new FileReader();
      if(bannerEl.files[0]){
        reader.readAsDataURL(bannerEl.files[0]);
      }

      reader.onloadend = function() {
        imgTempEl.src = reader.result;
      }
    }

    //script submit banner
    const popupEl = document.getElementById('popup');
    const loadingEl = document.getElementById('loading');
    const successEl = document.getElementById('success');
    const errorEl = document.getElementById('error');

    //initial popup function
    function togglePopUp() {
      popupEl.classList.toggle('hidden');
      popupEl.classList.toggle('flex');

      loadingEl.classList.toggle('hidden');
      loadingEl.classList.toggle('flex');
    }

    function togglePopUpProccess() {
      loadingEl.classList.toggle('hidden');
      loadingEl.classList.toggle('flex');
    }

    function togglePopUpSuccess() {
      successEl.classList.toggle('hidden');
      successEl.classList.toggle('flex');
    }

    function togglePopUpError() {
      errorEl.classList.toggle('hidden');
      errorEl.classList.toggle('flex');
    }

    function submitBanner(e) {
      e.preventDefault();
      togglePopUp();

      //data
      let formData = new FormData();

      formData.append('banner', bannerEl.files[0]);

      axios({
        method: 'POST',
        url: 'api/uploadbanner',
        data: formData,
        headers: {
          'Content-Type': 'multipart/form-data',
        }
      }).then(response => {
        if(response.data.message == 'success'){
          setTimeout(() => {
            togglePopUpProccess();
            togglePopUpSuccess();
            setTimeout(()=> {
              togglePopUpSuccess();
              window.location.reload();
            },2000);
          }, 2000);
        }
      }).catch(error => {
        setTimeout(() => {
          togglePopUpProccess();
          togglePopUpError();
          setTimeout(()=> {
            togglePopUpError();
            window.location.reload();
          },2000);
        }, 2000);
      });
      
    }

    //script delete banner 
    function togglePopUpDeleteBanner(container) {
      let containerEl = document.getElementById("confirm-delete-" + container);
      containerEl.classList.toggle('hidden');
      containerEl.classList.toggle('flex');
    }

    function deleteBanner(id, container) {
      togglePopUpDeleteBanner(container);
      togglePopUp();

      const url = 'api/deletebanner/' + id;
      axios({
        method: 'delete',
        url: url
      }).then(response => {
        setTimeout(() => {
          togglePopUpProccess();
          togglePopUpSuccess();

          setTimeout(()=> {
            togglePopUpSuccess();

            window.location.reload();
          },2000);
        }, 2000);
      }).catch(error => {
        setTimeout(() => {
          togglePopUpProccess();
          togglePopUpError();
          setTimeout(()=> {
            togglePopUpError();
            window.location.reload();
          },2000);
        }, 2000);
      })
    }


    //script submit notice
    function submitNotice(e) {
      e.preventDefault();
      togglePopUp();

      let noticeEl = document.getElementById('notice');

      axios.post('api/notice', {
        'notice': noticeEl.value
      }).then(response => {
        setTimeout(() => {
          togglePopUpProccess();
          togglePopUpSuccess();
          setTimeout(()=> {
            togglePopUpSuccess();
            window.location.reload();
          },2000);
        }, 2000);
      }).catch(error => {
        setTimeout(() => {
          togglePopUpProccess();
          togglePopUpError();
          setTimeout(()=> {
            togglePopUpError();
            window.location.reload();
          },2000);
        }, 2000);
      })
    }
  </script>
@endsection