<?php

namespace App\Services\Admin\Misc;

use App\Services\Service;

class PaginatorService extends Service{
 
    public static $rangePagination;
    public static $firstPage;
    public static $currentPage;
    public static $lastPage;
    public static $startNumber;
    public static $endNumber;

    public function __construct($cPage = 1, $lPage = 1, $range = 3)
    {
        // get & set data
        self::$rangePagination = $range;
        self::$currentPage = $cPage;
        self::$lastPage = $lPage;
        self::$firstPage = 1;

        self::init();
    }

    private static function init()
    {
        // calcu;ate the start number
        self::$startNumber = self::$currentPage - floor(self::$rangePagination/2); // current page center

        if ((self::$startNumber+self::$rangePagination)> self::$lastPage){ // fix the end
            self::$startNumber -= ((self::$startNumber+self::$rangePagination) - self::$lastPage - 1);  
        }

        if (self::$startNumber<=1){ // fix the start
            self::$startNumber = 1; 
        }

        // calculate the end number
        self::$endNumber = self::$startNumber + self::$rangePagination - 1;

        if (self::$endNumber>self::$lastPage){ // fix the end
            self::$endNumber = self::$lastPage;
        }
    }

    public static function hasMore()
    {
        if (self::$lastPage>1){
            return true;
        }
        return false;
    }

    public static function getUrl($i = 1)
    {
        $fullUrl = url()->full();

        $fullUrl = preg_replace('/page\d+/', '', $fullUrl);

        // remove last slash
        if (substr($fullUrl, strlen($fullUrl)-1, 1) == '/'){
            $fullUrl = substr($fullUrl, 0, strlen($fullUrl)-1);
        }

        // find get params
        $tmpLink = explode('?', $fullUrl);

        if ($i==1){
            return $fullUrl;
        }

        // last one is slash then remove slash
        if (substr($tmpLink[0], strlen($tmpLink[0])-1, 1)=='/'){ $tmpLink[0] = substr($tmpLink[0], 0, strlen($tmpLink[0])-1); }

        return $tmpLink[0].'/page'.$i.(isset($tmpLink[1])?'?'.$tmpLink[1]:'');
    }

    public static function hasStartNumber()
    {
        if (self::$startNumber>floor(self::$rangePagination/2)){
            return self::$firstPage;
        }
        return false;
    }

    public static function hasEndNumber()
    {
        if (self::$currentPage+floor(self::$rangePagination/2)<self::$lastPage){
            return self::$lastPage;
        }
        return false;
    }

    public static function hasDots($before = false)
    {
        if (!$before){
            if (self::$endNumber+1<self::$lastPage){
                return self::$endNumber+1;
            }
            return false;
        }else{
            if (self::$startNumber-1>self::$firstPage){
                return self::$startNumber-1;
            }
            return false;
        }
    }

    public static function nextPage()
    {
        if (self::$currentPage+1>self::$lastPage){
            return self::$lastPage;
        }
        return self::$currentPage+1;
    }

    public static function prevPage()
    {
        if (self::$currentPage-1<self::$firstPage){
            return self::$firstPage;
        }
        return self::$currentPage-1;
    }
    
}