<?php

namespace App\Http\Controllers\Admin;

use App\Model\InterestedModelFormSubmit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataTableController extends Controller
{
    public function structuralBreak($request, $object, $data)
    {
        $resultset = [];
        foreach ($data['columns'] as $column) {
            $column_array[] = $column['data'];
        }
        $resultset['totalData'] = $object::count();
        $resultset['totalFiltered'] = $resultset['totalData'];
        $limit = $request->input('length');
        $start = $request->input('start');
        if (empty($request->input('search.value'))) {
            $resultset['data'] = $object::offset($start)
                ->limit($limit)
                ->orderByDesc('id')
                ->get();
            $resultset['totalFiltered'] = $object::count();
        } else {
            $search = $request->input('search.value');

            $resultset['data'] = $object::where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('ticket_id', 'LIKE', "%{$search}%")
                ->orderByDesc('id')
                ->get();
            $resultset['totalFiltered'] = $object::where('id', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('ticket_id', 'LIKE', "%{$search}%")
                ->count();
        }
        return $resultset;
    }

    public function listUser(Request $request)
    {
        $data = $request->all();
        $users = new InterestedModelFormSubmit();
        $res = $this->structuralBreak($request, $users, $data);

        $data = array();
        if (!empty($res['data'])) {
            $pageData = $request->input('start');
            if ($pageData) {
                $count = $pageData + 1;
            } else {
                $count = 1;
            }

            foreach ($res['data'] as $datum) {
                $nestedData['id'] = $datum->id;
                $nestedData['name'] = $datum->name;
                $nestedData['email'] = $datum->email;
                $nestedData['phone'] = $datum->phone;
                $nestedData['ticket_id'] = $datum->ticket_id;
                $data[] = $nestedData;
                $count++;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($res['totalData']),
            "recordsFiltered" => intval($res['totalFiltered']),
            "data" => $data,
        );
        echo json_encode($json_data);
    }
}
