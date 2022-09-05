@props(['listing'])

<div
    class="mt-2 py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $listing->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}"
>
    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
        <img src="" alt="{{ $listing->company }} logo" class="w-16 h-16 rounded-full object-cover">
    </div>
    <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
        <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $listing->title }}</h2>
        <p class="leading-relaxed text-gray-900">
            {{ $listing->company }} &mdash; <span class="text-gray-600">{{ $listing->location }}</span>
        </p>
    </div>
    <div class="md:flex-grow mr-8 flex items-center justify-start">
        @foreach($listing->tags as $tag)
            <span class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">
                {{ $tag->name }}
            </span>
        @endforeach
        <div class="md:flex-grow flex items-center justify-end">
            <span>{{ $listing->created_at->diffForHumans() }}</span>
        </div>
        <div class="md:flex-grow flex items-center justify-end">
            <a href="{{ route('listing.show', $listing->slug) }}">Show Details</a>
            @can('view', $listing)
                <a href="{{ route('listing.edit', $listing->slug) }}" class="inline-flex items-center bg-slate-400 text-black border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0 mr-1">
                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path fill="white" fill-rule="evenodd" d="M15.586 3a2 2 0 0 1 2.828 0L21 5.586a2 2 0 0 1 0 2.828L19.414 10 14 4.586 15.586 3zm-3 3-9 9A2 2 0 0 0 3 16.414V19a2 2 0 0 0 2 2h2.586A2 2 0 0 0 9 20.414l9-9L12.586 6z" clip-rule="evenodd"></path></svg>
                    Edit
                </a>
            @endcan
            @can('delete', $listing)
                <form action="{{ route('listing.destroy', $listing->slug) }}" method="POST">
                    <button
                     type="submit"
                     class="inline-flex items-center bg-red-500 text-white border-0 py-3 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0 float-right">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/> <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/> </svg>
                        @csrf
                        @method('delete')
                         Delete Gig
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
