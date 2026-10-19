<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Mail\AdvertisementReply;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Auth;
use Route;

class AdvertismentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Route::currentRouteName() == 'advertisement.index') {
            $advertisements = Advertisement::where('user_id', Auth::user()->id);

            return view('advertisement.index')->with([
                'advertisements' => $advertisements->orderBy('premium', 'desc')->latest('created_at', 'desc')->get(),
                'categories'     => Category::get(),
            ]);
        } else {
            $advertisements = Advertisement::query();

            if ($request->filled('category')) {
                $advertisements->whereHas('categories', function ($q)use($request){
                    $q->where('name', $request->input('category'));
                });
            }

            if ($request->filled('search')) {
                $search = $request->input('search');

                $advertisements->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }

            return view('dashboard')->with([
                'advertisements' => $advertisements->orderBy('premium', 'desc')->latest('created_at', 'desc')->paginate(10)->withQueryString(),
                'categories'     => Category::get(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advertisement.create')->with([
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdvertisementRequest $request)
    {
        $validateData = $request->validated();

        $advertisement = Advertisement::create([
            'title'         => $validateData['title'],
            'description'   => $validateData['description'],
            'price'         => $validateData['price'],
            'user_id'       => Auth::user()->id,
        ]);

        $syncCategory = $advertisement->categories()->sync($validateData['category']);

        return redirect()->to('/dashboard')->with('success', 'Advertentie is aangemaakt');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        return view('advertisement.show', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        if (Auth::user()->cannot('update', $advertisement)) {
            abort(403,'Je hebt geen recht om deze advertentie aan te passen...');
        }

        return view('advertisement.edit', compact('advertisement'))->with([
            'categories' => Category::all(),
            'selectedCategory' => $advertisement->categories->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        if (Auth::user()->cannot('update', $advertisement)) {
            abort(403,'Je hebt geen recht om deze advertentie aan te passen...');
        }

        $validateData = $request->validated();

        $advertisement->update($validateData);
        
        $syncCategory = $advertisement->categories()->sync($validateData['category']);

        return redirect()->to('/advertisement')->with('success', 'Advertentie is aangepast');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        if (Auth::user()->cannot('delete', $advertisement)) {
            abort(403,'Je hebt geen recht om deze advertentie te verwijderen...');
        }

        $advertisement->delete();

        return redirect()->to( Route('advertisement.index') )->with('success', 'De advertentie is succesvol verwijderd.');
    }

    public function search(Request $request){
        $search = $request->input('search');
        $advertisements = Advertisement::where('title', 'like', "%$search%");

        return view('dashboard')->with([
            'advertisements' => $advertisements->paginate(2),
            'categories'     => Category::get(),
        ]);
    }

    public function promote(Advertisement $advertisement){
        return view('settings.promote', compact('advertisement'));
    }

    public function postPromote(Request $request, Advertisement $advertisement)
    {
        $advertisement->update([
            'premium' => true,
        ]);

        return redirect('/dashboard');
    }

    public function contact(Request $request, Advertisement $advertisement){
  
        //send mail to user of the advertisement
        Mail::to($advertisement->user->email)
            ->send(new AdvertisementReply($advertisement, $request->contact_content, Auth::user()));

        return redirect()->back()->with('success', 'Een notificatie/mail is naar de verkoper verstuurd');
    }
}
