<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index(Request $req){
        $contact =Contact::all();
        #fetching all record from Contact model class
        return  view('welcome')->with("contact",$contact);
        #This passes the $contact variable (which holds the data from the database)
        #to the welcome view. The first argument "contact" is the name of the variable 
        #that will be accessible in the view, and the second argument $contact is the actual data (all contact records)

    }
    public function add(Request $req){
        $contact =new Contact;
        $contact->email=$req->email;
        $contact->name=$req->name;
        $contact->phone=$req->phone;
        $contact->save();
        #to save an update to the database
        return redirect()->back();
    }
    public function delete(Request $req){
        $contact = Contact::find($req->id);
        $contact->delete();
        return redirect()->back();
    }
    public function edit(Request $req){
        $contact = Contact::find($req->id);
        return view('edit')->with("contact",$contact);
    }
    public function update(Request $req){
        $contact = Contact::find($req->id);
        $contact->update([
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
        ]);
        return redirect()->back();
    }
}
