<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\BankAccountController;
use App\Models\AdministrativeTask;
use App\Models\BankAccount;
use App\Models\ClientBankAccount;
use App\Models\DocumentsAdministrative;
use App\Models\EmployeesBankAccount;
use App\Models\OwnerBankAccount;
use App\Models\PartnerBankAccount;
use App\Models\ProviderBankAccount;
use App\Models\RealEstateBankAccount;
use App\Models\RealtyAttachment;
use App\Models\RealtyMedia;
use App\Models\RouterS3;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class Utils
{
    public static function buildReturnSuccess()
    {
        return response()->json([
            'success' => true
        ]);
    }

    public static function buildReturnSuccessStatement($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public static function buildReturnSuccessStatementArray($data, $arrayName, $array)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            $arrayName => $array
        ]);
    }

    public static function buildReturnSuccessStatementUpload($data, $arrayFail)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'uploadFail' => $arrayFail
        ]);
    }

    public static function buildReturnErrorStatement($exception)
    {
        return response()->json([
            'success' => false,
            'msg' => $exception
        ], 500);
    }

    public static function validExtensionToUpload($extension, $enumTypeClass)
    {
        try {
            switch ($enumTypeClass) {
                case RouterS3::ADMINISTRATIVES_DOCUMENTS:
                    return Utils::validExtensionAttachment($extension);
                case RouterS3::REALTY_MEDIA:
                    return Utils::validExtensionImage($extension);
                case RouterS3::REALTY_ATTACHMENT:
                    return Utils::validExtensionAttachment($extension);
                case RouterS3::REALESTATE_CRECI:
                    return Utils::validExtensionImage($extension);
                case RouterS3::PARTNER_CRECI:
                    return Utils::validExtensionImage($extension);
                case BankAccount::RealEstateBankAccount:
                    break;
                default:
            };
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public static function validExtensionImage($extension)
    {
        if ($extension == 'png' || $extension == 'jpeg' || $extension == 'jpg')
            return true;
        return false;
    }

    public static function validExtensionAttachment($extension)
    {
        if ($extension == 'txt' || $extension == 'doc' || $extension == 'pdf' || $extension == 'ppt' || $extension == 'jpg' | $extension == 'xlsm' | $extension == 'xml' | $extension == 'csv' | $extension == 'png')
            return true;
        return false;
    }

    /**
     *
     * $keyname é o parametro usado para identificar o arquivo no S3. (É possível criar diretorios a partir dele.)
     * $file é o arquivo a ser subido.
     * $acl são palavras chaves de permissões que podem ser encontradas em:
     * https://docs.aws.amazon.com/pt_br/AmazonS3/latest/dev/acl-overview.html DEZ/2020
     *
     */

    public static function uploadFileToS3($keyname, $file, $acl)
    {
        $bucket = env('AWS_BUCKET_REALTY');

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'sa-east-1'
        ]);

        try {
            // Upload data.
            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key'    => $keyname,
                'Body'   => $file,
                //'ACL'    => $acl
            ]);

            // Print the URL to the object.
            return Utils::buildReturnSuccessStatement($result['ObjectURL'] . PHP_EOL);
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage() . PHP_EOL);
        }
    }

    public static function destroyFileToS3($keyname)
    {
        $bucket = env('AWS_BUCKET_REALTY');

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'sa-east-1'
        ]);

        try {
            // Dekete data.
            $result = $s3->deleteObject([
                'Bucket' => $bucket,
                'Key'    => $keyname,
                //'ACL'    => $acl
            ]);

            return Utils::buildReturnSuccessStatement($result['ObjectURL'] . PHP_EOL);
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage() . PHP_EOL);
        }
    }

    public static function destroyFolderToS3($keyname)
    {
        $bucket = env('AWS_BUCKET_REALTY');

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'sa-east-1'
        ]);

        try {
            return Utils::buildReturnSuccess($s3->deleteMatchingObjects($bucket, $keyname));
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage() . PHP_EOL);
        }
    }

    public static function createBankForClass($bankAccounts, $enumTypeBank, $idUserTypeBank)
    {
        try {
            $newbankAccounts = [];
            foreach ($bankAccounts as $bankAccount) {
                $newbankAccount = new BankAccountController;

                switch ($enumTypeBank) {
                    case BankAccount::ClientBankAccount:
                        //Caso tenha o id de um banco existente passado por parametro, ele cria um vinculo, caso nao tenha e criado um novo banco e vinculado ao registro
                        isset($bankAccount['bank_account_id']) ?
                            array_push($newbankAccounts, ClientBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $bankAccount['bank_account_id'], 'client_id' => $idUserTypeBank])))
                            : array_push($newbankAccounts, ClientBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'client_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::EmployeesBankAccount:
                        isset($bankAccount['bank_account_id']) ?
                            array_push($newbankAccounts, EmployeesBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $bankAccount['bank_account_id'], 'employee_id' => $idUserTypeBank])))
                            : array_push($newbankAccounts, EmployeesBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'employee_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::OwnerBankAccount:
                        isset($bankAccount['bank_account_id']) ?
                            array_push($newbankAccounts, OwnerBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $bankAccount['bank_account_id'], 'owner_id' => $idUserTypeBank])))
                            : array_push($newbankAccounts, OwnerBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'owner_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::PartnerBankAccount:
                        array_push($newbankAccounts, PartnerBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'partner_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::ProviderBankAccount:
                        isset($bankAccount['bank_account_id']) ?
                            array_push($newbankAccounts, ProviderBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $bankAccount['bank_account_id'], 'provider_id' => $idUserTypeBank])))
                            : array_push($newbankAccounts, ProviderBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'provider_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::RealtorBankAccount:
                        isset($bankAccount['bank_account_id']) ?
                            array_push($newbankAccounts, ProviderBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $bankAccount['bank_account_id'], 'realtor_id' => $idUserTypeBank])))
                            : array_push($newbankAccounts, ProviderBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'realtor_id' => $idUserTypeBank])));
                        break;
                    case BankAccount::RealEstateBankAccount:
                        array_push(RealEstateBankAccount::create(array_merge($bankAccount, ['bank_account_id' => $newbankAccount->storeGetById($bankAccount), 'real_estate_branches_id' => $idUserTypeBank])));
                        break;
                    default:
                }
            };
            return Utils::buildReturnSuccessStatement($newbankAccounts);
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public static function updateBankForClass($bankAccounts, $enumTypeBank)
    {
        try {
            $newbankAccounts = [];
            foreach ($bankAccounts as $bankAccount) {

                switch ($enumTypeBank) {
                    case BankAccount::ClientBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['client_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::EmployeesBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['employee_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::OwnerBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['owner_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::PartnerBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['partner_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::ProviderBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['provider_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::RealtorBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['realtor_bank_account'])->first()->update($bankAccount));
                        break;
                    case BankAccount::RealEstateBankAccount:
                        array_push($newbankAccounts, BankAccount::where('id', $bankAccount['realestate_bank_account'])->first()->update($bankAccount));
                        break;
                    default:
                }
            };
            return Utils::buildReturnSuccessStatement($newbankAccounts);
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public static function uploadFilesToS3($object, $medias, $enumTypeClass)
    {
        try {
            $fileErro = [];
            foreach ($medias as $media) {
                switch ($enumTypeClass) {
                    case RouterS3::REALTY_MEDIA:
                        $nameFile = $media->getClientOriginalName();
                        $url = RouterS3::REALTY_MEDIA . '/' . $object->id . '/' . $nameFile;
                        if (!Utils::validExtensionToUpload($media->getClientOriginalExtension(), RouterS3::REALTY_MEDIA)) {
                            array_push($fileErro, $nameFile);
                        } else {
                            $resp = Utils::uploadFileToS3($url, $media, 'FULL_CONTROL');
                            if (!$resp->original['success']) {
                                array_push($fileErro, $nameFile);
                            } else {
                                RealtyMedia::create(['realty_id' => $object->id, 'directory' => $nameFile]);
                            }
                        }
                        break;
                    case RouterS3::REALTY_ATTACHMENT:
                        $nameFile = $media->getClientOriginalName();
                        $url = RouterS3::REALTY_ATTACHMENT . '/' . $object->realty_id . '/' . $nameFile;
                        if (!Utils::validExtensionToUpload($media->getClientOriginalExtension(), RouterS3::REALTY_ATTACHMENT)) {
                            array_push($fileErro, $nameFile);
                        } else {
                            $resp = Utils::uploadFileToS3($url, $media, 'FULL_CONTROL');
                            if (!$resp->original['success']) {
                                array_push($fileErro, $nameFile);
                            } else {
                                RealtyAttachment::create(['realty_id' => $object->realty_id, 'directory' => $nameFile]);
                            }
                        }
                        break;
                    case RouterS3::ADMINISTRATIVES_DOCUMENTS:
                        $nameFile = $media->getClientOriginalName();
                        $url = RouterS3::ADMINISTRATIVES_DOCUMENTS . '/' . $object->id . '/' . $nameFile;
                        if (!Utils::validExtensionToUpload($media->getClientOriginalExtension(), RouterS3::ADMINISTRATIVES_DOCUMENTS)) {
                            array_push($fileErro, $nameFile);
                        } else {
                            $resp = Utils::uploadFileToS3($url, $media, 'FULL_CONTROL');
                            if (!$resp->original['success']) {
                                array_push($fileErro, $nameFile);
                            } else {
                                DocumentsAdministrative::create(['administrative_tasks_id' => $object->id, 'directory' => $nameFile]);
                            }
                        }
                        break;
                    case RouterS3::PARTNER_CRECI:
                        $nameFile = $media->getClientOriginalName();
                        $url = RouterS3::PARTNER_CRECI . '/' . $object->id . '/' . $nameFile;
                        if (!Utils::validExtensionToUpload($media->getClientOriginalExtension(), RouterS3::PARTNER_CRECI)) {
                            array_push($fileErro, $nameFile);
                        } else {
                            $resp = Utils::uploadFileToS3($url, $media, 'FULL_CONTROL');
                            if (!$resp->original['success']) {
                                array_push($fileErro, $nameFile);
                            } else {
                                $object->creci_data = $nameFile;
                                $object->save();
                            }
                        }
                        break;
                    case RouterS3::REALESTATE_CRECI:
                        $nameFile = $media->getClientOriginalName();
                        $url = RouterS3::REALESTATE_CRECI . '/' . $object->id . '/' . $nameFile;
                        if (!Utils::validExtensionToUpload($media->getClientOriginalExtension(), RouterS3::REALESTATE_CRECI)) {
                            array_push($fileErro, $nameFile);
                        } else {
                            $resp = Utils::uploadFileToS3($url, $media, 'FULL_CONTROL');
                            if (!$resp->original['success']) {
                                array_push($fileErro, $nameFile);
                            } else {
                                $object->creci_data = $nameFile;
                                $object->save();
                            }
                        }
                        break;
                    case BankAccount::RealEstateBankAccount:
                        break;
                    default:
                }
            };
            return $fileErro;
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    public static function destroyFilesToS3(mixed $object, $medias, $enumTypeClass)
    {
        try {
            $imageErro = [];
            foreach ($medias as $media) {
                switch ($enumTypeClass) {
                    case RouterS3::REALTY_MEDIA:
                        $realtyMedia = RealtyMedia::find($media);
                        $url = RouterS3::REALTY_MEDIA . '/' . $object->id . '/' . $realtyMedia->directory;
                        $resp = Utils::destroyFileToS3($url);
                        if (!$resp->original['success']) {
                            array_push($imageErro, $url);
                        } else {
                            RealtyMedia::destroy($media);
                        }
                        break;
                    case RouterS3::REALTY_ATTACHMENT:
                        $url = RouterS3::REALTY_ATTACHMENT . '/' . $media->realty_id . '/' . $media->directory;
                        $resp = Utils::destroyFileToS3($url);
                        if (!$resp->original['success']) {
                            array_push($imageErro, $url);
                        } else {
                            RealtyAttachment::destroy($media);
                        }
                        break;
                    case RouterS3::ADMINISTRATIVES_DOCUMENTS:
                        $documentsAdministrative = DocumentsAdministrative::find($media);
                        $url = RouterS3::ADMINISTRATIVES_DOCUMENTS . '/' . $object->id . '/' . $documentsAdministrative->directory;
                        $resp = Utils::destroyFileToS3($url);
                        if (!$resp->original['success']) {
                            array_push($imageErro, $url);
                        } else {
                            DocumentsAdministrative::destroy($media);
                        }
                        break;
                    case RouterS3::PARTNER_CRECI:
                        $url = RouterS3::PARTNER_CRECI . '/' . $object->id . '/' . $object->creci_data;
                        $resp = Utils::destroyFileToS3($url);
                        if (!$resp->original['success']) {
                            array_push($imageErro, $url);
                        } else {
                            $object->creci_data = '';
                            $object->save();
                        }
                        break;
                    case BankAccount::ProviderBankAccount:
                        break;
                    case BankAccount::RealEstateBankAccount:
                        break;
                    default:
                }
            };
            return $imageErro;
        } catch (S3Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
