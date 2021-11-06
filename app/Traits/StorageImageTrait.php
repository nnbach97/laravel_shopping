<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
  public function storageTraitUpload($request, $fieldName, $forderName)
  {

    if (!$request->hasFile($fieldName)) {
      return null;
    }

    $file = $request->$fieldName;
    $fileNameOrigin = $file->getClientOriginalName(); // Get name img gốc
    $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
    $path = $request->$fieldName->storeAs(
      'public/' . $forderName . '/' . auth()->user()->id,
      $fileNameHash
    );

    $dataUpload = [
      'file_name' => $fileNameOrigin,
      'file_path' => Storage::url($path)
    ];
    return $dataUpload;
  }

  // Xu ly nhieu anh
  public function storageTraitUploadMulti($file, $forderName)
  {
    $fileNameOrigin = $file->getClientOriginalName(); // Get name img gốc
    $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs(
      'public/' . $forderName . '/' . auth()->user()->id,
      $fileNameHash
    );

    $dataUpload = [
      'image_name' => $fileNameOrigin,
      'image_path' => Storage::url($path)
    ];
    return $dataUpload;
  }
}
