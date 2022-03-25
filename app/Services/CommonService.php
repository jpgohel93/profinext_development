<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
class CommonService
{
    public static function checkValidFile($file,$path)
    {
        $extension = $file->extension();
        if(!self::isAllowedExtension($extension)) {
            return ajaxResponse(false, [], 'File type is not allowed.');
        }

        $mimeType = $file->getMimeType();
        if(!self::isAllowedMimeType($mimeType)) {
            return ajaxResponse(false, [], 'File type is not allowed.');
        }

        $tempPath = $file->getPathname();
        $lowerCaseExtension = strtolower($extension);
        if($lowerCaseExtension == 'png') {
            $isValidFile = self::isValidPNG($tempPath);
        } elseif($lowerCaseExtension == 'jpeg' || $lowerCaseExtension == 'jpg') {
            $isValidFile = self::isValidJPG($tempPath);
        } elseif($lowerCaseExtension == 'pdf') {
            $isValidFile = self::isValidPDF($tempPath);
        } elseif($lowerCaseExtension == 'docx' || $lowerCaseExtension == 'xlsx') {
            $isValidFile = self::isValidDocxXlsx($tempPath);
        } elseif($lowerCaseExtension == 'doc' || $lowerCaseExtension == 'xls') {
            $isValidFile = self::isValidDocXls($tempPath);
        } else {
            $isValidFile = false;
        }

        if(!$isValidFile) {
            return self::ajaxResponse(false, [], 'File type is not allowed.');
        }

        if($lowerCaseExtension == 'png') {
            $image = imagecreatefrompng($tempPath);
        } elseif($lowerCaseExtension == 'jpeg' || $lowerCaseExtension == 'jpg') {
            $image = imagecreatefromjpeg($tempPath);
        }
        if(isset($image)) {
            imagejpeg($image,$path);
            imagedestroy($image);
        }

        return self::ajaxResponse(true, [], 'File type is valid.');
    }

    public static function uploadfile($file, $path)
    {
        $name = $file->getClientOriginalName();
        $extension = $file->extension();
        $filename = $file->hashName(); //uniqid().'.'.$extension;
        $mimeType = $file->getMimeType();
        $file->storeAs($path, $filename);

        $validFileResponse = self::checkValidFile($file,"$path/$filename");
        if(!$validFileResponse['status']) {
            return $validFileResponse;
        }
        
        $responseData = [
            'name' => $name,
            'filename' => $filename,
            'extension' => $extension,
            'mimeType' => $mimeType,
        ];

        return self::ajaxResponse(true, $responseData, 'File uploaded successfully.');
    }

    public static function ajaxResponse($status, $data, $message) {
		return [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
	}

	public static function isAllowedExtension($extension)
	{
        $allowedExtensions = config()->get('constants.ALLOWED_EXTENSIONS');

		if(!in_array($extension, $allowedExtensions)) {
			return false;
		}
		return true;
	}

	public static function isAllowedMimeType($mimeType)
	{
        $allowedMimeTypes = config()->get('constants.ALLOWED_MIMETYPES');

		if(!in_array($mimeType, $allowedMimeTypes)) {
			return false;
		}
		return true;
	}
	
    public static function getFileTypeSignature( $str )
    {
        $hex_ary = array();
        foreach( str_split( $str ) as $chr ) 
        {
            $hex_ary[] = sprintf("%02X", ord($chr));
        }
        $s = '';
        if ( $hex_ary ) foreach( $hex_ary as $item )
        {
        $s .= '\x'.$item;
        }
        return $s;
    }

    public static function isValidPNG( $file )
    {
        //PNG
        if ( !file_exists( $file ) ) return false;
        if ( $f = fopen($file, 'rb') ) 
        {
            $header = fread($f, 8);
            fclose($f);
            return strncmp($header, "\x89\x50\x4e\x47\x0d\x0a\x1a\x0a", 8)==0 && strlen ($header)==8;
        }
        return false;
    }

    public static function isValidJPG( $file )
    {
        //JFIF, JPE, JPEG, JPG
        if ( !file_exists( $file ) ) return false;
        if ( $f = fopen($file, 'rb') ) 
        {
            $header = fread($f, 8);
            fclose($f);
            return strncmp($header, "\xFF\xD8\xFF\xE0\x00\x10\x4A\x46\x49\x46\x00\x01", 8)==0 && strlen ($header)==8;
        }
        return false;
    }

    public static function isValidPDF( $file )
    {
        //PDF
        if ( !file_exists( $file ) ) return false;
        if ( $f = fopen($file, 'rb') ) 
        {
            $header = fread($f, 5);
            fclose($f);
            return strncmp($header, "\x25\x50\x44\x46\x2D", 5)==0 && strlen ($header)==5;
            // pdf 1.3 = \x25\x50\x44\x46\x2D\x31\x2E\x33
            // pdf 1.4 = \x25\x50\x44\x46\x2D\x31\x2E\x34
        }
        return false;
    }

    public static function isValidDocxXlsx( $file )
    {
        //ZIP AAR APK DOCX EPUB IPA JAR KMZ MAFF MSIX ODP ODS ODT PK3 PK4 PPTX USDZ VSDX XLSX XPI	
        if ( !file_exists( $file ) ) return false;
        if ( $f = fopen($file, 'rb') ) 
        {
            $header = fread($f, 4);
            fclose($f);
            return strncmp($header, "\x50\x4B\x03\x04", 4)==0 && strlen ($header)==4;
        }
        return false;
    }

    public static function isValidDocXls( $file )
    {
        //DOC XLS PPT MSI MSG
        if ( !file_exists( $file ) ) return false;
        if ( $f = fopen($file, 'rb') ) 
        {
            $header = fread($f, 8);
            fclose($f);
            return strncmp($header, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1", 8)==0 && strlen ($header)==8;
        }
        return false;
    }
    public static function getFileInformation($id, $type)
    {
        if($type == 'screenshots') {
            
            $screenshots = DB::table("tbl_screenshots")->where("id",$id)->first(['file','mime_type']);
            
            if(empty($screenshots)) {
                return self::ajaxResponse(false, [], 'File not found.');
            }
            $response = [
                'filename' => $screenshots->file,
                'mime_type' => $screenshots->mime_type,
                "path"=> "screenshots"
            ];

            return self::ajaxResponse(true, $response, 'Success');
        }

        if($type == 'pancard') {
            
            $pan_card = DB::table("tbl_pancards")->where("id",$id)->first(['file', 'mime_type']);
            
            if(empty($pan_card)) {
                return self::ajaxResponse(false, [], 'File not found.');
            }
            $response = [
                'filename' => $pan_card->file,
                'mime_type' => $pan_card->mime_type,
                "path" => "pan_cards"
            ];

            return self::ajaxResponse(true, $response, 'Success');
        }

        return self::ajaxResponse(false, [], 'Unknown file type.');
    }
    public static function throwError($err){
        $error = \Illuminate\Validation\ValidationException::withMessages([
            'Error' => $err,
        ]);
        throw $error;
    }
}

?>