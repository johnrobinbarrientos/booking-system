<?php

namespace App\Imports;

use Throwable;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClientImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        //saving client first 
        $client = new Client([
            'name' => $row['name'],
            'address' => $row['address'],
            'abn' => $row['abn'],
            'client_number' => $row['client_number'],
            'client_notes' => $row['client_notes'],
        ]);

        $client->save(); // save the client before creating contacts

        //saving contacts
        for ($i = 1; $i <= 5; $i++) {
            $contact_name = $row['contact_name_' . $i];
            $contact_phone = $row['contact_phone_' . $i];
            $contact_email = $row['contact_email_' . $i];
            $is_primary = $row['is_primary_' . $i];
            $status = $row['status_' . $i];

            if (!empty($contact_name) || !empty($contact_phone) || !empty($contact_email)) {
                $contact = new Contact([
                    'contact_name' => $contact_name,
                    'contact_phone' => $contact_phone,
                    'contact_email' => $contact_email,
                    'is_primary' => $is_primary,
                    'status' => $status,
                ]);

                $contact->client_id = $client->id; // set the client_id of the contact to the id of the newly created client
                $contact->save(); // save the contact with the client_id set
            }
        }

        return $client;
    }

    public function rules(): array
    {
        return [
            'contact_email_*' => 'nullable|email|unique:contacts,contact_email',
            'contact_phone_*' => 'nullable|numeric|unique:contacts,contact_phone',
            'is_primary_*' => 'nullable',
            'status_*' => 'nullable',
        ];
    }
}
