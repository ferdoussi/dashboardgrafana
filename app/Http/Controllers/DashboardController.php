<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\UserDashboard;
use App\Models\Panel;
use App\Notifications\SystemNotification;



class DashboardController extends Controller
{
    // هاد function كتخزن جميع panels حسب type و departement
    private function panelsConfig()
    {
        return [
            'sets' => [
                   'Sécurité' => [
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light', // div1
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-2&theme=light', // div2
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-5&theme=light', // div4
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-3&theme=light', // div3
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&from=1348244570271&to=1753721597314&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true', // div6
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-1&theme=light', // div5
                    
                 ],
                 'Informatique'=>[
                    'http://192.168.1.14:3000/d-solo/anh2ldw/dashboard-sets?orgId=1&panelId=panel-6&theme=light', // div1
                 ]
            ],
            'event' => [
                'Sécurité' => [
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-2&__feature.dashboardSceneSolo=true', // div1
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-5&__feature.dashboardSceneSolo=true', // div3
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-6&__feature.dashboardSceneSolo=true', // div4
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true', // div5
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true', // div6
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-7&__feature.dashboardSceneSolo=true', // div7
                    'http://192.168.1.14:3000/d-solo/anl5cv5/dashboard-des-events?orgId=1&from=1766041772583&to=1766063372583&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true', // div8
            ],
            
            ],
            'rules' =>[
                'Sécurité' =>[
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=2&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=3&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=6&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=1&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=10&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=9&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=7&theme=light&kiosk',
                    'http://192.168.1.14:3000/d-solo/ankhxgg/dashboard-rules?orgId=1&panelId=4&theme=light&kiosk',

                ]
                ],
            'saved-search' => [
                'Sécurité' => [
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-2&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766976676883&to=1766998276883&timezone=browser&tab=transformations&theme=light&panelId=panel-8&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-5&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-6&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766976395293&to=1766997995293&timezone=browser&tab=transformations&theme=light&panelId=panel-7&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/anr5qfw/dashboard-saved-search?orgId=1&from=1766973152187&to=1766994752187&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true',
            ],
        ],
        'offenses' => [
                'Sécurité' => [
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765773121307&to=1765794721307&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-7&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-5&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1765530496414&to=1765552096414&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1766392055968&to=1766413655968&timezone=browser&theme=light&panelId=panel-9&__feature.dashboardSceneSolo=true',
                    'http://192.168.1.14:3000/d-solo/adkwh5h/dashboard-des-offenses?orgId=1&from=1766392055968&to=1766413655968&timezone=browser&theme=light&panelId=panel-2&__feature.dashboardSceneSolo=true',
                ]
                ],
        'offenses-map'=>[
            'Sécurité'=>[
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-4&__feature.dashboardSceneSolo=true",
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-5&__feature.dashboardSceneSolo=true",
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-6&__feature.dashboardSceneSolo=true" ,
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-7&__feature.dashboardSceneSolo=true",
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-1&__feature.dashboardSceneSolo=true",
                "http://192.168.1.14:3000/d-solo/anxc428/geomap?orgId=1&from=1768185857181&to=1768207457181&timezone=browser&theme=light&panelId=panel-3&__feature.dashboardSceneSolo=true"
            ]
        ]
    

        ];
    }
public function create()
{
    $employee = Auth::user();

    // منع Admin global من دخول هاد الصفحة
    if ($employee->role === 'admin') {
        return redirect()->route('app.home')->with('error', 'Accès interdit aux administrateurs.');
    }

    // Users عاديين و Admin Client
    $query = Panel::where('active', true)->orderBy('module')->orderBy('category');

    // إلا كان admin_client => show فقط panels ديال client ديالو
    if ($employee->role === 'admin_client') {
        $query->where('client_id', $employee->client_id);
    }

    $panels = $query->get()->groupBy(['module', 'category']);

    return view('dashboards.create', compact('panels'));
}



   
public function show(Request $request, $type)
{
    $user = Auth::user();
    $userId = $request->query('user_id');

    // Admin global يقدر يشوف dashboards ديال أي Employee
    if ($user->role === 'admin' && $userId) {
        $targetEmployee = Employee::findOrFail($userId);
    } else {
        $targetEmployee = $user;
    }

    // منع عرض dashboards ديال clients آخرين ل non-admin
    if ($user->role !== 'admin' && $targetEmployee->client_id !== $user->client_id) {
        abort(403, "Accès interdit à ce dashboard");
    }

    $config = $this->panelsConfig();
    
    $panels = [];
    if (isset($config[$type])) {
        foreach ($config[$type] as $deptPanels) {
            $panels = array_merge($panels, $deptPanels);
        }
    }

    $panels = array_unique($panels);

    return view("dashboards.$type", compact('panels', 'type'));
}


// 1. دالة الحفظ (كتستقبل البيانات من JS)
public function saveCustomLayout(Request $request)
{
    try {
        $user = Auth::user();

        // 1. التأكد من أن المستخدم مسجل الدخول
        if (!$user) {
            return response()->json(['error' => 'Veuillez vous connecter'], 401);
        }

        // 2. تسجيل الداشبورد مع ربطه بالشركة (Client)
        // ملاحظة: تأكد أن client_id موجود في $fillable داخل موديل UserDashboard
        $newDashboard = \App\Models\UserDashboard::create([
            'user_id'     => $user->id,
            'client_id'   => $user->client_id, // كياخد الـ ID ديال شركتو أوتوماتيكياً
            'layout'      => $request->layout,
            'name'        => $request->name,
            'description' => $request->description
        ]);
        // جلب admins و superadmin ديال نفس client
$admins = Employee::where('client_id', $user->client_id)
                  ->whereIn('role', ['admin','superadmin'])
                  ->get();

$message = "User {$user->name} created a new dashboard: {$request->name}";
$icon = "bx-layout";

foreach ($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}


        return response()->json([
            'message' => 'Dashboard enregistré !',
            'dashboard_id' => $newDashboard->id
        ]);

    } catch (\Exception $e) {
        // في حالة وقع خطأ (مثلاً عمود ناقص في القاعدة)
        return response()->json(['error' => 'Erreur: ' . $e->getMessage()], 500);
    }
}
public function deleteDashboard($id)
{
    if (Auth::user()->role !== 'admin_client') {
        abort(403);
    }

    $dashboard = \App\Models\UserDashboard::where('id', $id)
        ->where('client_id', Auth::user()->client_id)
        ->firstOrFail();

    $dashboard->delete();
    $admins = Employee::where('client_id', Auth::user()->client_id)
                  ->whereIn('role', ['admin','superadmin'])
                  ->get();

$message = "User " . Auth::user()->name . " deleted a dashboard";
$icon = "bx-trash";

foreach ($admins as $admin) {
    $admin->notify(new SystemNotification($message, $icon, $admin->client_id));
}

    return back()->with('success', 'Dashboard supprimé !');
}

// 2. دالة عرض الداشبورد الخاص بالمستخدم
public function viewCustom($id)
{
    // جلب الداشبورد بـ ID أو كيعطي 404 إلا مكنش
    $dashboard = \App\Models\UserDashboard::findOrFail($id);

    return view('dashboards.view_custom', compact('dashboard'));
}
}
