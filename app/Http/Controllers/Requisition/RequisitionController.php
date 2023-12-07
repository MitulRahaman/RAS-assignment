<?php

namespace App\Http\Controllers\Requisition;

use App\Http\Requests\RequisitionEditRequest;
use App\Http\Requests\RequisitionAddRequest;
use App\Services\RequisitionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Traits\AuthorizationTrait;

class RequisitionController extends Controller
{
    use AuthorizationTrait;
    private $requisitionService;

    public function __construct(RequisitionService $requisitionService)
    {
        $this->requisitionService = $requisitionService;
        View::share('main_menu', 'Requisition');
    }
    public function index()
    {
        View::share('sub_menu', 'Manage');
        return view('backend.pages.requisition.index');
    }
    public function fetchData()
    {
        return $this->requisitionService->fetchData();
    }
    public function create()
    {
        abort_if(!$this->setSlug('requestRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        View::share('sub_menu', 'Request');
        $assetType=$this->requisitionService->getAllAssetType();
        return \view('backend.pages.requisition.create', compact('assetType'));
    }
    public function store(RequisitionAddRequest $request)
    {
        abort_if(!$this->setSlug('requestRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
            $requisition = $this->requisitionService->create($request->validated(),$request);
            if(!$requisition)
                return redirect('requisition')->with('error', 'Failed to Request');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect('/requisition')->with('success', 'Requested successfully');
    }
    public function edit($id)
    {
        abort_if(!$this->setSlug('editRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        View::share('sub_menu', 'Manage');
        $requisition_request = $this->requisitionService->getRequisitionRequest($id);
        if($requisition_request && !is_null($requisition_request->deleted_at))
            return redirect()->back()->with('error', 'Restore first');
        $assetType=$this->requisitionService->getAllAssetType();
        return \view('backend.pages.requisition.edit',compact('requisition_request', 'assetType'));
    }
    public function update(RequisitionEditRequest $request)
    {
        abort_if(!$this->setSlug('editRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
            $requisition = $this->requisitionService->update($request->validated());
            if(!$requisition)
                return redirect('requisition')->with('error', 'Failed to update request');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
        return redirect('/requisition')->with('success', 'Request updated successfully');
    }
    public function delete($id)
    {
        abort_if(!$this->setSlug('manageRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
            $this->requisitionService->delete($id);
            return redirect()->back()->with('success', 'Request deleted');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function approve($id)
    {
        abort_if(!$this->setSlug('manageRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
                $this->requisitionService->approve($id);
                return redirect()->back()->with('success', 'Request approved');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function reject( $id)
    {
        abort_if(!$this->setSlug('manageRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
                $this->requisitionService->reject($id);
                return redirect()->back()->with('success', 'Request rejected');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function cancel($id)
    {
        abort_if(!$this->setSlug('manageRequisition')->hasPermission(), 403, 'You don\'t have permission!');
        try {
            $this->requisitionService->cancel($id);
            return redirect()->back()->with('success', 'Request canceled');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
