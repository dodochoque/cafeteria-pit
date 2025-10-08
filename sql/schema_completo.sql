-- Script SQL - Modelo Físico (Dianita Café)
CREATE TABLE IF NOT EXISTS clientes (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  telefone VARCHAR(20),
  cpf VARCHAR(14) UNIQUE,
  endereco VARCHAR(160),
  cidade VARCHAR(100),
  uf CHAR(2),
  cep VARCHAR(9)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS produtos (
  id_produto INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  categoria VARCHAR(60),
  preco DECIMAL(10,2) NOT NULL,
  estoque INT NOT NULL DEFAULT 0,
  ativo TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pedidos (
  id_pedido INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT,
  data_pedido DATETIME,
  status VARCHAR(20),
  CONSTRAINT fk_pedidos_cliente FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS itens_pedido (
  id_item INT AUTO_INCREMENT PRIMARY KEY,
  id_pedido INT,
  id_produto INT,
  quantidade INT,
  preco_unit DECIMAL(10,2),
  total_item DECIMAL(10,2),
  CONSTRAINT fk_itens_pedido FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
  CONSTRAINT fk_itens_produto FOREIGN KEY (id_produto) REFERENCES produtos(id_produto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS pagamentos (
  id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
  id_pedido INT,
  metodo ENUM('cartao','pix','boleto') NOT NULL,
  status_pagamento ENUM('pendente','pago','falhou','estornado') DEFAULT 'pendente',
  valor DECIMAL(10,2) NOT NULL,
  data_pagamento DATETIME NULL,
  transacao VARCHAR(120) NULL,
  CONSTRAINT fk_pagamento_pedido FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
