<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::orderBy('id', 'DESC')->paginate('10');
        return view('admin.customers.customers', compact('customers'));
    }

    public function status($id)
    {
        $newStatus = 'active';
        $user = User::find($id);
        if($user->status == 'active')
        {
            $newStatus = 'deactive';
        }
        $user->update(['status' => $newStatus]);
        return 'true';
    }
}
