<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Contact;
use SimpleXMLElement;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $contact = Contact::all();
        return view('contacts.index')->with('contacts', $contact);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required | min:3',
            'phone_number' => 'required  | min:10 | max : 10'
        ]);

        $input = $request->all();
        Contact::create($input);

        return redirect('contacts')->with('flash message', 'Contact Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $contact = Contact::find($id);
        return view('contacts.show', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $contact = Contact::find($id);
        return view('contacts/edit')->with('contacts', $contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $contact = Contact::find($id);
        $input = $request->all();
        $contact->update($input);

        return redirect('contacts')->with('flash message', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Contact::destroy($id);
        return redirect('contacts')->with('flash message', 'User Deleted Successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|mimes:xml',
        ]);

        $file = $request->file('xml_file');
        $xmlString = file_get_contents($file->getPathname());
        $xml = new SimpleXMLElement($xmlString);

        $contacts = [];

        foreach ($xml->contact as $contactElement) {
            $contacts[] = [
                'name' => (string) $contactElement->name,
                'phone_number' => (string) $contactElement->phone_number,
            ];
        }

        if (!empty($contacts)) {
            DB::table('userdata')->insert($contacts);
            return redirect('contacts')->with('flash message', 'Contacts imported successfully');
        } else {
            return redirect('contacts')->with('flash message', 'No valid contact data found in the XML file.');
        }
    }
}
