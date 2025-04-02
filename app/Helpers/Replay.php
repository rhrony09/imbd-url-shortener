<?php

namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;

class Reply {

    /** Return success response
     * @param string $message
     * @return array
     */

    public static function success($message) {
        session()->flash('success', $message);
        return [
            'status' => 'success',
            'message' => Reply::getTranslated($message)
        ];
    }

    /**
     * @param string $message
     * @param array $data
     * @return array
     */
    public static function successWithData($message, $data) {
        $response = Reply::success($message);

        return array_merge($response, $data);
    }

    /**
     * @param string $message
     * @param null $error_name
     * @param array $errorData
     * @return array
     */
    public static function error($message, $error_name = null, $errorData = []) {
        session()->flash('error', $message);
        return [
            'status' => 'error',
            'error_name' => $error_name,
            'data' => $errorData,
            'message' => Reply::getTranslated($message)
        ];
    }


    /** Response with redirect action. This is meant for ajax responses and is not meant for direct redirecting
     * to the page
     * @param string $url
     * @param null $message Optional message
     * @return array
     */
    public static function redirect($url, $message = null) {
        if ($message != null) {
            session()->flash('success', $message);
            return [
                'status' => 'success',
                'message' => Reply::getTranslated($message),
                'action' => 'redirect',
                'url' => $url
            ];
        }

        return [
            'status' => 'success',
            'action' => 'redirect',
            'url' => $url
        ];
    }

    private static function getTranslated($message) {
        $trans = trans($message);

        if ($trans == $message) {
            return $message;
        }

        return $trans;
    }

    public static function dataOnly($data) {
        return $data;
    }

    public static function returnBack($message) {
        session()->flash('success', $message);
        return redirect()->back();
    }
}
