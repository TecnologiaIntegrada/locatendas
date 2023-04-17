PRAGMA foreign_keys=OFF; 

CREATE TABLE anotacoes( 
      id_nota  INTEGER    NOT NULL  , 
      descricao_do_item varchar  (128)   NOT NULL  , 
      detalhas_da_nota text   , 
      data_de_execucao datetime   , 
      id_projetos int   , 
      id_tipo_nota int   , 
 PRIMARY KEY (id_nota),
FOREIGN KEY(id_projetos) REFERENCES projetos(id_projetos),
FOREIGN KEY(id_tipo_nota) REFERENCES tipos_de_nota(id_tipo_nota)) ; 

CREATE TABLE clientes( 
      id_cliente  INTEGER    NOT NULL  , 
      nome_do_cliente varchar  (68)   NOT NULL  , 
 PRIMARY KEY (id_cliente)) ; 

CREATE TABLE projetos( 
      id_projetos  INTEGER    NOT NULL  , 
      referencia varchar  (250)   , 
      nome_do_evento varchar  (64)   NOT NULL  , 
      data_do_evento datetime   , 
      descricao_do_evento text   , 
      entrada_via_web int   , 
      data_montagem datetime   , 
      data_desmotagem datetime   , 
      id_cliente int   , 
 PRIMARY KEY (id_projetos),
FOREIGN KEY(id_cliente) REFERENCES clientes(id_cliente)) ; 

CREATE TABLE tipos_de_nota( 
      id_tipo_nota  INTEGER    NOT NULL  , 
      tipo_de_nota varchar  (150)   NOT NULL  , 
 PRIMARY KEY (id_tipo_nota)) ; 

 
 
  
