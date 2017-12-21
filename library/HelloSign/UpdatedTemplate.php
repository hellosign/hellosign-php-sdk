<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

/**
 * The MIT License (MIT)
 *
 * Copyright (C) 2014 hellosign.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace HelloSign;

/**
 * Model object that represents a HelloSign Template resource
 */
class UpdatedTemplate extends AbstractResource
{
    /**
     * @var string
     * @ignore
     */
    protected $resource_type = 'template';

    /**
     * The id of the Template
     *
     * @var string
     */
    protected $template_id;

    /**
     * Client id of the app you're using to create this template.
     *
     * @var string
     */
    protected $client_id;

    /**
    * The default email subject that will be sent to signers when using this
    * Template to send a SignatureRequest. This can be overriden when
    * sending the SignatureRequest.
    *
    * @var string
    */
    protected $subject;

    /**
     * The default message that will be sent to signers when using this
     * Template to send a SignatureRequest. This can be overriden when
     * sending the SignatureRequest.
     *
     * @var string
     */
    protected $message;

    /**
     * @return string
     * @ignore
     */
    public function getId()
    {
        return $this->template_id;
    }


    /**
     * @param string $id clientID
     * @return boolean
     * @ignore
     */
    public function setClientId($id)
    {
        $this->client_id = $id;
        return true;
    }

    /**
     * @param  stdClass $array
     * @param  array $options
     * @return Template
     * @ignore
     */
    public function fromArray($array, $options = array())
    {
        !isset($options['except']) && $options['except'] = array();
        $options['except'][] = 'named_form_fields';

        return parent::fromArray($array, $options);
    }

    /**
     * @return array
     * @ignore
     */
    public function toUpdateTemplateParams()
    {
        $fields_to_include = array(
            'test_mode',
            'client_id',
            'file',
            'file_url',
            'subject',
            'message',
        );

        $params = $this->toArray();

        foreach ($params as $key => $value) {
            if (!in_array($key, $fields_to_include)) {
                unset($params[$key]);
            }
        }

        return $params;
    }
}
