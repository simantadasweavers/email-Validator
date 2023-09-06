<?php

  namespace App\Exports;
  use DB;
  use Maatwebsite\Excel\Concerns\FromCollection;
  use Maatwebsite\Excel\Concerns\WithHeadings;
  use App\Models\Validemails;
  use App\Models\Visitors;


class ExportValidUsers implements FromCollection, WithHeadings {

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
    // $usersData = Validemails::select('id','name','date')->where('clientid','=',$clientID)->get();
    $usersData = Validemails::select('name','date')->where('clientid','=',$clientID)->get();
    return collect($usersData);
   }

}