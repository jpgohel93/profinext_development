<?php
	function ajaxResponse($status, $data, $message) {
		return [
			'status' => $status,
			'data' => $data,
			'message' => $message
		];
	}

	function isAllowedExtension($extension)
	{
        $allowedExtensions = config()->get('constants.ALLOWED_EXTENSIONS');

		if(!in_array($extension, $allowedExtensions)) {
			return false;
		}
		return true;
	}

	function isAllowedMimeType($mimeType)
	{
        $allowedMimeTypes = config()->get('constants.ALLOWED_MIMETYPES');

		if(!in_array($mimeType, $allowedMimeTypes)) {
			return false;
		}
		return true;
	}
	
    function getFileTypeSignature( $str )
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

    function isValidPNG( $file )
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

    function isValidJPG( $file )
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

    function isValidPDF( $file )
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

    function isValidDocxXlsx( $file )
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

    function isValidDocXls( $file )
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
?>