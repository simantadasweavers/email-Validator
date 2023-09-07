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
    if(session()->get('visitormail')){
      $visitormail = session()->get('visitormail');
    $clientID = Visitors::select('enrollno')->where('email','=',$visitormail)
    ->first()->enrollno;
    $usersData = Invalidemails::select('name','date')->where('clientid','=',$clientID)->get();
   return collect($usersData);
    }else{
    return redirect('/');
    }
   }

}