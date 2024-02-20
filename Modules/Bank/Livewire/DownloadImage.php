<?php

namespace Modules\Bank\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DownloadImage extends Component
{
    const DOWNLOAD_PRICE = 100000;
    public function render()
    {
        return view('bank::livewire.download');
    }
    public function getListeners()
    {
        return [
            'download' => 'download',
        ];
    }
    public function handleDownload()
    {
        if (!auth()->user()->isVip()) {
            return $this->dispatch('swalConfirm', [
                'title' => 'Bạn đang chưa sử dụng dịch vụ nào, bạn có muốn tiếp tục tải ảnh với giá '. number_format(self::DOWNLOAD_PRICE).' VNĐ?',
                'nameMethod' => 'download',
            ]);
        }
        $this->download();
        return 1;
    }

    public function download()
    {
        $user = auth()->user();
        if ($user->isVip()) {
            return $this->dispatch('download-image');
        }
        else {
            DB::beginTransaction();
            try {
                if ($user->money < self::DOWNLOAD_PRICE) {
                    DB::rollBack();
                    return $this->dispatch('swalError', [
                        'message' => 'Bạn không đủ tiền, vui lòng nạp thêm tiền hoặc mua các gói dịch vụ.'
                    ]);
                }
                $user->update([
                    'money'=> $user->money - self::DOWNLOAD_PRICE,
                ]);
                DB::commit();
                return $this->dispatch('download-image');
            }catch (\Exception $e) {
                return $this->dispatch('swalError', [
                    'message' => 'Đã có lỗi xảy ra.'
                ]);
            }
        }
    }
}
