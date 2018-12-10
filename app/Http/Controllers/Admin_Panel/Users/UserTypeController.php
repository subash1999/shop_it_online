<?php

namespace App\Http\Controllers\Admin_Panel\Users;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Admin\AdminHelper;
use App\User;
use App\UserType;
use App\UserTypeRelation;
use DataTables;
use Illuminate\Http\Request;
use URL;

class UserTypeController extends Controller
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
       $admin_name = trim($admin_data["admin_name"]);
       $created_at = trim($admin_data["created_at"]);
       $user_types = UserType::withCount('userTypeRelations')->get();
       return view("admin/sb_admin/admin_pages/admin_users/admin_page_users_user_types",compact('admin_helper','admin_name','created_at','user_types'));
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
        $type = $request->type;
        $user_type = new UserType;
        $user_type->type = $type;
        $user_type->save();
        return "Success addition of ".$type;
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
        $user_type = UserType::findorFail($request->id);
        $result = [
            "previous_value" => trim($user_type->type),
            "changed_value" => trim($request->type),
        ];
        $user_type->type = trim($request->type);
        $user_type->save();

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return "apple";
        $user_type_relations = UserTypeRelation::where('ut_id','=',$id)->get();
        foreach ($user_type_relations as $user_type_relation){
         $user = User::find($user_type_relation->user_id);
         if($user!=null){
            $user->delete();
        }
        $user_type_relation->delete();
    }
    $user_type = UserType::find($id);
    $user_type->delete();
}

public function getUserTypesTable()
{

    $user_types = UserType::withCount('userTypeRelations')->get();
    return DataTables::of($user_types)->addColumn('action',
        function($user_type){
                /*Note :- Both the update and delete url are same
                only the method is different*/
                // This is the url for updating the edited value
                $update_url = URL::to('admin/users/user_types/'.$user_type->ut_id);
                // This is the url for deleting the selected user Type
                $delete_url = URL::to('admin/users/user_types/'.$user_type->ut_id);
                // THe following creates the edit button for the user_types and the second button is for the delete button for the user_types
                // The edit button on click opens the js function  which will open a popup to edit the current admin_type
                // The delete button will open a js function which will open a poup displaying delete confirmation message, if pressed ok the user_type is deleted as well as all the users of that user type
                return '<button type="button" class="btn btn-info btn-sm" style="margin: 2px" 
                value="'.$user_type->ut_id.'" onclick="userTypeEditPopup('.$user_type->ut_id.',\''.strval($user_type->type).'\',\''.strval($update_url).'\')">Edit</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="userTypeDeleteConfirm('.$user_type->ut_id.',\''.strval($user_type->type).'\',\''.strval($delete_url).'\')" value="'.$user_type->ut_id.'">Delete</button>';
            })->make(true);
}
public function undoUserTypeDelete(){
    $user_types = UserType::onlyTrashed()->get();
    foreach ($user_types as $user_type) {
        if($user_type->trashed()){
            // restoring the deleted user type
            $a =    UserType::withTrashed()->find($user_type->ut_id)->restore();
            // restoring the deleted user type relation
            $a=    UserTypeRelation::withTrashed()->where('ut_id','=',$user_type->ut_id)->restore();
                // getting the user type to restore the other users
            $user_type_relations = UserTypeRelation::where('ut_id','=',$user_type->ut_id)->get();
            foreach ($user_type_relations as $user_type_relation){
                $user = User::withTrashed()->find($user_type_relation->user_id)->restore();
            }
        }
    }

}

}
