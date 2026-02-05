<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\UserDashboard;
use App\Models\Panel;
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
    // 1. منع الـ Admin من دخول هاد الصفحة وتوجيهه لصفحة Home
    if (Auth::user()->role === 'admin') {
        return redirect()->route('app.home')->with('error', 'Accès interdit aux administrateurs.');
    }

    // 2. جلب الـ Panels عادي للمستخدمين (Users)
    $panels = Panel::where('active', true)
        ->orderBy('module')
        ->orderBy('category')
        ->get() 
        ->groupBy(['module', 'category']);

    return view('dashboards.create', compact('panels'));
}



   
public function show(Request $request, $type)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $userId = $request->query('user_id');

    if ($user && $user->role === 'admin' && $userId) {
        $targetEmployee = Employee::find($userId);
        if (!$targetEmployee) {
            abort(404, "Utilisateur non trouvé");
        }
    } else {
        $targetEmployee = $user;
    }

    $config = $this->panelsConfig();
    
    // هاد السطر هو لي تبدل:
    // غادي نجمعو كاع الروابط لي كاينين فـ 'sets' أو 'event' ... إلخ
    $panels = [];
    if (isset($config[$type])) {
        foreach ($config[$type] as $deptPanels) {
            // array_merge باش نجمعو الروابط كاملين فـ لستة وحدة
            $panels = array_merge($panels, $deptPanels);
        }
    }

    // (الاختياري) إذا بغيتي تحيد الروابط المعاودة باش ميتكرروش ليك في الصفحة
    $panels = array_unique($panels);

    return view("dashboards.$type", compact('panels', 'type'));
}

// 1. دالة الحفظ (كتستقبل البيانات من JS)
public function saveCustomLayout(Request $request)
{
    try {
        // Laravel كيجيب الـ ID ديال المستخدم اللي فاتح الحساب دابا أوتوماتيكياً
        $userId = Auth::user()->id;

        if (!$userId) {
            return response()->json(['error' => 'Veuillez vous connecter'], 401);
        }

        \App\Models\UserDashboard::create([
            'user_id' => $userId,
            'layout'  => $request->layout,
            'name'    => $request->name,
            'description' => $request->description // حفظ الوصف في الداتابيز
        ]);

        return response()->json(['message' => 'Dashboard enregistré !']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function deleteDashboard($id)
{
    try {
        // كنقلبو على الداشبورد اللي تابع للمستخدم الحالي
        $dashboard = \App\Models\UserDashboard::where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        $dashboard->delete();

        // التوجيه لصفحة الـ Home بعد المسح بنجاح
        return redirect()->route('app.home')->with('success', 'Dashboard supprimé !');
        
    } catch (\Exception $e) {
        return redirect()->route('app.home')->with('error', 'Impossible de supprimer ce dashboard');
    }
}

// 2. دالة عرض الداشبورد الخاص بالمستخدم
public function viewCustom($id)
{
    // جلب الداشبورد بـ ID أو كيعطي 404 إلا مكنش
    $dashboard = \App\Models\UserDashboard::findOrFail($id);

    return view('dashboards.view_custom', compact('dashboard'));
}
}
