<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    public function getResponse($conteudoResposta): JsonResponse
    {
        if (isset($conteudoResposta['erro'])){
            $statusResposta = Response::HTTP_BAD_REQUEST;
        }else{
            $statusResposta = Response::HTTP_OK;
        }

        return new JsonResponse($conteudoResposta, $statusResposta);
    }
}