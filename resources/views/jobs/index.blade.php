<x-layout>
    <x-slot:heading>Jobs Page</x-slot>

    <ul class="grid grid-cols-12 gap-3">
        @foreach ($jobs as $job)
            <li class="col-span-full sm:col-span-6 md:col-span-4 xl:col-span-3">
                <x-job-card :job="$job" />
            </li>
        @endforeach
    </ul>
    @if (request()->is("jobs"))
        <div class="mt-3">
            {{ $jobs->links() }}
        </div>
    @endif
</x-layout>
