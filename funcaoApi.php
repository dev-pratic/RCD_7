<?php
function enviarMensagemZAPI($telefone, $mensagem) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3E706E7CBC4F506B545EDAF722ECB67F/token/BD77DBB1B68419C9474A0CDE/send-text",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"phone\": \"$telefone\", \"message\": \"$mensagem\"}",
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}

function enviarMensagemZAPIE($telefone, $mensagem) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3ED9B33D7F0A9142C44F6EF9D3DD8A4F/token/D504C69DFA0B29748CC8F25A/send-text",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"phone\": \"$telefone\", \"message\": \"$mensagem\"}",
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}

function obterChatsZAPI() {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3E706E7CBC4F506B545EDAF722ECB67F/token/BD77DBB1B68419C9474A0CDE/groups",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'success' => (!$err && $httpCode == 200),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode,
        'rawResponse' => $response
    );
}

function obterChatsZAPIE() {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3ED9B33D7F0A9142C44F6EF9D3DD8A4F/token/D504C69DFA0B29748CC8F25A/groups",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'success' => (!$err && $httpCode == 200),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode,
        'rawResponse' => $response
    );
}

function enviarPDF($telefone, $caminhoArquivo, $nomeArquivo) {
    if (!file_exists($caminhoArquivo)) {
        return array(
            'telefone' => $telefone,
            'caminhoArquivo' => $caminhoArquivo,
            'nomeArquivo' => $nomeArquivo,
            'success' => false,
            'error' => "Arquivo não encontrado: " . $caminhoArquivo,
            'response' => null,
            'httpCode' => 0
        );
    }
    
    $conteudoArquivo = file_get_contents($caminhoArquivo);
    $base64 = base64_encode($conteudoArquivo);
    
    $mimeType = mime_content_type($caminhoArquivo);
    
    $documentBase64 = "data:" . $mimeType . ";base64," . $base64;
    
    $curl = curl_init();

    $dadosEnvio = array(
        'phone' => $telefone,
        'document' => $documentBase64,
        'fileName' => $nomeArquivo
    );

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3E706E7CBC4F506B545EDAF722ECB67F/token/BD77DBB1B68419C9474A0CDE/send-document/pdf",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($dadosEnvio),
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'caminhoArquivo' => $caminhoArquivo,
        'nomeArquivo' => $nomeArquivo,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}

function enviarPDFE($telefone, $caminhoArquivo, $nomeArquivo) {
    if (!file_exists($caminhoArquivo)) {
        return array(
            'telefone' => $telefone,
            'caminhoArquivo' => $caminhoArquivo,
            'nomeArquivo' => $nomeArquivo,
            'success' => false,
            'error' => "Arquivo não encontrado: " . $caminhoArquivo,
            'response' => null,
            'httpCode' => 0
        );
    }
    
    $conteudoArquivo = file_get_contents($caminhoArquivo);
    $base64 = base64_encode($conteudoArquivo);
    
    $mimeType = mime_content_type($caminhoArquivo);
    
    $documentBase64 = "data:" . $mimeType . ";base64," . $base64;
    
    $curl = curl_init();

    $dadosEnvio = array(
        'phone' => $telefone,
        'document' => $documentBase64,
        'fileName' => $nomeArquivo
    );

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3ED9B33D7F0A9142C44F6EF9D3DD8A4F/token/D504C69DFA0B29748CC8F25A/send-document/pdf",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($dadosEnvio),
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'caminhoArquivo' => $caminhoArquivo,
        'nomeArquivo' => $nomeArquivo,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}

function enviarImagem($telefone, $imagem, $nomeArquivo = null, $isBase64 = true) {
    $curl = curl_init();

    $dadosEnvio = array(
        'phone' => $telefone
    );

    if ($isBase64) {
        if (file_exists($imagem)) {
            $conteudoArquivo = file_get_contents($imagem);
            $base64 = base64_encode($conteudoArquivo);
            $mimeType = mime_content_type($imagem);
            $dadosEnvio['image'] = "data:" . $mimeType . ";base64," . $base64;
            
            if ($nomeArquivo === null) {
                $nomeArquivo = basename($imagem);
            }
        } else {
            $dadosEnvio['image'] = $imagem;
        }
        
        if ($nomeArquivo !== null) {
            $dadosEnvio['fileName'] = $nomeArquivo;
        }
    } else {
        $dadosEnvio['image'] = $imagem;
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3E706E7CBC4F506B545EDAF722ECB67F/token/BD77DBB1B68419C9474A0CDE/send-image",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($dadosEnvio),
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'imagem' => $imagem,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}

function enviarImagemE($telefone, $imagem, $nomeArquivo = null, $isBase64 = true) {
    $curl = curl_init();

    $dadosEnvio = array(
        'phone' => $telefone
    );

    if ($isBase64) {
        if (file_exists($imagem)) {
            $conteudoArquivo = file_get_contents($imagem);
            $base64 = base64_encode($conteudoArquivo);
            $mimeType = mime_content_type($imagem);
            $dadosEnvio['image'] = "data:" . $mimeType . ";base64," . $base64;
            
            if ($nomeArquivo === null) {
                $nomeArquivo = basename($imagem);
            }
        } else {
            $dadosEnvio['image'] = $imagem;
        }
        
        if ($nomeArquivo !== null) {
            $dadosEnvio['fileName'] = $nomeArquivo;
        }
    } else {
        $dadosEnvio['image'] = $imagem;
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.z-api.io/instances/3ED9B33D7F0A9142C44F6EF9D3DD8A4F/token/D504C69DFA0B29748CC8F25A/send-image",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($dadosEnvio),
        CURLOPT_HTTPHEADER => array(
            "client-token: F2ba8000e68f040a6aaa165bad8b1c425S",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    curl_close($curl);

    return array(
        'telefone' => $telefone,
        'imagem' => $imagem,
        'success' => ($err ? false : true),
        'error' => $err,
        'response' => $response,
        'httpCode' => $httpCode
    );
}