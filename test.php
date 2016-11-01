<?php
// require_once 'vendor/autoload.php';
require_once 'HelloSign.php';

// setup
//prod
    // $api_key = 'd8b3336b7dbc56789650f81b7c85deb53063398dfe1652568834d69a615bba8a';
    // $client_id = '17b5418916e4a53f5e30903765908e99';
//staging
    // $api_key = '3e344dcfc299b1e2a38196d9b4953d8991036600af6043641ede37e4a04e12e2';
    // $client_id = '5b8c3a4d6ea0595243c6e27c7a7e39a9';
//dev
    $api_key = 'a0d91b94eb609bac58d99795f03814582ac70f806d1c4e019a46180440221e95';
    $client_id = 'be3bc629bd2391827475ac345de1094d';
$client = new HelloSign\Client($api_key);
$responses = array();

// example variables
$path_to_nda_pdf = '/Users/desmond/Downloads/testing/NDA.pdf';
$path_to_appendix_a_pdf = '/Users/desmond/Downloads/testing/NDA.pdf';
$path_to_agreement_pdf = '/Users/desmond/Downloads/testing/NDA.pdf';
$path_to_appendix_doc = '/Users/desmond/Downloads/testing/NDA.pdf';
$example_template = '31eeb9b6b9f93ac5c3bab8907ea569511867bdb7';
$example_template2 = '32ba75a94fadea0d15b1a92a8e77ae1af7bdde47';
$example_template3 = 'e485e348c0cb9b608309ffdcc24d41c886b92e50';
$sig_request_id = '4f68f59e3018322e16030114ef6894a1b1ac7348';

    // requisites for calls
    // $signature_requests = $client->getSignatureRequests(1);
    // $sig_request_id = $signature_requests[0]->signature_request_id;
    // $template_list = $client->getTemplates();

    // $request = new HelloSign\TemplateSignatureRequest;
    // $request->enableTestMode();
    // $request->setTemplateId($example_template);
    // $request->setTemplateId($example_template2);
    // $request->setSubject('TemplateDLTest');
    // $request->setMessage('Glad we could come to an agreement.');
    // $request->setSigner('Role1', 'role1@hellossign.com', 'George');
    // $request->setSigner('Role2', 'role2@hellossign.com', 'Jane');
    // $response = $client->sendTemplateSignatureRequest($request);

// api calls

// ACCOUNT
    // $response = $client->getAccount();

    // $account = new HelloSign\Account;
    // $account->setCallbackUrl('https://www.example.com/callback');
    // $response = $client->updateAccount($account);

    // $response = $client->createAccount(
    //     new HelloSign\Account(
    //         'joe@example.com'
    //     )
    // );

    // $request = new HelloSign\SignatureRequest;
    // $request->enableTestMode();
    // $request->setTitle('NDA with Acme Co.');
    // $request->setSubject('The NDA we talked about');
    // $request->setMessage('Please sign this NDA and let\'s discuss.');
    // // $request->setClientId($client_id);
    // $request->addSigner('desmond@hellosign.com', 'Dez');
    // // $request->addFileUrl('https://s3.amazonaws.com/hellofax_uploads_dev/super_groups/2016/05/12/4f68f59e3018322e16030114ef6894a1b1ac7348/merged-initial.pdf?AWSAccessKeyId=AKIAJWEWDFQHQMB2CJZA&Expires=1463431131&Signature=sFpfjdTLIFRDzk2O3CnmjzskQyE%3D');
    // $request->addFile($path_to_nda_pdf);
    // $response = $client->sendSignatureRequest($request);


    // $request = new HelloSign\SignatureRequest;
    // $request->setTitle('fixed22222');
    // $request->setSubject('The NDA we talked about');
    // $request->setMessage('Please sign this NDA and let\'s discuss.');
    // $request->addSigner('desmond@hellosign.com', 'Dez');
    // $request->addFile($path_to_nda_pdf);
    // $request->setFormFieldsPerDocument(
    //         array( //everything
    //             array( //document 1
    //                 array( //component 1
    //                     "api_id"=> "myid_1",
    //                     "name"=> "",
    //                     "type"=> "text",
    //                     "x"=> 112,
    //                     "y"=> 328,
    //                     "width"=> 100,
    //                     "height"=> 16,
    //                     "required"=> true,
    //                     "signer"=>0,
    //                     "validation_type"=> "numbers_only"
    //                 ),
    //                 array( //component 2
    //                     "api_id"=> "myid_2",
    //                     "name"=> "",
    //                     "type"=> "signature",
    //                     "x"=> 530,
    //                     "y"=> 415,
    //                     "width"=> 150,
    //                     "height"=> 30,
    //                     "required"=> true,
    //                     "signer"=>0
    //                 ),
    //             ),
    //         ));
    // $response = $client->sendSignatureRequest($request);

    // $response = $client->isAccountValid('desmoasdasdnd@hellosign.com'); //true

// SIGNATURE REQUEST
    // $response = $client->getSignatureRequest($signature_requests[0]->signature_request_id);

    // $response = $client->getSignatureRequests(1);
    // echo "declined = " . $response[0]->isDeclined();
    // echo "declined reason = " . $response[0]->getSignatures()[0]->getDeclineReason();
    // echo "error = " . $response[0]->getSignatures()[0]->getError();

    // $request = new HelloSign\SignatureRequest;
    // $request->enableAllowDecline();
    // $request->setTitle('MAH TITLE 222');
    // $request->setSubject('The NDA we talked about');
    // $request->setMessage('Please sign this NDA and then we can discuss more. Let me know if you have any questions.');
    // $request->addSigner('desmond@hellosign.com', 'Dez');
    // // $request->addSigner(new HelloSign\Signer(array(
    // //     'name' => 'Jill',
    // //     'email_address' => 'jill@example.com',
    // //     'order' => 1
    // // )));
    // $request->addCC('lawyer1@example.com');
    // $request->addCC('lawyer2@example.com');
    // $request->addFile($path_to_nda_pdf);
    // $request->addFile($path_to_appendix_a_pdf);
    // $request->addMetadata('custom_id', '1234');
    // $request->addMetadata('custom_text', 'NDA #9');
    // $response = $client->sendSignatureRequest($request);

        // $request = new HelloSign\TemplateSignatureRequest;
        // // $request->enableTestMode();
        // $request->setTemplateId($example_template3);
        // $request->setSubject('Purchase Order');
        // $request->setMessage('Glad we could come to an agreement.');
        // $request->setSigner('Client', 'desmond@hellosign.com', 'Dez');
        // // $request->setCustomFieldValue('Cost', '$20,000');
        // $response = $client->sendTemplateSignatureRequest($request);

        // $request = new HelloSign\TemplateSignatureRequest;
        // $request->setTemplateId($example_template2);
        // $request->setSubject('Purchase Order');
        // $request->setMessage('Glad we could come to an agreement.');
        // $request->setSigner('Client', 'desmond@hellosign.com', 'Dez');
        // $request->setCustomFieldValue('textbox1', '');
        // $request->setCustomFieldValue('textbox2', '');
        // $request->setCustomFieldValue('textbox3', 'hi mum');
        // $request->setCustomFieldValue('textbox4', 'hi mum');
        // $request->setCustomFieldValue('checkbox1', false);
        // $request->setCustomFieldValue('checkbox2', false);
        // $request->setCustomFieldValue('checkbox3', true);
        // $request->setCustomFieldValue('checkbox4', true);
        // $response = $client->sendTemplateSignatureRequest($request);

        // $request = new HelloSign\TemplateSignatureRequest;
        // $request->setTemplateId($example_template2);
        // $request->setSubject('Purchase Order');
        // $request->setMessage('Glad we could come to an agreement.');
        // $request->setSigner('Client', 'desmond@hellosign.com', 'Dez');
        // $request->setCustomFieldValue('textbox1', '', 'Client');
        // $request->setCustomFieldValue('textbox2', '', 'Client');
        // $request->setCustomFieldValue('textbox3', 'hi mum', 'Client');
        // $request->setCustomFieldValue('textbox4', 'hi mum', 'Client');
        // $request->setCustomFieldValue('checkbox1', false, 'Client');
        // $request->setCustomFieldValue('checkbox2', false, 'Client');
        // $request->setCustomFieldValue('checkbox3', true, 'Client');
        // $request->setCustomFieldValue('checkbox4', true, 'Client');
        // $response = $client->sendTemplateSignatureRequest($request);

        // $request = new HelloSign\TemplateSignatureRequest;
        // $request->setTemplateId($example_template2);
        // $request->setSubject('Purchase Order');
        // $request->setMessage('Glad we could come to an agreement.');
        // $request->setSigner('Client', 'desmond@hellosign.com', 'Dez');
        // $request->setCustomFieldValue('textbox1', '', 'Client', false);
        // $request->setCustomFieldValue('textbox2', '', 'Client', true);
        // $request->setCustomFieldValue('textbox3', 'hi mum', 'Client', false);
        // $request->setCustomFieldValue('textbox4', 'hi mum', 'Client', true);
        // $request->setCustomFieldValue('checkbox1', false, 'Client', false);
        // $request->setCustomFieldValue('checkbox2', false, 'Client', true);
        // $request->setCustomFieldValue('checkbox3', true, 'Client', false);
        // $request->setCustomFieldValue('checkbox4', true, 'Client', true);
        // $response = $client->sendTemplateSignatureRequest($request);

    // $response = $client->requestEmailReminder($sig_request_id, 'george@example.com');

    // $response = $client->cancelSignatureRequest($sig_request_id);

    // $response = $client->getFiles($sig_request_id, 'file.pdf', 'pdf');
    // $response = $client->getFiles($sig_request_id);

    // $request = new HelloSign\SignatureRequest;
    // $request->setTitle('Embedded NDA with Acme Co');
    // $request->setMessage('Please sign this NDA and then we can discuss more. Let me know if you have any
    // questions.');
    // $request->addSigner('jack@example.com', 'Jack', 0);
    // $request->addSigner(new HelloSign\Signer(array(
    //     'name' => "Jill",
    //     'email_address' => "jill@example.com",
    //     'order' => 1
    // )));
    // $request->addFile($path_to_nda_pdf);
    // $request->addFile($path_to_appendix_a_pdf);
    // $request->addCC('lawyer1@hellosign.com');
    // $request->addCC('lawyer2@example.com');
    // $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);
    // $response = $client->createEmbeddedSignatureRequest($embedded_request);

    // $request = new HelloSign\TemplateSignatureRequest;
    // $request->enableTestMode();
    // $request->setTemplateId($example_template);
    // $request->setSubject('Purchase Order');
    // $request->setMessage('Glad we could come to an agreement.');
    // $request->setSigner('Client', 'desmond@hellosign.com', 'George');
    // $request->setCustomFieldValue('Cost', '$20,000');
    // $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);
    // $embedded_request->enableTestMode();
    // $response = $client->createEmbeddedSignatureRequest($embedded_request);

// TEMPLATE
    // $response = $client->getTemplate($example_template);

    // $response = $template_list = $client->getTemplates();

    // $response = $client->addTemplateUser($example_template, 'desmond+fake2@hellosign.com');

    // $response = $client->removeTemplateUser($example_template, 'desmond+fake2@hellosign.com');

    // $request = new \HelloSign\Template();
    // $request->setClientId($client_id);
    // $request->addFile($path_to_nda_pdf);
    // $request->setTitle('Test Title');
    // $request->setSubject('Test Subject');
    // $request->setMessage('Test Message');
    // $request->addSignerRole('Test Role', 1);
    // $request->addSignerRole('Test Role 2', 2);
    // $request->addCCRole('Test CC Role');
    // $request->addMergeField('Test Merge', 'text');
    // $request->addMergeField('Test Merge 2', 'checkbox');
    // $response = $client->createEmbeddedDraft($request);
    //     $new_template_id = $response->getId();
    //     $edit_url = $response->getEditUrl();
    //     sleep(10);

    // $template_id = 'c997b4af0580c3234ade5148125ea22d953ec247';
    // $response = $client->deleteTemplate($template_id);

    // $response = $client->getTemplateFiles($example_template2, 'file.zip', 'zip');
    // $response = $client->getTemplateFiles($example_template2);

// TEAMS
    // $response = $client->getTeam();

    // $response = $client->destroyTeam();
    // $response = $client->createTeam(new HelloSign\Team('Team America World Police'));

    // $response = $client->updateTeamName('new HelloSign\Team Name');

    // $response = $client->destroyTeam();

    // $response = $client->inviteTeamMember('teammdate@hellosign.com');

    // $response = $client->removeTeamMember('desmond@hellosign.com');

// UNCLAIMED DRAFT
    $request = new HelloSign\SignatureRequest;
    $request->enableTestMode();
    $request->addFile($path_to_agreement_pdf);
    // $request->addFile($path_to_appendix_doc);
    // $request->addFileUrl('https://s3.amazonaws.com/hellofax_uploads_dev/super_groups/2016/05/12/4f68f59e3018322e16030114ef6894a1b1ac7348/merged-initial.pdf?AWSAccessKeyId=AKIAJWEWDFQHQMB2CJZA&Expires=1463431131&Signature=sFpfjdTLIFRDzk2O3CnmjzskQyE%3D');
    $draft = new HelloSign\UnclaimedDraft($request);
    $response = $client->createUnclaimedDraft($draft);

    // $request = new HelloSign\SignatureRequest;
    // $request->enableTestMode();
    // $request->setRequesterEmail('jack@hellosign.com');
    // $request->addFile($path_to_nda_pdf);
    // $draft_request = new HelloSign\UnclaimedDraft($request, $client_id);
    // $response = $client->createUnclaimedDraft($draft_request);

    // $baseReq = new \HelloSign\TemplateSignatureRequest();
    // $baseReq->setTemplateId($example_template2);
    // $baseReq->setSigner('Signer', 'harry@potter.net', 'Harry Potter');
    // $baseReq->setSigningRedirectUrl('http://hogwarts.edu/success');
    // $baseReq->setRequestingRedirectUrl('http://hogwarts.edu');
    // $baseReq->setRequesterEmailAddress('herman@hogwarts.com');
    // $baseReq->addMetadata('House', 'Griffyndor');
    // $request = new \HelloSign\EmbeddedSignatureRequest($baseReq);
    // $request->setClientId($client_id);
    // $request->enableTestMode();
    // $request->skipDomainVerification();
    // $request->setEmbeddedSigning();
    // $response = $client->createUnclaimedDraftEmbeddedWithTemplate($request);

// EMBEDDED
    // $response = $client->getEmbeddedSignUrl("7ea0f2443d2337de5f29ee5186d0993f");

    // $response = $client->getEmbeddedEditUrl($new_template_id);
    // $response = $response->getEditUrl;

// API APP
    // $response = $client->getApiApp($client_id);

    // $response = $client->getApiApps();

    // $api_app = new HelloSign\ApiApp('Desmondw app', 'desmondw.com');
    // $response = $client->createApiApp($api_app);

    // $api_app->setName('a derpy name now2');
    // $response = $client->updateApiApp($api_app);

    // $response = $client->deleteApiApp('96de12d0e76920f43ace260fed3593d1');



// DUMPS
    // var_dump($response);
    echo print_r($response, true);
    // var_dump($response->toArray(array('include_null' => true)));
    // echo json_encode($response->toArray(array('include_null' => false)));



    // Dump for team accounts to json
    // ---
    // $accounts = $response->toArray();
    // for ($i = 0; $i < count($accounts["accounts"]); $i++) {
    //     $accounts["accounts"][$i] = $accounts["accounts"][$i]->toArray();
    // }
    // echo json_encode($accounts);
