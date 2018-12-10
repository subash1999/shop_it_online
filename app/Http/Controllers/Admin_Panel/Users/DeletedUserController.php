<?php

namespace App\Http\Controllers\Admin_Panel\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Admin\AdminHelper;
use App\User;
use App\UserType;
use App\UserTypeRelation;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DeletedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $admin_helper = new AdminHelper();
        //we have to check if the user is logined and if it is an admin
     $admin_data = $admin_helper->getLoginedAdmin();
     $admin_name = $admin_data["admin_name"];
     $created_at = $admin_data["created_at"];
     // $users = User::with('userTypeRelations.userType')->get();
     //array_push($a,$users[0]->userTypeRelations[0]->userType);
     //return ($a[0]->userTypeRelations[0]->userType);
     // return DataTables::of($a);
     $users  = User::with('userTypeRelations.userType')->get();
     return view("admin/sb_admin/admin_pages/admin_users/admin_page_users_deleted_users",compact('admin_helper','admin_name','created_at','users'));
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getDeletedUsersTable()
    {
        $users = User::with('withTrashedUserTypeRelations.userType')->onlyTrashed()->orderBy('username')->get();
        return DataTables::of($users)->addColumn('action',
            function($user){

                /*Note :- Both the update and delete url are same
                only the method is different*/
                // This is the url for deleting the selected user Type
                $restore_url = URL::to('admin/users/deleted_users/restore_deleted_user_'.$user->user_id);
                
                // The delete button will open a js function which will open a poup displaying delete confirmation message, if pressed ok the selected user is deleted as well as all the users of that user type
                return '<button type="button" class="btn btn-primary btn-sm" onclick="userRestoreConfirm('.$user->user_id.',\''.strval($user->username).'\',\''.strval($restore_url).'\')" value="'.$user->user_id.'">Restore</button>';
            })->addcolumn('user_type',function ($user)
            {
                $i=0;
                $types='';
                foreach($user->withTrashedUserTypeRelations as $user_type_relation){
                    if($i!=0){
                        $types=$types.', ';
                    }
                    $types = $types.$user_type_relation->userType->type;
                    $i++;
                }
                return $types;
            })->addcolumn('s.n',function ($user) use ($users)
            {               
                $a=0;
                foreach ($users as $single_user) {
                    $a++;
                    if($single_user==$user){
                        break;
                    }
                }
                return $a;
            })->make(true);
        }

        public function restoreDeletedUser($id)
        {
        // return "apple";
            $users = User::with('withTrashedUserTypeRelations')->where('user_id','=',$id)->withTrashed()->get();

            foreach ($users as $user){         
             if($user!=null){
                foreach($user->withTrashedUserTypeRelations as $user_type_relation){
                    $user_type_relation->restore();
                }
                $user->restore();
            }        
        }

    }
}
