<?php


namespace App\Repositories\Admin\File;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface FileRepositoryInterface
{

    /**
     * ファイルの保存処理
     * @param UploadedFile $file 添付ファイル
     * @param string $path 保存先のパス
     * @return FileData 添付ファイル情報
     */
    public function storeFile(UploadedFile $file, ?string $path = ""): FileData;
    
    /**
     * ファイルをダウンロードする処理（PDFはブラウザ表示, その他はダウンロード）
     *
     * @param string $filePath ファイルパス
     * @param string $fileName ファイル名
     * @return StreamedResponse HTTPレスポンス
     */
    public function downloadFile(string $filePath, string $fileName): StreamedResponse;

    /**
     * 非公開バケットに対して、ファイルへのワンタイムダウンロードURLを生成します
     * @param string $s3FilePath
     * @return string
     */
    public function generateOnetimeUrlForSecret(string $s3FilePath): string;

    /**
     * 報告書の削除
     *
     * @param string $filePath ファイルパス
     * @return bool
     */
    public function deleteFile(string $filePath): bool;

}
