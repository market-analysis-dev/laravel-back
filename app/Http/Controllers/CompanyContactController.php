<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class CompanyContactController extends ApiController
{
    /**
     * @param Company $company
     * @return ApiResponse
     */
    public function index(Company $company): ApiResponse
    {
        $contacts = CompanyContact::where('company_id', $company->id)
            ->with('contact')
            ->get()
            ->pluck('contact');

        return $this->success(data: $contacts);
    }

    /**
     * @param Company $company
     * @param Contact $contact
     * @return ApiResponse
     */
    public function show(Company $company, Contact $contact): ApiResponse
    {
        $contact = CompanyContact::where('company_id', $company->id)
            ->where('contact_id', $contact->id)
            ->with('contact')
            ->get()
            ->pluck('contact');
        return $this->success(data: $contact);
    }

    /**
     * @param StoreContactRequest $request
     * @param Company $company
     * @return ApiResponse
     */
    public function store(StoreContactRequest $request, Company $company): ApiResponse
    {
        try {
            $contact = Contact::create($request->validated());
            $newContactId = $contact->id;

            CompanyContact::create([
               'company_id' => $company->id,
               'contact_id' => $contact->id,
            ]);
            return $this->success('Contact added successfully', $contact);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param UpdateContactRequest $request
     * @param Company $company
     * @param Contact $contact
     * @return ApiResponse
     */
    public function update(UpdateContactRequest $request, Company $company, Contact $contact): ApiResponse
    {
        try{
            $companyContact = CompanyContact::where('company_id', $company->id)
                ->where('contact_id', $contact->id)
                ->first();
            if($companyContact) {

                $contact->update($request->validated());
                return $this->success('Contact updated successfully', $contact);

            } else {

                return $this->error('Company with id '. $company->id . ' does not have contact with id '. $contact->id , 404);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @param Company $company
     * @param Contact $contact
     * @return ApiResponse
     */
    public function destroy(Company $company, Contact $contact): ApiResponse
    {
        try{
            $companyContact = CompanyContact::where('company_id', $company->id)
                ->where('contact_id', $contact->id)
                ->first();
            if($companyContact) {

                $contact->delete();
                return $this->success('Contact deleted successfully', $contact);

            } else {

                return $this->error('Company with id '. $company->id . ' does not have contact with id '. $contact->id , 404);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
