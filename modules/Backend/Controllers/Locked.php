<?php
namespace Modules\Backend\Controllers;

use CodeIgniter\I18n\Time;
use JasonGrimes\Paginator;
use MongoDB\BSON\Regex;


class Locked extends BaseController
{
    public $lockedModel;

    public function index()
    {
        $filterData = [];
        if(!empty($this->request->getGet())){
            $clearData = clearFilter($this->request->getGet());
            $dates = explode(" - ", $clearData['date_range']);

            $locked_at = Time::createFromFormat('Y-m-d H:i:s', new Time($dates[0]),'Europe/Istanbul')->toLocalizedString();
            $expiry_date = Time::createFromFormat('Y-m-d H:i:s', new Time($dates[1]),'Europe/Istanbul')->toLocalizedString();

            $filterData = [
                'username' => (isset($clearData['email'])) ? new Regex($clearData['email'],'i') : null,
                'ip_address' => (isset($clearData['ip'])) ? new Regex($clearData['ip'],'i'): null,
                'isLocked' =>(isset($clearData['status'])) ? (bool)$clearData['status'] : null,
                'locked_at' =>['$gte' => $locked_at],
                'expiry_date' =>['$lte' => $expiry_date],
            ];
            $filterData = clearFilter($filterData);
        }
        $totalItems = $this->commonModel->count('locked',$filterData);
        $itemsPerPage = 10;
        $currentPage = $this->request->uri->getSegment(3, 1);
        $urlPattern = '/backend/locked/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;

        //dd($clearData);
        $this->defData = array_merge($this->defData, [
            'paginator' => $paginator,
            'locks' => $this->commonModel->getList('locked', $filterData , ['limit' => $itemsPerPage, 'skip' => $bpk]),
            'totalCount' => $totalItems,
            'filteredData' => $clearData ?? null,
        ]);
        return view('Modules\Backend\Views\logs\locked', $this->defData);
    }
}
