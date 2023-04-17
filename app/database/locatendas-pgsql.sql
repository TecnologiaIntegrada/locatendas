CREATE TABLE anotacoes( 
      id_nota  SERIAL    NOT NULL  , 
      descricao_do_item varchar  (128)   NOT NULL  , 
      detalhas_da_nota text   , 
      data_de_execucao timestamp   , 
      id_projetos integer   , 
      id_tipo_nota integer   , 
 PRIMARY KEY (id_nota)) ; 

CREATE TABLE clientes( 
      id_cliente  SERIAL    NOT NULL  , 
      nome_do_cliente varchar  (68)   NOT NULL  , 
 PRIMARY KEY (id_cliente)) ; 

CREATE TABLE projetos( 
      id_projetos  SERIAL    NOT NULL  , 
      referencia varchar  (250)   , 
      nome_do_evento varchar  (64)   NOT NULL  , 
      data_do_evento timestamp   , 
      descricao_do_evento text   , 
      entrada_via_web integer   , 
      data_montagem timestamp   , 
      data_desmotagem timestamp   , 
      id_cliente integer   , 
 PRIMARY KEY (id_projetos)) ; 

CREATE TABLE tipos_de_nota( 
      id_tipo_nota  SERIAL    NOT NULL  , 
      tipo_de_nota varchar  (150)   NOT NULL  , 
 PRIMARY KEY (id_tipo_nota)) ; 

 
  
 ALTER TABLE anotacoes ADD CONSTRAINT fk_anotacoes_projetos FOREIGN KEY (id_projetos) references projetos(id_projetos); 
ALTER TABLE anotacoes ADD CONSTRAINT fk_tipos_nota FOREIGN KEY (id_tipo_nota) references tipos_de_nota(id_tipo_nota); 
ALTER TABLE projetos ADD CONSTRAINT fk_projetos_1_clientes FOREIGN KEY (id_cliente) references clientes(id_cliente); 

  
