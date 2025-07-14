<?php

namespace App\Services;

use App\Repositories\historiesRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class HistoriesService
{
    private $historiesRepository;

    public function __construct(historiesRepository $historiesRepository)
    {
        $this->historiesRepository = $historiesRepository;
    }

    public function getAll(array $fields)
    {
        return $this->historiesRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->historiesRepository->getById($id, $fields ??['*']);
    }

    public function create(array $data)
    {
        if (isset($data['dokumen']) && $data['dokumen'] instanceof UploadedFile) {
            $data['dokumen'] = $this->uploadDokumen($data['dokumen']);
        }

        return $this->historiesRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $fields = ['id', 'dokumen'];

        $histories = $this->historiesRepository->getById($id, $fields);

        if (isset($data['dokumen']) && $data['dokumen'] instanceof UploadedFile) {
            if (!empty($histories->dokumen)) {
                $this->deleteDokumen($histories->dokumen);
            }
            $data['dokumen'] = $this->uploadDokumen($data['dokumen']);
        }

        return $this->historiesRepository->update($id, ($data));
    }

     private function uploadDokumen(UploadedFile $dokumen)
    {
        return $dokumen->store('histories', 'public');
    }

    private function deleteDokumen(string $dokumenPath)
    {
        $relativePath = 'documents/' . basename($dokumenPath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }

}
