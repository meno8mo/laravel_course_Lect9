<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;



class UsersExport implements  FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
//    public function collection()
//    {
//        return User::all(['id','name','email','status'])
//            ->where('status',1);
//    }
//public function __construct($status)
//{
//   $this->status=$status;
//}
    public function forstatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    public function forYear(int $year)
    {
        $this->year = $year;

        return $this;
    }

    public function query()
    {
        // TODO: Implement query() method.
        return User::query()->select(['id', 'name', 'email'])
            ->whereYear('created_at', $this->year)
            ->where('status', $this->status);
    }


//    public function map($user): array
//    {
//        // TODO: Implement map() method.
//        return [
//            'id'=>$user->id,
//            'name'=>$user->name,
//            'status'=>$user->status==1?"exist":"not exist",
//            'roles'=>$this->getRoleN($user->roles),
//
//
//
//        ];
//    }
//    function getRoleN($roles)
//
//    {
//        $u_roles="";
//        foreach ($roles as $role)
//            $u_roles.=$role->name.' ';
//        return  $u_roles;
//
//    }
//    public function map($invoice): array
//    {
//        return [
//            $invoice->invoice_number,
//            $invoice->user->name,
//            Date::dateTimeToExcel($invoice->created_at),
//        ];
//    }
//    public function view(): View
//    {
//        // TODO: Implement view() method.
//        return view('exports.users', [
//            'users' => User::all()
//        ]);
//    }
}
