<?php

namespace Lsw\ApiCallerBundle\Call;

/**
 * cURL based API call with request data send as GET parameters with custom headers
 *
 * @author Niklas <git@niklas.top>
 */
class HttpHeaderGetJson extends CurlCall implements ApiCallInterface
{
    /**
     * {@inheritdoc}
     */
    public function generateRequestData()
    {
        $this->requestData = $this->requestObject;
    }

    /**
     * {@inheritdoc}
     */
    public function parseResponseData()
    {
        $this->responseObject = json_decode($this->responseData, $this->asAssociativeArray);
    }

    /**
     * {@inheritdoc}
     */
    public function makeRequest($curl, $options)
    {
        $curl->setopt(CURLOPT_URL, $this->url);
        $curl->setopt(CURLOPT_HTTPGET, TRUE);
        $curl->setopt(CURLOPT_HTTPHEADER, $this->requestData);
        $curl->setoptArray($options);
        $this->curlExec($curl);
    }

}
