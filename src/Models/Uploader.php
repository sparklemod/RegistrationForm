<?php

namespace App\Models;

use App\Repository\UserRepository;
use App\Services\DataBase\Doctrine;
use CarrionGrow\Uploader\Exception\Exception;
use CarrionGrow\Uploader\Upload;

class Uploader
{
    private const PATH_RESOURCES = __DIR__ . '/../../resources';
    private const URL_PATH = '/resources';

    public function accountIconUpdate(int $userID)
    {
        $uploadPath = self::PATH_RESOURCES . '/Users_Icons';
        $uploader = new Upload();
        $uploader->getConfigs()->new('filename')->image()
            ->setMaxSize(4096)
            ->setOverwrite(TRUE)
            ->setFileName('avatar' . $userID)
            ->setUploadPath($uploadPath)
            ->setSkipError(TRUE);

        $fileCollection = $uploader->uploadAll();
        $file = $fileCollection->get('filename');

        if ($file instanceof Exception){
            return $file->getMessage();
        }

        $filePath = self::URL_PATH . '/Users_Icons/' . $file->getName();

        $user = (new UserRepository())->find($userID);
        $user->setIcon($filePath);
        Doctrine::getEntityManager()->persist($user);
        Doctrine::getEntityManager()->flush();

        return TRUE;
    }

}