<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }
}
