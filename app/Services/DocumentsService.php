<?php

namespace App\Services;

use App\Repositories\DocumentsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class DocumentsService
{
    private $documentsRepository;

    public function __construct(documentsRepository $documentsRepository)
    {
        $this->documentsRepository = $documentsRepository;
    }
    public function getAll(array $fields)
    {
        return $this->documentsRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->documentsRepository->getById($id, $fields ??['*']);
    }

    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->documentsRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $fields = ['id', 'photo'];

        $documents = $this->documentsRepository->getById($id, $fields);

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            if (!empty($documents->photo)) {
                $this->deletePhoto($documents->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->documentsRepository->update($id, ($data));
    }

     public function delete(int $id)
    {
        $fields = ['id', 'photo'];

        $documents = $this->documentsRepository->getById($id, $fields);

        if ($documents->photo) {
            $this->deletePhoto($documents->photo);
        }

        $this->documentsRepository->delete($id);
    }

    private function uploadPhoto(UploadedFile $photo)
    {
        return $photo->store('documents', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'documents/' . basename($photoPath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
