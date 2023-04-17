CREATE TABLE anotacoes( 
      `id_nota`  INT  AUTO_INCREMENT    NOT NULL  , 
      `descricao_do_item` varchar  (128)   NOT NULL  , 
      `detalhas_da_nota` text   , 
      `data_de_execucao` datetime   , 
      `id_projetos` int   , 
      `id_tipo_nota` int   , 
 PRIMARY KEY (id_nota)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE clientes( 
      `id_cliente`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome_do_cliente` varchar  (68)   NOT NULL  , 
 PRIMARY KEY (id_cliente)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE projetos( 
      `id_projetos`  INT  AUTO_INCREMENT    NOT NULL  , 
      `referencia` varchar  (250)   , 
      `nome_do_evento` varchar  (64)   NOT NULL  , 
      `data_do_evento` datetime   , 
      `descricao_do_evento` text   , 
      `entrada_via_web` int   , 
      `data_montagem` datetime   , 
      `data_desmotagem` datetime   , 
      `id_cliente` int   , 
 PRIMARY KEY (id_projetos)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipos_de_nota( 
      `id_tipo_nota`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_de_nota` varchar  (150)   NOT NULL  , 
 PRIMARY KEY (id_tipo_nota)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
  
 ALTER TABLE anotacoes ADD CONSTRAINT fk_anotacoes_projetos FOREIGN KEY (id_projetos) references projetos(id_projetos); 
ALTER TABLE anotacoes ADD CONSTRAINT fk_tipos_nota FOREIGN KEY (id_tipo_nota) references tipos_de_nota(id_tipo_nota); 
ALTER TABLE projetos ADD CONSTRAINT fk_projetos_1_clientes FOREIGN KEY (id_cliente) references clientes(id_cliente); 

  
