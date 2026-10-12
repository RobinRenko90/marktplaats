<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

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
                'advertisements' => $advertisements->get(),
                'categories'     => Category::get(),
            ]);
        } else {
            $advertisements = Advertisement::query();

            if ($request->has('category') && !empty($request->input('category'))) {
                $advertisements->whereHas('categories', function ($q)use($request){
                    $q->where('name', $request->category);
                });
            }

            if ($request->has('search') && !empty($request->input('search'))) {
                $search = $request->input('search');
                $advertisements->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")->get();
            }

            return view('dashboard')->with([
                'advertisements' => $advertisements->paginate(2),
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
}
