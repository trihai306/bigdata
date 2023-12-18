<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Nwidart\Modules\Facades\Module;

class ModulesController extends Controller
{
    public function index(Request $request)
    {
        $modules = Module::all();

        // Chuyển đổi mảng thành collection của Laravel
        $modulesCollection = new Collection($modules);

        // Thiết lập số lượng module trên mỗi trang
        $perPage = 12; // thay đổi số lượng này theo yêu cầu

        // Lấy trang hiện tại
        $currentPage = Paginator::resolveCurrentPage();

        // Cắt phần tử hiện tại của trang hiện tại
        $currentItems = $modulesCollection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Tạo paginator
        $paginator = new LengthAwarePaginator($currentItems, count($modulesCollection), $perPage);

        // Thiết lập url cho từng trang
        $paginator->setPath($request->url());

        // Chuẩn bị mảng trạng thái
        $moduleStatuses = [];
        $enabledCount = 0;
        $disabledCount = 0;

        foreach ($modules as $module) { // Chú ý rằng đây là vòng lặp qua tất cả các module, không chỉ các module của trang hiện tại
            $isEnabled = $module->isEnabled();
            $moduleStatuses[$module->getName()] = $isEnabled ? 'Enabled' : 'Disabled';
            if ($isEnabled) {
                $enabledCount++;
            } else {
                $disabledCount++;
            }
        }

        // Trả về view cùng với dữ liệu đã phân trang và số lượng
        return view('modules::index', [
            'moduleStatuses' => $moduleStatuses,
            'modules' => $paginator,
            'enabledCount' => $enabledCount,
            'disabledCount' => $disabledCount,
        ]);
    }

    public function toggleModule(Request $request, $moduleName) {
        $module = Module::find($moduleName);

        if ($module->isEnabled()) {
            $module->disable();
        } else {
            $module->enable();
        }

        return redirect()->back();
    }
}
