@props(["job"])
  <div class="group grid max-w-screen-md grid-cols-12 px-5  overflow-hidden rounded-lg border py-4 text-gray-700 shadow transition hover:shadow-lg sm:mx-auto bg-white">
    <div class="col-span-11 flex flex-col text-left">
      <h3 class="text-sm text-gray-600">{{$job->employer->name}}</h3>
      <a href="/jobs/{{$job->id}}" class="mb-3 overflow-hidden pr-7 text-lg font-semibold sm:text-xl hover:underline"> {{$job->title}} </a>

      <div class="flex flex-col space-y-3 text-sm font-medium text-gray-500  sm:space-y-0 gap-2">
        <div class="">Experience:<span class="ml-2 mr-3 rounded-full bg-green-100 px-2 py-0.5 text-green-900"> {{rand(1,15)}} Years </span></div>
        <div class="">Salary:<span class="ml-2 mr-3 rounded-full bg-blue-100 px-2 py-0.5 text-blue-900">${{number_format($job->salary)}}</span></div>
        @if (count($job->tags))
            <div class="">
                <span class="mr-2">Tags:</span>
                @foreach ($job->tags as $tag)
                    <span class="mr-2 rounded-full bg-red-100 px-2 py-0.5 text-red-700">{{$tag->name}}</span>
                @endforeach
            </div>
        @endif
      </div>
    </div>
  </div>

