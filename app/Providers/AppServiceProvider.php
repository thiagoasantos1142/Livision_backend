<?php

namespace App\Providers;

use App\Domain\Video\Contracts\VideoStorageInterface;
use App\Domain\Video\Services\VideoStorageServiceInterface;
use App\Infrastructure\Services\AwsS3VideoStorage;
use App\Infrastructure\Storage\S3VideoStorageService;
use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EventRepositoryInterface;
use App\Infrastructure\Repositories\EventRepository;
use App\Domain\Repositories\CameraRepositoryInterface;
use App\Infrastructure\Repositories\CameraRepository;
use App\Domain\Services\S3ServiceInterface;
use App\Domain\Repositories\CameraVideoRepositoryInterface;
use App\Infrastructure\Repositories\CameraVideoRepository;
use App\Infrastructure\Services\AwsS3Service;
use App\Application\UseCases\Uploads\GenerateUploadUrlUseCase;
use App\Application\UseCases\Uploads\InitiateUploadUseCase;

use App\Infrastructure\Services\CloudFrontSignedUrlService;
use Aws\S3\S3Client;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VideoStorageServiceInterface::class, S3VideoStorageService::class);
        $this->app->bind(VideoStorageInterface::class, AwsS3VideoStorage::class);
        $this->app->bind(CloudFrontSignedUrlService::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(CameraRepositoryInterface::class, CameraRepository::class);
        $this->app->bind(CameraVideoRepositoryInterface::class, CameraVideoRepository::class);
        $this->app->bind(S3ServiceInterface::class, AwsS3Service::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(CameraRepositoryInterface::class, CameraRepository::class);
        $this->app->bind(CameraVideoRepositoryInterface::class, CameraVideoRepository::class);
        $this->app->bind(S3ServiceInterface::class, AwsS3Service::class);
        $this->app->bind(CloudFrontSignedUrlService::class, function ($app) {
            return new CloudFrontSignedUrlService(
                config('aws.cloudfront.key_pair_id'),
                config('aws.cloudfront.private_key'),
                config('aws.cloudfront.domain')
            );
        });
        $this->app->singleton(S3Client::class, function () {
            return new S3Client([
                'version' => 'latest',
                'region' => config('filesystems.disks.s3.region'),
                'credentials' => [
                    'key' => config('filesystems.disks.s3.key'),
                    'secret' => config('filesystems.disks.s3.secret'),
                ],
            ]);
        });

        $this->app->singleton(AwsS3Service::class, function ($app) {
            return new AwsS3Service(
                $app->make(S3Client::class),
                config('filesystems.disks.s3.bucket'),
            );
        });
        $this->app->bind(GenerateUploadUrlUseCase::class, function ($app) {
            return new GenerateUploadUrlUseCase(
                $app->make(AwsS3Service::class),
                config('filesystems.disks.s3.bucket')
            );
        });

        $this->app->bind(InitiateUploadUseCase::class, function ($app) {
            return new InitiateUploadUseCase(
                $app->make(AwsS3Service::class),
                $app->make(CameraRepositoryInterface::class),
                $app->make(CameraVideoRepositoryInterface::class),
                config('filesystems.disks.s3.bucket')
            );
        });

       

       



        
                
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
