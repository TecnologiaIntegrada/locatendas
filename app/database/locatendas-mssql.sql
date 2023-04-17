CREATE TABLE anotacoes( 
      id_nota  INT IDENTITY    NOT NULL  , 
      descricao_do_item varchar  (128)   NOT NULL  , 
      detalhas_da_nota nvarchar(max)   , 
      data_de_execucao datetime2   , 
      id_projetos int   , 
      id_tipo_nota int   , 
 PRIMARY KEY (id_nota)) ; 

CREATE TABLE clientes( 
      id_cliente  INT IDENTITY    NOT NULL  , 
      nome_do_cliente varchar  (68)   NOT NULL  , 
 PRIMARY KEY (id_cliente)) ; 

CREATE TABLE projetos( 
      id_projetos  INT IDENTITY    NOT NULL  , 
      referencia varchar  (250)   , 
      nome_do_evento varchar  (64)   NOT NULL  , 
      data_do_evento datetime2   , 
      descricao_do_evento nvarchar(max)   , 
      entrada_via_web int   , 
      data_montagem datetime2   , 
      data_desmotagem datetime2   , 
      id_cliente int   , 
 PRIMARY KEY (id_projetos)) ; 

CREATE TABLE tipos_de_nota( 
      id_tipo_nota  INT IDENTITY    NOT NULL  , 
      tipo_de_nota varchar  (150)   NOT NULL  , 
 PRIMARY KEY (id_tipo_nota)) ; 

 
  
 ALTER TABLE anotacoes ADD CONSTRAINT fk_anotacoes_projetos FOREIGN KEY (id_projetos) references projetos(id_projetos); 
ALTER TABLE anotacoes ADD CONSTRAINT fk_tipos_nota FOREIGN KEY (id_tipo_nota) references tipos_de_nota(id_tipo_nota); 
ALTER TABLE projetos ADD CONSTRAINT fk_projetos_1_clientes FOREIGN KEY (id_cliente) references clientes(id_cliente); 

  
