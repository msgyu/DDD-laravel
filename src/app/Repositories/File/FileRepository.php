<?php


namespace App\Repositories\Admin\File;

use App\Exceptions\S3Exception;
use App\Repositories\Admin\File\FileData;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileRepository implements FileRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function storeFile(UploadedFile $file, ?string $path = "", ?string $disk = 'default'): FileData
    {
        try {
            $storedFile = Storage::disk($disk)->putFile($path, $file);
        } catch (S3Exception $e) {
            throw new S3Exception(S3Exception::CODE_FAILED_TO_CONNECT, null, $e);
        }

        if ($storedFile === false) {
            throw new S3Exception(S3Exception::CODE_UPLOAD_FAILED, trans('message.error.s3.failed_to_upload'));
        }
        
        $fileName = $file->getClientOriginalName();
        $filePath = Storage::path($storedFile);
        
        if( in_array(config('filesystems.default'), ["public", "local"]) ) {
            $filePath = $storedFile;
        }

        $fileData = new FileData(
                        $fileName,
                        $filePath,
                        $file->extension(),
                    );

        return  $fileData;
    }

    /**
     * @inheritDoc
     */
    public function downloadFile(string $filePath, string $fileName): StreamedResponse
    {
        
        $mimeType = Storage::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        
        if($mimeType = 'application/pdf') {
            try {
                return Storage::response($filePath, $fileName, $headers, 'inline'); // PDFをDLせず、プレビューして表示
            } catch (S3Exception $e) {
                throw new S3Exception(S3Exception::CODE_FAILED_TO_CONNECT, null, $e);
            }            
        }

        try {
            return Storage::response($filePath, $fileName, $headers, 'attachment'); // ファイルをDLする
        } catch (S3Exception $e) {
            throw new S3Exception(S3Exception::CODE_FAILED_TO_CONNECT, null, $e);
        }

    }

    /**
     * @inheritdoc
     */
    public function generateOnetimeUrlForSecret(string $filePath, ?string $desk = "default"): string
    {
        return Storage::disk($desk)->temporaryUrl($filePath, now()->addSeconds(10));
    }

    


    /**
     * @inheritDoc
     */
    public function deleteFile(string $filePath, ?string $disk = 'default'): bool
    {
        try {
            return Storage::disk($disk)->delete($filePath);
        } catch (S3Exception $e) {
            throw new S3Exception(S3Exception::CODE_FAILED_TO_CONNECT, null, $e);
        }
    }
}
