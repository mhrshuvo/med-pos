<?php

namespace App\Observers;

use App\Models\Contact;

class ContactObserver
{

    public function creating(Contact $contact)
    {
        $id = Contact::orderBy('id','desc')->first();
        $latest_id = $id ? $id->id+1 : 1;
        $employee_id = sprintf('%05d', $latest_id);
        $prefix = $contact->contact_type == 1 ? 'CUS-1' : 'SUP-1';
        $contact->contact_id = $prefix.$employee_id;
    }


    public function updated(Contact $contact)
    {
        //
    }

    public function deleted(Contact $contact)
    {
        //
    }

    public function restored(Contact $contact)
    {
        //
    }


    public function forceDeleted(Contact $contact)
    {
        //
    }
}
