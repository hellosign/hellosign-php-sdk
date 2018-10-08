<?php

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

 namespace HelloSign\Test;

 use HelloSign\BulkSendJob;

 class BulkSendTest extends AbstractTest {

   /**
   * @group initiate
   */
   public function testBulkSendJobClass() {
     $stub = $this->createMock(BulkSendJob::class);
     $this->assertClassHasAttribute('test_mode', BulkSendJob::class);
     $this->assertClassHasAttribute('allow_decline', BulkSendJob::class);
     $this->assertClassHasAttribute('template_ids', BulkSendJob::class);
     $this->assertClassHasAttribute('title', BulkSendJob::class);
     $this->assertClassHasAttribute('subject', BulkSendJob::class);
     $this->assertClassHasAttribute('message', BulkSendJob::class);
     $this->assertClassHasAttribute('signing_redirect_url', BulkSendJob::class);
     $this->assertClassHasAttribute('signer_file', BulkSendJob::class);
     $this->assertClassHasAttribute('signer_list', BulkSendJob::class);
     $this->assertClassHasAttribute('custom_fields', BulkSendJob::class);
     $this->assertClassHasAttribute('ccs', BulkSendJob::class);
     $this->assertClassHasAttribute('metadata', BulkSendJob::class);
     $this->assertClassHasAttribute('client_id', BulkSendJob::class);
   }
 }

?>
