<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection, WithHeadings
{
    protected $download_type;

    function __construct($download_type) {
        $this->download_type = $download_type;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->download_type == 'demo'){
            //export all clients and their contacts to excel  
            return Client::with('contacts')
            ->select("clients.*","name", "address","abn","client_number", "client_notes")
            ->latest()->offset(0)->limit(1)
            ->get()
            ->map(function($client) {
                $contacts = $client->contacts->take(5);
                return [
                    'name' => $client->name,
                    'address' => $client->address,
                    'abn' => $client->abn,
                    'client_number' => $client->client_number,
                    'client_notes' => $client->client_notes,
                    'contact_name_1' => $contacts->get(0)->contact_name ?? '',
                    'contact_phone_1' => $contacts->get(0)->contact_phone ?? '',
                    'contact_email_1' => $contacts->get(0)->contact_email ?? '',
                    'is_primary_1' => $contacts->get(0)->is_primary ?? '0',
                    'status_1' => $contacts->get(0)->status ?? '',
                    'contact_name_2' => $contacts->get(1)->contact_name ?? '',
                    'contact_phone_2' => $contacts->get(1)->contact_phone ?? '',
                    'contact_email_2' => $contacts->get(1)->contact_email ?? '',
                    'is_primary_2' => $contacts->get(1)->is_primary ?? '0',
                    'status_2' => $contacts->get(1)->status ?? '',
                    'contact_name_3' => $contacts->get(2)->contact_name ?? '',
                    'contact_phone_3' => $contacts->get(2)->contact_phone ?? '',
                    'contact_email_3' => $contacts->get(2)->contact_email ?? '',
                    'is_primary_3' => $contacts->get(2)->is_primary ?? '0',
                    'status_3' => $contacts->get(2)->status ?? '',
                    'contact_name_4' => $contacts->get(3)->contact_name ?? '',
                    'contact_phone_4' => $contacts->get(3)->contact_phone ?? '',
                    'contact_email_4' => $contacts->get(3)->contact_email ?? '',
                    'is_primary_4' => $contacts->get(3)->is_primary ?? '0',
                    'status_4' => $contacts->get(3)->status ?? '',
                    'contact_name_5' => $contacts->get(4)->contact_name ?? '',
                    'contact_phone_5' => $contacts->get(4)->contact_phone ?? '',
                    'contact_email_5' => $contacts->get(4)->contact_email ?? '',
                    'is_primary_5' => $contacts->get(4)->is_primary ?? '0',
                    'status_5' => $contacts->get(4)->status ?? '',
                ];
            });
        }else{
            //export all clients and their contacts to excel  
            return Client::with('contacts')
            ->select("clients.*","name", "address","abn","client_number", "client_notes")
            ->get()
            ->map(function($client) {
                $contacts = $client->contacts->take(5);
                return [
                    'name' => $client->name,
                    'address' => $client->address,
                    'abn' => $client->abn,
                    'client_number' => $client->client_number,
                    'client_notes' => $client->client_notes,
                    'contact_name_1' => $contacts->get(0)->contact_name ?? '',
                    'contact_phone_1' => $contacts->get(0)->contact_phone ?? '',
                    'contact_email_1' => $contacts->get(0)->contact_email ?? '',
                    'is_primary_1' => $contacts->get(0)->is_primary ?? '0',
                    'status_1' => $contacts->get(0)->status ?? '',
                    'contact_name_2' => $contacts->get(1)->contact_name ?? '',
                    'contact_phone_2' => $contacts->get(1)->contact_phone ?? '',
                    'contact_email_2' => $contacts->get(1)->contact_email ?? '',
                    'is_primary_2' => $contacts->get(1)->is_primary ?? '0',
                    'status_2' => $contacts->get(1)->status ?? '',
                    'contact_name_3' => $contacts->get(2)->contact_name ?? '',
                    'contact_phone_3' => $contacts->get(2)->contact_phone ?? '',
                    'contact_email_3' => $contacts->get(2)->contact_email ?? '',
                    'is_primary_3' => $contacts->get(2)->is_primary ?? '0',
                    'status_3' => $contacts->get(2)->status ?? '',
                    'contact_name_4' => $contacts->get(3)->contact_name ?? '',
                    'contact_phone_4' => $contacts->get(3)->contact_phone ?? '',
                    'contact_email_4' => $contacts->get(3)->contact_email ?? '',
                    'is_primary_4' => $contacts->get(3)->is_primary ?? '0',
                    'status_4' => $contacts->get(3)->status ?? '',
                    'contact_name_5' => $contacts->get(4)->contact_name ?? '',
                    'contact_phone_5' => $contacts->get(4)->contact_phone ?? '',
                    'contact_email_5' => $contacts->get(4)->contact_email ?? '',
                    'is_primary_5' => $contacts->get(4)->is_primary ?? '0',
                    'status_5' => $contacts->get(4)->status ?? '',
                ];
            });
        }
    }

    public function headings(): array
    {
        return ["Name", "Address", "ABN","Client Number","Client Notes", "Contact Name 1", "Contact Phone 1", "Contact Email 1","Is Primary 1","Status 1", "Contact Name 2", "Contact Phone 2","Contact Email 2",
        "Is Primary 2","Status 2","Contact Name 3", "Contact Phone 3", "Contact Email 3","Is Primary 3","Status 3", "Contact Name 4", "Contact Phone 4","Contact Email 4","Is Primary 4","Status 4","Contact Name 5", "Contact Phone 5","Contact Email 5","Is Primary 5","Status 5" ];
    }
}
