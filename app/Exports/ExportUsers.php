<?php

  namespace App\Exports;

  use DB;

  use Maatwebsite\Excel\Concerns\FromCollection;

  use Maatwebsite\Excel\Concerns\WithHeadings;

  use App\Models\Invalidemails;
  use App\Models\Visitors;


class ExportUsers implements FromCollection, WithHeadings {

   public function headings(): array {
    return [
        // "ENROLL NO",
        "EMAIL",
         "SUBMITTED AT"
       ];
    }

   public function collection(){
    $visitormail = session()->get('visitormail');
    
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    // $usersData = Invalidemails::select('id','name','date')->where('clientid','=',$clientID)->get();
    $usersData = Invalidemails::select('name','date')->where('clientid','=',$clientID)->get();
   return collect($usersData);
   }

}