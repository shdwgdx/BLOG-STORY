<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        foreach ($request->partner as $key => $partner) {
            $partnerId = Partner::create($partner);
            $partnerImage = $partner['url_image'];
            $partnerImageName = time() . "_" .  $partnerImage->getClientOriginalName(); // оригинальное имя файла

            $directory = "partners/$partnerId->id";
            $partnerImagePath = $partnerImage->storeAs($directory, $partnerImageName, 'public');
            $partnerImage = Storage::url($partnerImagePath);
            $partnerId->url_image = $partnerImage;
            $partnerId->save();
        }

        Session::flash('success', 'Partners created successfully.');
        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        // dd($partner);
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        // dd($partner);
        Storage::disk('public')->delete(str_replace('/storage', '', $partner->url_image));
        foreach ($request->partner as $key => $partnerItem) {

            $partnerImage = $partnerItem['url_image'];
            $partnerImageName = time() . "_" .  $partnerImage->getClientOriginalName(); // оригинальное имя файла

            $directory = "partners/$partner->id";
            $partnerImagePath = $partnerImage->storeAs($directory, $partnerImageName, 'public');
            $partnerImage = Storage::url($partnerImagePath);

            $partnerItem['url_image'] = $partnerImage;
            $partner->update($partnerItem);
        }

        Session::flash('success', 'Partner changed successfully.');
        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        Storage::disk('public')->deleteDirectory("partners/$partner->id");


        $partner->delete();
        Session::flash('success', 'Partner successfully deleted.');
        return redirect()->route('partners.index');
    }
}
