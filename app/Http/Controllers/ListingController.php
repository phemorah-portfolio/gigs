<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteGig;
use Carbon\Carbon;

use App\Models\Listing;
use App\Models\Tag;
use App\Models\User;


class ListingController extends Controller
{
    public function __construct() {
        /*
        This auhorizes the entire resource that automatically maps the given controller callbacks to the policy
        */
        // $this->authorizeResource(Listing::class, 'listing');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $listings = Listing::with('tags')->latest()->get();

        $tags = Tag::orderBy('name')->get();

        // The following block of codes filters the listings through the search string 's' value/attributes before passing it to view
        if($request->has('s')) {
            $query = strtolower($request->get('s'));
            $listings = $listings->filter(function($listing) use($query) {
                if(Str::contains(strtolower($listing->title), $query)) {
                    return true;
                }
                if(Str::contains(strtolower($listing->company), $query)) {
                    return true;
                }
                if(Str::contains(strtolower($listing->location), $query)) {
                    return true;
                }
                if(Str::contains(strtolower($listing->description), $query)) {
                    return true;
                }

                return false;
            });
        }

        // filter the listings through the search 'tag' value/attributes before passing it to view blade
        if ($request->has('tag')) {
            $tag = $request->get('tag');
            $listings = $listings->filter(function($listing) use($tag) {
                return $listing->tags->contains('slug', $tag);
            });
        }

        return view('gigs.index', compact('listings','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gigs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // process the Gig listing creation form
        $validationArray = [
            'title' => 'required',
            'company' => 'required',
            'country' => 'required',
            'state' => 'required',
            'description' => 'required',
            'address' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required'
        ];

        if (!Auth::check()) {
            $validationArray = array_merge($validationArray, [
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:5',
                'name' => 'required'
            ]);
        }

        $request->validate($validationArray);

        // is a user signed in? if not, create one and authenticate
        $user = Auth::user();

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Auth::login($user);
        }

        // Create the listing
        try {
            $listing = $user->listings()->create(
                [
                    'title' => $request->title,
                    'slug' => Str::slug($request->title) . '-' . rand(1111, 9999),
                    'company' => $request->company,
                    'country' => $request->country,
                    'state' => $request->state,
                    'description' => $request->input('description'),
                    'is_highlighted' => $request->filled('is_highlighted'),
                    'address' => $request->address,
                    'min_amount' => $request->min_amount,
                    'max_amount' => $request->max_amount
                ]
            );

            $this->listingTags(explode(',', $request->tags), $listing->id);

            // Send mail
            $listing->sendNewGigNotificationEmail();

            return redirect()->route('dashboard');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('gigs.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return view('gigs.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {

        // process the Gig listing creation form
        $validationArray = [
            'title' => 'required',
            'company' => 'required',
            'country' => 'required',
            'state' => 'required',
            'description' => 'required',
            'address' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required'
        ];

        $request->validate($validationArray);

        // is a user signed in? if not, create one and authenticate
        $user = Auth::user();

        // Create the listing
        try {
            $gigAttributes = $request->except(['_method', '_token','tags']);

            $user->listings()->update($gigAttributes);

            $this->listingTags(explode(',', $request->tags), $listing->id);

            return redirect()->route('dashboard');

        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {

        $deletedAt = Carbon::now();
        $listing->deleted_on = $deletedAt->toDateTimeString();

        $this->sendGigDeleteNotificationEmail($listing);

        $listing->delete();

        return redirect('/');
    }


    public function sendGigDeleteNotificationEmail($listing) {

        Mail::to(config('mail.notification_recipient'))
        ->queue(new DeleteGig($listing));

        return redirect()->route('dashboard');
    }



    public function listingTags($tags, $listingID)
    {
        foreach($tags as $requestTag) {
            $tag = Tag::firstOrCreate([
                'slug' => Str::slug(trim($requestTag))
            ], [
                'name' => ucwords(trim($requestTag))
            ]);

            $tag->listings()->attach($listingID);
        }
    }

}
