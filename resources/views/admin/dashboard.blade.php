@extends('admin.layouts.index')

@section('content')
  <div class="w-full h-full overflow-y-auto py-4 px-10 text-gray-200">
    <div class="flex space-x-12 items-center mb-2 p-2">
      <h1 class="text-3xl">Dashboard</h1>
      <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
    </div>
    <div class="flex mb-4">
      <div data-aos="fade-up" class="w-2/5 flex flex-wrap">
        <div class="w-1/2 min-h-48 p-2 ">
          <div class="w-full h-full bg-[#2A2B4A] px-4 py-2 flex flex-col justify-between">
            <p class="text-gray-400 text-lg">Posts</p>
            <p class="text-5xl text-center text-yellow-500">{{ $sumposts }}</p>
            <p class="text-gray-500">Total post</p>
          </div>
        </div>
        <div class="w-1/2 min-h-48 p-2 ">
          <div class="w-full h-full bg-[#2A2B4A] px-4 py-2 flex flex-col justify-between">
            <p class="text-gray-400 text-lg">Draft</p>
            <p class="text-5xl text-center text-blue-500">{{ $sumdraft }}</p>
            <p class="text-gray-500">Total draft not yet publish</p>
          </div>
        </div>
        <div class="w-1/2 min-h-48 p-2 ">
          <div class="w-full h-full bg-[#2A2B4A] px-4 py-2 flex flex-col justify-between">
            <p class="text-gray-400 text-lg">Published</p>
            <p class="text-5xl text-center text-green-500">{{ $sumpublish }}</p>
            <p class="text-gray-500">Total published post</p>
          </div>
        </div>
        <div class="w-1/2 min-h-48 p-2 ">
          <div class="w-full h-full bg-[#2A2B4A] px-4 py-2 flex flex-col justify-between">
            <p class="text-gray-400 text-lg">Deleted</p>
            <p class="text-5xl text-center text-red-500">{{ $sumdeleted }}</p>
            <p class="text-gray-500">Total soft delete post</p>
          </div>
        </div>
      </div>
      <div data-aos="fade-left" data-aos="1000" class="w-3/5 p-2">
        <div class="w-full h-full p-2 bg-[#2A2B4A]">
          <p class="text-gray-400 text-lg">One Year Dataset</p>
          <canvas id="myChart"></canvas  s>
        </div>
      </div>
    </div>  
  </div>


  <script src={{ asset('js/chart.min.js') }}></script>
  <script>
    (function() {
      const ctx = document.getElementById('myChart');

      const labels = @json($dataLabelYear);
      const data = {
        labels: labels,
        datasets: [{
          label: "Draft",
          data: @json($dataDraftYear),
          fill: true,
          borderColor: 'rgb(59, 130, 246)',
          tension: 0.1
        }, {
          label: 'Published',
          data: @json($dataPublishedYear),
          fill: true,
          borderColor: 'rgb(34,197,94)',
          tension: 0.1,
        }, {
          label: 'Deleted',
          data: @json($dataDeletedYear),
          fill: true,
          borderColor: 'rgb(239,68,68)',
          tension: 0.1,
        }]
      };

      const config = {
        type: 'line',
        data: data,
      };
      const myChart = new Chart(
        ctx,
        config
      );
    })();
  </script>


@endsection