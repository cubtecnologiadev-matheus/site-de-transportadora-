<?php

function buscarEncomenda($codigo) {
    $envios = listarEnvios();
    
    // Remove formatting from CPF if provided
    $codigo_limpo = preg_replace('/[^0-9A-Z]/', '', strtoupper($codigo));
    
    foreach ($envios as $envio) {
        $cpf_limpo = preg_replace('/[^0-9]/', '', $envio['cpf_destinatario']);
        
        // Search by tracking code or CPF
        if ($envio['remessa'] === $codigo || 
            $envio['remessa'] === $codigo_limpo ||
            $cpf_limpo === $codigo_limpo ||
            $envio['cpf_destinatario'] === $codigo) {
            
            return [
                'remessa' => $envio['remessa'],
                'cpf' => $envio['cpf_destinatario'],
                'nome' => $envio['destinatario'],
                'origem' => $envio['origem'],
                'destino' => $envio['destino'],
                'status' => $envio['status'],
                'status_texto' => getStatusTexto($envio['status']),
                'historico' => $envio['historico'],
                'endereco_origem' => $envio['endereco_origem'] ?? '',
                'endereco_destino' => $envio['endereco_destino'] ?? ''
            ];
        }
    }
    
    return null;
}

function getStatusTexto($status) {
    $status_map = [
        'pending' => 'Pendente',
        'collected' => 'Coletado',
        'transit' => 'Em Trânsito',
        'out_for_delivery' => 'Saiu para Entrega',
        'delivered' => 'Entregue',
        'returned' => 'Devolvido'
    ];
    
    return $status_map[$status] ?? 'Desconhecido';
}

function getDataPath() {
    // Get the document root path
    $docRoot = $_SERVER['DOCUMENT_ROOT'];
    $currentDir = dirname(__FILE__);
    
    // If we're in admin folder, go up one level
    if (strpos($currentDir, '/admin/') !== false) {
        $dataPath = dirname($currentDir) . '/data';
    } else {
        $dataPath = dirname($currentDir) . '/data';
    }
    
    // Create directory if it doesn't exist
    if (!file_exists($dataPath)) {
        mkdir($dataPath, 0777, true);
    }
    
    return $dataPath;
}

function salvarCliente($dados) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/clientes.json';
    $clientes = [];
    
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        $clientes = json_decode($conteudo, true) ?: [];
    }
    
    $dados['id'] = uniqid();
    $dados['data_cadastro'] = date('Y-m-d H:i:s');
    $clientes[] = $dados;
    
    file_put_contents($arquivo, json_encode($clientes, JSON_PRETTY_PRINT));
    return $dados['id'];
}

function salvarEnvio($dados) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    $envios = [];
    
    if (file_exists($arquivo)) {
        $conteudo = file_get_contents($arquivo);
        $envios = json_decode($conteudo, true) ?: [];
    }
    
    $dados['id'] = uniqid();
    $dados['remessa'] = 'EXP' . strtoupper(uniqid());
    $dados['data_criacao'] = date('Y-m-d H:i:s');
    $dados['status'] = 'collected'; // Changed default status to 'collected'
    $dados['historico'] = [
        [
            'data' => date('d/m/Y'),
            'hora' => date('H:i'),
            'descricao' => 'Envio cadastrado no sistema',
            'local' => $dados['origem']
        ],
        [
            'data' => date('d/m/Y'),
            'hora' => date('H:i'),
            'descricao' => 'Objeto postado',
            'local' => $dados['origem']
        ]
    ];
    
    $envios[] = $dados;
    
    file_put_contents($arquivo, json_encode($envios, JSON_PRETTY_PRINT));
    return $dados['remessa'];
}

function listarClientes() {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/clientes.json';
    if (!file_exists($arquivo)) {
        return [];
    }
    
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo, true) ?: [];
}

function listarEnvios() {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    if (!file_exists($arquivo)) {
        return [];
    }
    
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo, true) ?: [];
}

function atualizarStatusEnvio($remessa, $novoStatus, $descricao, $local) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    if (!file_exists($arquivo)) {
        return false;
    }
    
    $envios = json_decode(file_get_contents($arquivo), true);
    
    foreach ($envios as &$envio) {
        if ($envio['remessa'] === $remessa) {
            $envio['status'] = $novoStatus;
            $envio['historico'][] = [
                'data' => date('d/m/Y'),
                'hora' => date('H:i'),
                'descricao' => $descricao,
                'local' => $local
            ];
            break;
        }
    }
    
    file_put_contents($arquivo, json_encode($envios, JSON_PRETTY_PRINT));
    return true;
}

function excluirCliente($id) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/clientes.json';
    if (!file_exists($arquivo)) {
        return false;
    }
    
    $clientes = json_decode(file_get_contents($arquivo), true);
    $clientes = array_filter($clientes, function($cliente) use ($id) {
        return $cliente['id'] !== $id;
    });
    
    file_put_contents($arquivo, json_encode(array_values($clientes), JSON_PRETTY_PRINT));
    return true;
}

function excluirEnvio($remessa) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    if (!file_exists($arquivo)) {
        return false;
    }
    
    $envios = json_decode(file_get_contents($arquivo), true);
    $envios = array_filter($envios, function($envio) use ($remessa) {
        return $envio['remessa'] !== $remessa;
    });
    
    file_put_contents($arquivo, json_encode(array_values($envios), JSON_PRETTY_PRINT));
    return true;
}

function configurarPagamentoPendente($remessa, $ativo, $valorTaxa = '200,00') {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    if (!file_exists($arquivo)) {
        return false;
    }
    
    $envios = json_decode(file_get_contents($arquivo), true);
    
    foreach ($envios as &$envio) {
        if ($envio['remessa'] === $remessa) {
            $envio['pagamento_pendente'] = $ativo;
            $envio['valor_taxa'] = $valorTaxa;
            
            // If activating payment pending, add to history
            if ($ativo) {
                $envio['historico'][] = [
                    'data' => date('d/m/Y'),
                    'hora' => date('H:i'),
                    'descricao' => 'Aguardando pagamento para liberação do objeto',
                    'local' => 'Centro de Distribuição'
                ];
            }
            break;
        }
    }
    
    file_put_contents($arquivo, json_encode($envios, JSON_PRETTY_PRINT));
    return true;
}

function adicionarEventoRastreio($remessa, $descricao, $local) {
    $dataPath = getDataPath();
    $arquivo = $dataPath . '/envios.json';
    if (!file_exists($arquivo)) {
        return false;
    }
    
    $envios = json_decode(file_get_contents($arquivo), true);
    
    foreach ($envios as &$envio) {
        if ($envio['remessa'] === $remessa) {
            $envio['historico'][] = [
                'data' => date('d/m/Y'),
                'hora' => date('H:i'),
                'descricao' => $descricao,
                'local' => $local
            ];
            break;
        }
    }
    
    file_put_contents($arquivo, json_encode($envios, JSON_PRETTY_PRINT));
    return true;
}

?>
