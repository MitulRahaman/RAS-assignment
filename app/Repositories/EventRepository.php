<?php

namespace App\Repositories;

use Validator;
use Carbon\Carbon;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\AuthorizationTrait;


class EventRepository
{
    use AuthorizationTrait;
    private $branchId, $participantId, $departmentId;

    public function setBranchId($branchId)
    {
        $this->branchId = $branchId;
        return $this;
    }
    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
        return $this;
    }
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
        return $this;
    }

    public function getDepartments()
    {
        return DB::table('branch_departments')->where('branch_id', '=', $this->branchId)->get();
    }

    public function getParticipants()
    {
        return DB::table('basic_info')->where('department_id', '=', $this->departmentId)->get();
    }

    public function getDeptPartName()
    {
        $departmentName = array();
        foreach ($this->departmentId as $d) {
            $array = DB::table('departments')->select('name')->where('id', '=', $d)->first();
            array_push($departmentName, $array->name);
        }
        $participantName = array();
        foreach ($this->participantId as $p) {
            $array = DB::table('users')->select('full_name')->where('id', '=', $p)->first();
            array_push($participantName, $array->full_name);
        }
        return [$this->departmentId, $departmentName, $this->participantId, $participantName];
    }

    // public function getLeaveTypes($id)
    // {
    //     if($id == null) {
    //         return LeaveType::where('status', Config::get('variable_constants.activation.active'))->get();
    //     } else {
    //         return LeaveType::where('id', '=', $id)->first()->name;
    //     }

    // }

    // public function getTableData()
    // {
    //     $userId = auth()->user()->id;

    //     $isHrSuperUser = $this->setId($userId)->setSlug('manageLeaves')->hasPermission();
    //     $usersUnderLineManager = DB::table('line_managers')->where('line_manager_user_id', '=', $userId)->whereNull('deleted_at')->pluck('user_id')->toArray();
    //     array_push($usersUnderLineManager, $userId);

    //     return DB::table('leaves as l')
    //         ->leftJoin('leave_types as lt', function ($join) {
    //             $join->on('l.leave_type_id', '=', 'lt.id');
    //         })
    //         ->leftJoin('users as u', 'l.user_id', '=', 'u.id')
    //         ->groupBy('l.id')
    //         ->select('l.*', 'lt.id as leave_type_id', 'lt.name', 'u.employee_id', 'u.full_name', 'u.phone_number')
    //         ->orderBy('l.id', 'DESC')
    //         ->when(!$isHrSuperUser, function($query)use ($usersUnderLineManager){
    //             $query->whereIn('l.user_id', $usersUnderLineManager);
    //         })
    //         ->get();

    // }

    // public function getlineManagers()
    // {
    //     return DB::table('line_managers as lm')
    //         ->leftJoin('users as u', function ($join) {
    //             $join->on('lm.user_id', '=', 'u.id')
    //             ->whereNULL('u.deleted_at');
    //         })
    //         ->where('u.employee_id', '=', $this->id)
    //         ->whereNULL('lm.deleted_at')
    //         ->select('u.id as user_id', 'lm.line_manager_user_id')
    //         ->get()
    //         ->toArray();
    // }


    // public function getTotalTakenLeavesPerUser()
    // {
    //     return DB::table('users as u')
    //         ->join('leaves as l', function ($join) {
    //             $join->on('u.id', '=', 'l.user_id')
    //             ->whereNULL('l.deleted_at');
    //         })
    //         ->whereNULL('u.deleted_at')
    //         ->select('u.id as user_id', DB::raw('SUM(total) AS total'))
    //         ->groupBy('l.user_id')
    //         ->orderBy('u.id')
    //         ->get()
    //         ->toArray();
    // }

    // public function getLeaveAppliedEmailRecipient()
    // {
    //     $appliedUser = DB::table('basic_info')->where('user_id', '=', $this->id)->first();
    //     if($appliedUser == null ) {
    //         return false;
    //     }

    //     $getLineManagers  = DB::table('users as u')
    //     ->leftJoin('line_managers as lm', function ($join) {
    //         $join->on('u.id', '=', 'lm.user_id')
    //         ->whereNULL('lm.deleted_at');
    //     })
    //     ->where('lm.user_id', '=', $appliedUser->user_id)
    //     ->select('lm.line_manager_user_id')
    //     ->get()
    //     ->toArray();

    //     $lineManagerEmail = array();
    //     foreach ($getLineManagers as $glm) {
    //         array_push($lineManagerEmail, DB::table('users')->where('id', '=', $glm->line_manager_user_id)->first()->email);
    //     }

    //     $hasManageLeavePermission = DB::table('permissions as p')
    //         ->leftJoin('role_permissions as rp', 'p.id', '=', 'rp.permission_id')
    //         ->leftJoin('basic_info as bi', 'bi.role_id', '=', 'rp.role_id')
    //         ->where('p.slug', '=', 'notifyLeaveApply')
    //         ->where('bi.branch_id', '=', $appliedUser->branch_id)
    //         ->select('rp.role_id')
    //         ->get()
    //         ->toArray();
    //     if($hasManageLeavePermission == null ) {
    //         return false;
    //     }

    //     $recipientEmail = array();
    //     foreach ($hasManageLeavePermission as $hmlp) {
    //         array_push($recipientEmail, DB::table('basic_info')->where('role_id', '=', $hmlp->role_id)->first()->preferred_email);
    //     }
    //     if($recipientEmail == null ) {
    //         return false;
    //     }
    //     return [$lineManagerEmail, $recipientEmail];
    // }

    // public function storeLeaves($data)
    // {
    //     $data['startDate'] = CommonHelper::format_date($data['startDate'], 'd/m/Y', 'Y-m-d');
    //     $data['endDate'] = CommonHelper::format_date($data['endDate'], 'd/m/Y', 'Y-m-d');

    //     try {
    //         DB::beginTransaction();
    //         $leaves = LeaveApply::create([
    //             'user_id' => auth()->user()->id,
    //             'leave_type_id' => $data['leaveTypeId'],
    //             'start_date' => $data['startDate'],
    //             'end_date' => $data['endDate'],
    //             'total' => $data['totalLeave'],
    //             'reason' => $data['reason'],
    //             'status' => Config::get('variable_constants.leave_status.pending')
    //         ]);

    //         if($data['files'] != null) {
    //             foreach ($data['files'] as $attachment) {
    //                 LeaveAttachments::create([
    //                     'leave_id'=>$leaves->id,
    //                     'attachment' => $attachment
    //                 ]);
    //             }
    //         }
    //         DB::commit();
    //         return true;
    //     } catch (\Exception $exception) {
    //         DB::rollBack();
    //         return $exception->getMessage();
    //     }
    // }

    // public function getLeaveInfo()
    // {
    //     return LeaveApply::find($this->id);
    // }

    // public function updateLeave($data)
    // {
    //     $data->startDate = date("Y-m-d", strtotime(str_replace("/","-",$data->startDate)));
    //     $data->endDate = date("Y-m-d", strtotime(str_replace("/","-",$data->endDate)));
    //     if($data->totalLeave == null) {
    //         DB::table('leaves')
    //         ->where('id', '=', $this->id)
    //         ->update([
    //             'leave_type_id' => $data->leaveTypeId,
    //             'start_date' => $$data->startDatee,
    //             'end_date' => $data->endDate,
    //             'reason' => $data->reason,
    //         ]);
    //     } else {

    //         DB::table('leaves')
    //         ->where('id', '=', $this->id)
    //         ->update([
    //             'leave_type_id' => $data->leaveTypeId,
    //             'start_date' => $data->startDate,
    //             'end_date' => $data->endDate,
    //             'total' => $data->totalLeave,
    //             'reason' => $data->reason,
    //         ]);
    //     }
    //     return true;
    // }
    // public function recommendLeave($data, $id)
    // {
    //     return DB::table('leaves')->where('id',$id)->update(['status'=> Config::get('variable_constants.leave_status.line_manager_approval'),
    //         'remarks'=>$data['recommend-modal-remarks']]);
    // }
    // public function approveLeave($data, $id)
    // {
    //     return DB::table('leaves')->where('id',$id)->update(['status'=> Config::get('variable_constants.leave_status.approved'),
    //         'remarks'=>$data['approve-modal-remarks']]);
    // }
    // public function rejectLeave($data, $id)
    // {
    //     return DB::table('leaves')->where('id',$id)->update(['status'=> Config::get('variable_constants.leave_status.rejected'),
    //         'remarks'=>$data['reject-modal-remarks']]);
    // }
    // public function cancelLeave($id)
    // {
    //     return DB::table('leaves')->where('id',$id)->update(['status'=> Config::get('variable_constants.leave_status.canceled')]);
    // }
    // public function delete($id)
    // {
    //     return DB::table('leaves')->where('id', $id)->delete();
    // }
    // public function getReciever($employeeId)
    // {
    //     $appliedUser = DB::table('users')->where('employee_id',$employeeId)->first();
    //     $getLineManagers  = DB::table('users as u')
    //     ->leftJoin('line_managers as lm', function ($join) {
    //         $join->on('u.id', '=', 'lm.user_id')
    //         ->whereNULL('lm.deleted_at');
    //     })
    //     ->where('lm.user_id', '=', $appliedUser->id)
    //     ->select('lm.line_manager_user_id')
    //     ->get()
    //     ->toArray();

    //     $lineManagerEmail = array();
    //     foreach ($getLineManagers as $glm) {
    //         array_push($lineManagerEmail, DB::table('users')->where('id', '=', $glm->line_manager_user_id)->first()->email);
    //     }
    //     return [$lineManagerEmail, $appliedUser->email];
    // }
}

