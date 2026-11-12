CREATE DATABASE IF NOT EXISTS zeta_transporte
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE zeta_transporte;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    usuario VARCHAR(60) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    linha VARCHAR(60) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    icone VARCHAR(10) DEFAULT '📦'
);

CREATE TABLE IF NOT EXISTS curriculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL,
    telefone VARCHAR(30),
    arquivo VARCHAR(255) NOT NULL,
    enviado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produtos (nome, linha, descricao, preco, icone) VALUES
('Entrega Expressa', 'Transporte', 'Solução ilustrativa para entregas com prioridade.', 89.90, '🚚'),
('Transporte Econômico', 'Transporte', 'Opção de transporte para demandas programadas.', 59.90, '🚛'),
('Espaço de Armazenagem', 'Armazenagem', 'Serviço demonstrativo de espaço para mercadorias.', 120.00, '🏬'),
('Caixa Reforçada', 'Embalagem', 'Embalagem resistente para proteção de produtos.', 24.90, '📦'),
('Kit de Proteção', 'Embalagem', 'Materiais para acondicionamento e proteção.', 34.90, '🧰'),
('Kit Logístico', 'Acessórios', 'Conjunto ilustrativo de acessórios para organização.', 49.90, '🗂️');