<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Testimonial::class, 'testimonial');
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(20);

        return view('backend.testimonials.index', [
            'testimonials' => $testimonials,
            'testimonial' => new Testimonial(),
            'isEdit' => false,
        ]);
    }

    /**
     * Not used.
     */
    public function create()
    {
        return redirect()->route('backoffice.testimonials.index');
    }

    /**
     * Store a newly created testimonial.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'position'   => ['nullable', 'string', 'max:255'],
            'testimonial'=> ['required', 'string'],
            'rating'     => ['required', 'integer', 'between:1,5'],
            'status'     => ['required', Rule::in([0,1])],
        ]);

        Testimonial::create($validated);

        return redirect()
            ->route('backoffice.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Not used.
     */
    public function show(Testimonial $testimonial)
    {
        return redirect()->route('backoffice.testimonials.index');
    }

    /**
     * Show the edit form on the same page.
     */
    public function edit(Testimonial $testimonial)
    {
        $testimonials = Testimonial::latest()->paginate(20);

        return view('backend.testimonials.index', [
            'testimonials' => $testimonials,
            'testimonial' => $testimonial,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the testimonial.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'position'   => ['nullable', 'string', 'max:255'],
            'testimonial'=> ['required', 'string'],
            'rating'     => ['required', 'integer', 'between:1,5'],
            'status'     => ['required', Rule::in([0,1])],
        ]);

        $testimonial->update($validated);

        return redirect()
            ->route('backoffice.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Delete the testimonial.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()
            ->route('backoffice.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}