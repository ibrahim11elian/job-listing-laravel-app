<x-layout>
    <x-slot:heading>
        Edit Job
    </x-slot:heading>

    <form method="POST" action="/jobs/{{$job->id}}">
    @csrf
    @method('PATCH')

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Edit job #{{$job->id}}</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Just edit what you need in this job</p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
            <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" value="{{$job->title}}" name="title" id="title"  class="block flex-1 border-0 bg-transparent focus:outline-none py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Job Title" >
                </div>
            </div>
            @error('title')
              <div class="text-red-500 text-sm font-semibold mt-2">{{$message}}</div>
            @enderror
            </div>
            <div class="sm:col-span-4">
            <label for="salary" class="block text-sm font-medium leading-6 text-gray-900">Salary</label>
            <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                     <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">$</span>
                <input type="text" name="salary" id="salary"  class="block focus:outline-none flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="5000" value="{{$job->salary}}" required>
                </div>
            </div>
            @error('salary')
             <div class="text-red-500 mt-2 text-sm font-semibold">{{$message}}</div>
            @enderror

            </div>

        </div>

        {{-- @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)

            <div class="text-red-500">{{$error}}</div>
            @endforeach

            @endif
        </div> --}}
        </div>

    </div>

    <div class="mt-6 flex items-center justify-between">
        <div>
            <button form="delete-form"  class=" px-4 py-2 text-sm font-medium text-white bg-red-600 border  leading-5 hover:bg-red-500 rounded-md hover:text-gray-50 ml-3 focus:outline-none focus:ring ring-red-400 focus:border-red-300 transition ease-in-out duration-150">Delete</button>
        </div>
        <div>
            <a href="/jobs/{{$job->id}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-6">Update</button>
        </div>
        </div>
    </form>

    <form action="/jobs/{{$job->id}}" id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
