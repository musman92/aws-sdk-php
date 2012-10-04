<?php
/**
 * Copyright 2010-2012 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Aws\S3\Model\MultipartUpload;

use Aws\Common\Client\AwsClientInterface;
use Aws\Common\Model\MultipartUpload\AbstractTransferState;

/**
 * State of a multipart upload
 */
class TransferState extends AbstractTransferState
{
    /**
     * {@inheritdoc}
     */
    public static function fromUploadId(AwsClientInterface $client, array $idParams)
    {
        $transferState = new self($idParams);

        foreach ($client->getIterator('ListParts', $idParams) as $part) {
            $transferState->addPart(UploadPart::fromArray($part));
        }

        return $transferState;
    }
}