<?php


namespace App\Repositories\Admin\File;

/**
 * ファイル保存時にreturnしたい情報をまとめたクラス
 */
class FileData
{
    /**
     * ファイル名
     *
     * @var string
     */
    private string $name;

    /**
     * ファイルパス
     *
     * @var string
     */
    private string $path;

    /**
     * ファイルの拡張子
     *
     * @var string
     */
    private string $extension;


    public function __construct(string $name, string $path, string $extension)
    {
        $this->name = $name;
        $this->path = $path;
        $this->extension = $extension;
    }

    /**
     * ファイル名を取得
     *
     * @return string ファイル名
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * ファイルの保存先パスを取得
     *
     * @return string ファイルパス
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * ファイル拡張子を取得
     *
     * @return string ファイル拡張子
     */
    public function getExtension(): string
    {
        return $this->extension;
    }
}
