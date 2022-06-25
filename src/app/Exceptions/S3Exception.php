<?php

namespace App\Exceptions;

use App\Exceptions\Base\ResponsibleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class S3Exception extends ResponsibleException
{
    public const CODE_FAILED_TO_CONNECT = 'failed_to_connect';
    public const CODE_UPLOAD_FAILED = 'failed_to_upload_file';
    public const CODE_DELETE_FAILED = 'failed_to_delete_file';

    public function __construct(
        string $errorCode,
        ?string $message = null,
        ?Throwable $previous = null
    )
    {
        parent::__construct(
            $errorCode,
            $message,
            $previous
        );
    }

    /**
     * @inheritDoc
     */
    protected function getJsonResponse(Request $request): JsonResponse
    {
        return response()
            ->json([
                'message' => $this->message,
                'code'    => $this->getErrorCode(),
            ], Response::HTTP_SERVICE_UNAVAILABLE);
    }

    /**
     * @inheritDoc
     */
    protected function getHttpResponse(Request $request)
    {
        return back()
            ->withInput()
            ->with('alert_error', $this->message);
    }
}
