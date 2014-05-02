<?php
/**
 * HelloSign PHP SDK (https://github.com/HelloFax/hellosign-php-sdk/)
 */

namespace HelloSign;

/**
 * Represents an Embedded signature request (either standard or templated)
 *
 * An embedded request is one that can be signed from either within HelloSign or
 * from within an iFrame on your website.
 */
class EmbeddedSignatureRequest extends AbstractSignatureRequestWrapper
{
	/**
     * @return array
     * @ignore
     */
	
	public function toParams()
    {
        $except = array(
            'request',
        );

        return $this->toArray(array(
            'except' => $except
        )) + $this->request->toParams(array(
            'except' => array(
                'title',
        		'use_text_tags',
        		'hide_text_tags'
            )
        ));
    }
}