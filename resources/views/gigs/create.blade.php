<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="w-full md:w-1/2 py-24 mx-auto">
            <div class="mb-4">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    CREATE A NEW GIG
                </h2>
            </div>
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-200 text-red-800">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form
                action="{{ route('listing.store') }}"
                id="create_form"
                method="post"
                enctype="multipart/form-data"
                class="bg-gray-100 p-4"
            >
                @guest
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="email" value="Email Address" />
                            <x-input
                                class="block mt-1 w-full"
                                id="email"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required
                                autofocus />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="name" value="Full Name" />
                            <x-input
                                class="block mt-1 w-full"
                                id="name"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="password" value="Password" />
                            <x-input
                                class="block mt-1 w-full"
                                id="password"
                                type="password"
                                name="password"
                                required />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="password_confirmation" value="Confirm Password" />
                            <x-input
                                class="block mt-1 w-full"
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required />
                        </div>
                    </div>
                @endguest
                <div class="flex mb-4">
                    <div class="flex-1 mx-2">
                        <x-label for="company" value="Company Name" />
                        <x-input
                            class="block mt-1 w-full"
                            id="company"
                            type="text"
                            name="company"
                            value="{{ old('company') }}"
                            required />
                    </div>
                    <div class="flex-1 mx-2">
                        <x-label for="title" value="Gig Role" />
                        <x-input
                            class="block mt-1 w-full"
                            id="title"
                            type="text"
                            name="title"
                            required />
                    </div>
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="tags" value="Tags (separate by comma)" />
                    <x-input
                        id="tags"
                        class="block mt-1 w-full"
                        type="text"
                        name="tags" />
                </div>
                <div class="flex mb-4">
                    <div class="flex-1 mx-2">
                        <x-label for="min_amount" value="Min Amount" />
                        <x-input
                            class="block mt-1 w-full"
                            id="min_amount"
                            type="text"
                            name="min_amount"
                            required />
                    </div>
                    <div class="flex-1 mx-2">
                        <x-label for="max_amount" value="Max Amount" />
                        <x-input
                            class="block mt-1 w-full"
                            id="max_amount"
                            type="text"
                            name="max_amount"
                            required />
                    </div>
                </div>
                <div class="flex mb-4">
                    <div class="flex-1 mx-2">
                        <x-label for="country" value="Location (e.g. Remote, Nigeria, United States)" />
                        <x-input
                            class="block mt-1 w-full"
                            id="country"
                            type="text"
                            name="country"
                            required />
                    </div>
                    <div class="flex-1 mx-2">
                        <x-label for="state" value="State" />
                        <x-input
                            class="block mt-1 w-full"
                            id="state"
                            type="text"
                            name="state"
                            required />
                    </div>
                </div>

                <div class="mb-4 mx-2">
                    <x-label for="address" value="Address" />
                    <x-input
                        id="address"
                        class="block mt-1 w-full"
                        type="text"
                        name="address" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="description" value="Gig Description (Markdown is okay)" />
                    <textarea
                        id="description"
                        rows="8"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                        name="description"
                    ></textarea>
                </div>
                <div class="mb-4 mx-2">
                    <label for="is_highlighted" class="inline-flex items-center font-medium text-sm text-gray-700">
                        <input
                            type="checkbox"
                            id="is_highlighted"
                            name="is_highlighted"
                            value="Yes"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                    </label>
                    <span class="ml-2">Highlight this post</span>
                </div>
                <div class="mb-6 mx-2">
                    <div id="card-element"></div>
                </div>
                <div class="mb-2 mx-2">
                    @csrf
                    <button type="submit" id="form_submit" class="block w-full_ text-2xl items-center bg-indigo-500 text-white border-0 py-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0 px-7">Submit Gig</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>