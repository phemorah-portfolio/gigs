<x-app-layout>
    <div class="">
        <x-hero></x-hero>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <div class="mb-12">
                        <div class="flex-justify-center">
                            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Categories</h1>
                            @foreach($tags as $tag)
                                <a href="{{ route('gigs.index', ['tag' => $tag->slug]) }}"
                                    class="hover:bg-green-600 hover:text-white _bg-green-500 inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-green-500 text-white' : 'bg-white text-indigo-500' }}"
                                >{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="_lg:w-2/3 w-full mx-auto overflow-auto">
                    <div class="mb-12">
                        <h2 class="text-2xl font-medium text-gray-900 title-font px-4">All Gigs ({{ $listings->count() }})</h2>
                    </div>
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                        <tr>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Company</th>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Role</th>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Location</th>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Date</th>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Salary</th>
                            <th class="font-bold uppercase px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Price Range</th>
                            <th class="font-bold uppercase w-20 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @unless(count($listings) == 0)
                                @foreach($listings as $listing)
                                     <!-- Add Gig Compnent -->
                                    <x-gigs-table :listing="$listing" />
                                @endforeach
                            @endunless
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>